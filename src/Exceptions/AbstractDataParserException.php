<?php declare(strict_types = 1);

namespace Intellex\DataParser\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Used to identify which exceptions are raised by this library.
 */
abstract class AbstractDataParserException extends RuntimeException {

	public function __construct(string $message, ?Throwable $previous = null) {
		parent::__construct($message, 422, $previous);
	}
}
