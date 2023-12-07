<?php declare(strict_types = 1);

namespace Intellex\DataParser\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Indicates that a value cannot be parsed to a class that it should belong.
 */
class ValueCannotBeParsed extends RuntimeException implements DataParserException {

	/**
	 * @param string $className The name of the class that the value cannot be parsed to.
	 * @param mixed  $value     The original value.
	 */
	public function __construct(string $className, mixed $value, ?Throwable $previous = null) {
		$valueString = (string) ($value);
		parent::__construct(
			"Unable to convert a value '{$valueString}' to class {$className}",
			400,
			$previous
		);
	}
}
