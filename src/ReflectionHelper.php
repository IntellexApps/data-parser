<?php declare(strict_types = 1);

namespace Intellex\DataParser;

use Intellex\DataParser\Exceptions\InvalidArrayItemType;
use ReflectionProperty;

abstract class ReflectionHelper {

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
			return trim($match[1], '[ ]\\');
		}

		throw new InvalidArrayItemType($property->getDeclaringClass()->getName(), $property);
	}
}
