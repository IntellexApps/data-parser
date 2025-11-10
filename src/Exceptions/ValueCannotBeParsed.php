<?php declare(strict_types = 1);

namespace Intellex\DataParser\Exceptions;

use Throwable;

/**
 * Indicates that a value cannot be parsed to a class that it should belong.
 */
class ValueCannotBeParsed extends AbstractDataParserException {

	/**
	 * @param string $className The name of the class that the value cannot be parsed to.
	 * @param mixed  $value     The original value.
	 */
	public function __construct(
		public readonly string $className,
		public readonly mixed $value,
		?Throwable $previous = null,
	) {
		$valueString = (string) ($value);
		parent::__construct(
			"Unable to convert '{$valueString}' to an instance of {$className}",
			$previous
		);
	}
}
