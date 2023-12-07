<?php declare(strict_types = 1);

namespace Intellex\DataParser;

use Intellex\DataParser\Exceptions\ClassNotFound;
use Intellex\DataParser\Exceptions\PropertyNotInitialized;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * The main parser.
 */
class DataParser {

	/** @var string[] The list of native PHP types. */
	private const NATIVE_TYPES = [ 'int', 'float', 'bool', 'string' ];

	/** @param ParserPool $parserPool The pool that hold preregistered parsers for classes and types. */
	public function __construct(
		private readonly ParserPool $parserPool = new ParserPool()
	) {
	}

	/**
	 * Parse a raw data into a PHP object.
	 *
	 * @template T
	 *
	 * @param class-string<T> $className The fully qualified name of the class to instantiate.
	 * @param array           $data      The data to build the class instance from.
	 *
	 * @return T The built class.
	 * @throws PropertyNotInitialized If at least one of the required properties is not initialized.
	 */
	public function parse(string $className, array $data): object {
		try {
			$instance = new $className;
			$reflection = new ReflectionClass($instance);

			// Go over all the data
			foreach ($data as $key => $value) {
				try {
					$propertyName = $this->convertDataKeyToPropertyName($key);
					$property = $reflection->getProperty($propertyName);

					// Extract and convert the raw value into the proper type or class
					$propertyType = $property->getType()?->getName();
					$value = $this->extractValue($propertyType, $value, $property);

					$property->setValue($instance, $value);

				} catch (ReflectionException) {
					// If a key is present in the data, but not in the target class - it is safe to ignore it
				}
			}

			// Make sure every property is initialized
			foreach ($reflection->getProperties() as $property) {
				if (!$property->isInitialized($instance)) {
					throw new PropertyNotInitialized($className, $property->getName());
				}
			}

			return $instance;

		} catch (ReflectionException) {
			throw new ClassNotFound($className);
		}
	}

	/**
	 * Extract a typed value from a raw value.
	 *
	 * @template T
	 *
	 * @param class-string<T>|null    $type     The class or type to extract from the value.
	 * @param mixed                   $value    The original value.
	 * @param ReflectionProperty|null $property The additional information about the class property, if applicable.
	 *
	 * @return ?T The extracted value in the requested type or class.
	 */
	public function extractValue(?string $type, mixed $value, ?ReflectionProperty $property = null): mixed {

		// Null
		if ($value === null) {
			return null;
		}

		// If no type is specified do not alter the original value
		if ($type === null || $type === 'null') {
			return $value;
		}

		// Arrays
		if ($type === 'array') {

			// Check to see if the type of the items in array are known
			$arrayItemType = $property !== null && ($propertyDocComment = $property->getDocComment())
				? $this->extractArrayItemType($propertyDocComment, $property->getDeclaringClass()->getNamespaceName())
				: null;

			return $this->parseArray($arrayItemType, $value);
		}

		// Predefined class parsers
		$parser = $this->parserPool->getParser($type);
		if ($parser !== null) {
			return $parser->parse($value);
		}

		// Other classes
		return $this->parse($type, $value);
	}

	/**
	 * Parse a raw data into an array of PHP objects.
	 *
	 * @template T
	 *
	 * @param class-string<T>|null $className The fully qualified name of the class to instantiate, or null in order
	 *                                        not to perform any changes.
	 * @param array                $data      The data to build the class instances from.
	 *
	 * @return array<T> An array of the class instances.
	 */
	public function parseArray(?string $className, array $data): array {
		return array_map(fn($item) => $this->extractValue($className, $item), $data);
	}

	/**
	 * Convert the key from the data so that it exactly matches the class property name.
	 *
	 * @param string $propertyName The original key from the raw data.
	 *
	 * @return string The name of the property in the class.
	 */
	private function convertDataKeyToPropertyName(string $propertyName): string {
		$propertyName = preg_replace('~_+~', ' ', $propertyName);
		$propertyName = ucwords($propertyName);
		$propertyName = str_replace(' ', '', $propertyName);
		$propertyName[0] = strtolower($propertyName[0]);

		return $propertyName;
	}

	/**
	 * Extract the array type from the comment of the property.
	 *
	 * It only matches the form: 'ClassName[]'.
	 *
	 * @param string|null $docComment The comment describing the property.
	 * @param string|null $namespace The namespace of the class.
	 *
	 * @return string|null The extracted
	 */
	private function extractArrayItemType(?string $docComment, ?string $namespace = null): ?string {
		if (preg_match('~@var +(?<type>[\\\\\w-]+) *\[ *]~', $docComment ?? '', $match)) {
			$type = $match['type'];

			// Do not use the namespace if it is already included in the type
			if (in_array($type, self::NATIVE_TYPES, true) || $type[0] === '\\') {
				$namespace = null;
			}

			// The class should never have a leading namespace slash
			$type = ltrim($type, '\\');

			// Handle the class name with both the namespace and without
			return implode('\\', array_filter([ $namespace, $type ]));
		}

		return null;
	}
}
