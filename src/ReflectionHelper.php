<?php declare(strict_types = 1);

namespace Intellex\DataParser;

use Intellex\DataParser\Exceptions\InvalidArrayItemType;
use ReflectionProperty;

abstract class ReflectionHelper {

	/** @var array<string, string> The cache for the known classes. */
	private static array $knownClassesCache = [];

	/**
	 * Extract the array type from the comment of the property.
	 *
	 * It only matches the form: 'ClassName[]'.
	 *
	 * TODO: Test this.
	 *
	 * @param ReflectionProperty $property The property to extract the comment from.
	 *
	 * @return string The extracted FQN class name, or null if the class cannot be extracted.
	 * @throws InvalidArrayItemType
	 */
	public static function extractArrayItemType(ReflectionProperty $property): string {
		$docComment = $property->getDocComment() ?: "";
		if (preg_match('~@var[\s?]+((\\\\?\w+)+\[]|array\s+)~', $docComment, $match)) {

			// Is there a valid class name
			$className = self::getClassName($match[1], $property);
			if ($className) {
				return $className;
			}
		}

		throw new InvalidArrayItemType($property->getDeclaringClass()->getName(), $property);
	}

	/**
	 * Get the full class name based on the matched comment.
	 *
	 * @param string             $originalClassName The original class name that was extracted.
	 * @param ReflectionProperty $property          The property from which the original class name was extracted.
	 *
	 * @return string|null The existing class name, or null if there are no classes for the supplied input.
	 */
	public static function getClassName(string $originalClassName, ReflectionProperty $property): ?string {

		// Return from cache
		if (array_key_exists($originalClassName, self::$knownClassesCache)) {
			return self::$knownClassesCache[$originalClassName];
		}

		// Simple type
		$className = trim($originalClassName, '[ ]\\');
		if (in_array($className, [ "bool", "int", "float", "string", "array", "mixed" ])) {
			return self::$knownClassesCache[$originalClassName] = $className;
		}

		// Without additional namespace
		if (class_exists($className)) {
			return self::$knownClassesCache[$originalClassName] = $className;
		}

		// With parent namespace
		$className = "{$property->getDeclaringClass()->getNamespaceName()}\\{$className}";
		if (class_exists($className)) {
			return self::$knownClassesCache[$originalClassName] = $className;
		}

		return self::$knownClassesCache[$originalClassName] ?? null;
	}
}
