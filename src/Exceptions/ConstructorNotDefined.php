<?php declare(strict_types = 1);

namespace Intellex\DataParser\Exceptions;

use Throwable;

/**
 * The target class does not have a defined constructor.
 */
class ConstructorNotDefined extends AbstractDataParserException {

	/**
	 * @param class-string $className The name of the class which is missing.
	 */
	public function __construct(
		public readonly string $className,
		?Throwable $previous = null,
	) {
		parent::__construct(
			"Class does not have a defined constructor: {$className}",
			$previous
		);
	}
}
