<?php declare(strict_types = 1);

namespace Intellex\DataParser\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Indicates that not all required properties have been initialized in the class.
 */
class PropertyNotInitialized extends RuntimeException implements DataParserException {

	/**
	 * @param class-string $className    The name of the class which with uninitialized property.
	 * @param string       $propertyName The name of the property which is uninitialized
	 */
	public function __construct(string $className, string $propertyName, ?Throwable $previous = null) {
		parent::__construct(
			"Class property not initialized: {$className}::{$propertyName}",
			422,
			$previous
		);
	}
}
