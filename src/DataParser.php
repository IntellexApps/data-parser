<?php declare(strict_types = 1);

namespace Intellex\DataParser;

use Intellex\DataParser\Exceptions\ClassNotFound;
use Intellex\DataParser\Exceptions\ConstructorNotDefined;
use Intellex\DataParser\Exceptions\NoValueForClassProperty;
use Intellex\DataParser\Exceptions\UnableToParseAbstractData;
use Intellex\NamingConvention\NamingConvention;
use Intellex\NamingConvention\VariableSource;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * The main parser.
 *
 * @todo Require exact matches, or auto-convert.
 * @todo Handle the differences between using different naming styles.
 * @todo Handle properties with default values, handle null and missing.
 * @todo Handle nullable properties.
 * @todo Test all different styles of comment.
 * @todo Different format.
 */
class DataParser {
	/** @var ParserPool The pool that hold preregistered parsers for classes and types. */
	private readonly ParserPool $parserPool;

	/** @var class-string The string representation of the PHP array type. */
	private const TYPE_ARRAY = "array";

	public function __construct() {
		$this->parserPool = new ParserPool();
	}

	/**
	 * Parse a raw data into a PHP object.
	 *
	 * @template T
	 *
	 * @param class-string<T> $className The fully qualified name of the class to instantiate (ie: Model::class).
	 * @param mixed           $data      The data to build the class instance from, or a primitive scalar.
	 *
	 * @return ?T The built class, or a simple scalar.
	 */
	public function parse(string $className, mixed $data): mixed {

		// Try predefined parsers
		$parser = $this->parserPool->getParser($className);
		if ($parser !== null) {
			return $parser->parse($data);
		}

		// Assert: The class exists
		if (!class_exists($className)) {
			throw new ClassNotFound($className);
		}
		$reflector = new ReflectionClass($className);

		// Assert: Constructor is defined
		$constructor = $reflector->getConstructor();
		if ($constructor === null) {
			throw new ConstructorNotDefined($className);
		}

		// Iterate over properties
		$preparedData = [];
		$properties = $reflector->getProperties();
		foreach ($properties as $property) {
			$type = $property->getType();

			// Read the data
			$value = $this->getValue($className, $property, $data);

			// TODO: Add this as an option
			// Auto convert null arrays to empty arrays
			if ($value === null && $type !== null && !$type->allowsNull() && $type->getName() === 'array') {
				$value = [];
			}

			$preparedData[$property->getName()] = $value;
		}

		// Try to convert into object
		try {
			return $reflector->newInstanceArgs($preparedData);
		} catch (ReflectionException) {
			throw new UnableToParseAbstractData($className, $data);
		}
	}

	/**
	 * Parse a raw data into an array of PHP objects.
	 *
	 * @template T
	 *
	 * @param class-string<T> $className The fully qualified name of the class to instantiate (ie: Model::class).
	 * @param ?array<mixed>   $data      The data to build the class instances from.
	 *
	 * @return array<T> An array of the class instances, or empty if $data is an empty array or null.
	 */
	public function parseArray(string $className, ?array $data): array {
		return $className !== self::TYPE_ARRAY
			? array_map(fn($item) => $this->parse($className, $item), $data ?? [])
			: $data;
	}

	/**
	 * Extract a typed value from a raw value.
	 *
	 * @param class-string       $className The fully qualified name of the class.
	 * @param ReflectionProperty $property  The property to get the value for.
	 * @param array<mixed>       $data      The data to get the value from.
	 *
	 * @return mixed The extracted value in the requested type or class.
	 */
	public function getValue(string $className, ReflectionProperty $property, array $data): mixed {
		$datasetKeys = array_keys($data);
		$propertyType = $property->getType();
		$propertyName = $property->getName();

		// Get the key
		$key = $this->getKey($propertyName, $datasetKeys);
		if ($key === null) {
			// TODO make a test for this
			throw new NoValueForClassProperty($className, $propertyName, $data);
		}

		// Get the raw value
		$value = $data[$key];

		// If no type is specified do not alter the original value
		if ($value === null || $propertyType === null) {
			return $value;
		}

		// Arrays
		$propertyTypeClassName = $propertyType->getName();
		return $propertyTypeClassName === self::TYPE_ARRAY
			? $this->parseArray(ReflectionHelper::extractArrayItemType($property), $value)
			: $this->parse($propertyTypeClassName, $value);
	}

	/**
	 * Get the key from the data set to be used for a property.
	 *
	 * @param string   $propertyName The name of the property.
	 * @param string[] $keys         The list of keys to choose from.
	 *
	 * @return string|null The key to use, or null if there is no suitable one.
	 */
	private function getKey(string $propertyName, array $keys): ?string {

		// TODO
		// Add predefined method

		// Direct
		if (in_array($propertyName, $keys)) {
			return $propertyName;
		}

		// Auto detect
		$namingConvention = NamingConvention::inferFromList($keys);
		$alternativeKey = VariableSource::from($propertyName)->convertTo($namingConvention)->name;
		if (in_array($alternativeKey, $keys)) {
			return $alternativeKey;
		}

		return null;
	}
}
