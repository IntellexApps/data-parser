<?php declare(strict_types = 1);

namespace Intellex\DataParser\Parsers\NativeTypes;

use Intellex\DataParser\Parsers\Parser;

/**
 * Parse a value to a PHP native string.
 *
 * @template-implements Parser<string>
 */
class StringParser implements Parser {

	public function __construct(
		/** @var bool $autoTrim Set to true to automatically trim all values. */
		private readonly bool $autoTrim = false,
	) {
	}

	/** @inheritdoc */
	public function parse(mixed $value): ?string {

		// Handle: null
		if ($value === null) {
			return $value;
		}

		// Handle: Bool
		if (is_bool($value)) {
			return $value ? 'true' : 'false';
		}

		return $this->autoTrim
			? trim((string) $value)
			: (string) $value;
	}

	/** @inheritdoc */
	public function targetClass(): string {
		return 'string';
	}
}
