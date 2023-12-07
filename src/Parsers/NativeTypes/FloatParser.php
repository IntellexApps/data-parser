<?php declare(strict_types = 1);

namespace Intellex\DataParser\Parsers\NativeTypes;

use Intellex\DataParser\Parsers\Parser;

/**
 * Parse a value to a PHP native float.
 *
 * @template-implements Parser<float>
 */
class FloatParser implements Parser {

	/** @inheritdoc */
	public function parse(mixed $value): float {
		return (float) $value;
	}

	/** @inheritdoc */
	public function defineTargetClass(): string {
		return 'float';
	}
}
