<?php declare(strict_types = 1);

namespace Intellex\DataParser\Exceptions;

use ReflectionProperty;
use Throwable;

/**
 * Indicates that an array property does not have a valid item type.
 */
class InvalidArrayItemType extends AbstractDataParserException {

	/**
	 * @param class-string       $className The name of the class that the value cannot be parsed to.
	 * @param ReflectionProperty $property  The property that does not have array item type.
	 */
	public function __construct(
		public readonly string $className,
		public readonly ReflectionProperty $property,
		?Throwable $previous = null,
	) {
		parent::__construct(
			"Unable to read item type for array property: {$className}::{$property->name}",
			$previous
		);
	}
}
