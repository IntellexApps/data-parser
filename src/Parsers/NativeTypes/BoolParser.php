<?php declare(strict_types = 1);

namespace Intellex\DataParser\Parsers\NativeTypes;

use Intellex\DataParser\Parsers\Parser;

/**
 * Parse a value to a PHP native boolean.
 *
 * @template-implements Parser<bool>
 */
class BoolParser implements Parser {

	/**
	 * @param string[] $falseValues The list of values that are considered to be false.
	 */
	public function __construct(
		private readonly array $falseValues = [ '', '0', 'f', 'false', 'no', 'off', 'null' ]
	) {
	}

	/** @inheritdoc */
	public function parse(mixed $value): bool {
		if (in_array(strtolower((string) $value), $this->falseValues, true)) {
			return false;
		}

		return (bool) $value;
	}

	/** @inheritdoc */
	public function defineTargetClass(): string {
		return 'bool';
	}
}
