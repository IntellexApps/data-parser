<?php declare(strict_types = 1);

namespace Intellex\DataParser\Parsers\NativeTypes;

use Intellex\DataParser\Parsers\Parser;

/**
 * Parse a value to a PHP native string.
 *
 * @template-implements Parser<string>
 */
class StringParser implements Parser {

	/** @inheritdoc */
	public function parse(mixed $value): string {
		return (string) $value;
	}

	/** @inheritdoc */
	public function defineTargetClass(): string {
		return 'string';
	}
}
