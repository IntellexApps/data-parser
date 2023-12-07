<?php declare(strict_types = 1);

namespace Intellex\DataParser\Exceptions;

use LogicException;
use Throwable;

/**
 * The target class does not exist.
 */
class ClassNotFound extends LogicException implements DataParserException {

	/**
	 * @param class-string $className The name of the class which is missing.
	 */
	public function __construct(string $className, ?Throwable $previous = null) {
		parent::__construct(
			"Class does not exist: {$className}",
			422,
			$previous
		);
	}
}
