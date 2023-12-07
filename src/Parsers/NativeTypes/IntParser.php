<?php declare(strict_types = 1);

namespace Intellex\DataParser\Parsers\NativeTypes;

use Intellex\DataParser\Parsers\Parser;

/**
 * Parse a value to a PHP native integer.
 *
 * @template-implements Parser<int>
 */
class IntParser implements Parser {

	/** @inheritdoc */
	public function parse(mixed $value): int {
		return (int) $value;
	}

	/** @inheritdoc */
	public function defineTargetClass(): string {
		return 'int';
	}
}
