<?php declare(strict_types = 1);

namespace Intellex\DataParser\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Class could not be built as it is missing a property.
 */
class PropertyDoesNotExist extends RuntimeException implements DataParserException {

	/**
	 * @param class-string $className    The name of the class which is missing the property.
	 * @param string       $propertyName The name of the property which is missing
	 */
	public function __construct(string $className, string $propertyName, ?Throwable $previous = null) {
		parent::__construct(
			"Class does not have a property: {$className}::{$propertyName}",
			422,
			$previous
		);
	}
}
