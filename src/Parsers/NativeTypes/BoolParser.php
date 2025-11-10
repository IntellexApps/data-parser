<?php declare(strict_types = 1);

namespace Intellex\DataParser\Parsers\NativeTypes;

use Intellex\DataParser\Parsers\Parser;

/**
 * Parse a value to a PHP native boolean.
 *
 * @template-implements Parser<bool>
 */
class BoolParser implements Parser {

	public function __construct(
		/** @var string[] $nullable If set to false, null values will be parsed as false. */
		private readonly bool $nullable = false,
		/** @var string[] $falseValues The list of values that are considered to be false. */
		private readonly array $falseValues = [ '', '0', 'f', 'false', 'n', 'no', 'off', 'null' ],
	) {
	}

	/** @inheritdoc */
	public function parse(mixed $value): ?bool {

		// Handle: null
		if ($value === null) {
			return $this->nullable ? null : false;
		}

		// Handle: Predefined values
		if (is_string($value) && in_array(strtolower(trim($value)), $this->falseValues, true)) {
			return false;
		}

		return (bool) $value;
	}

	/** @inheritdoc */
	public function targetClass(): string {
		return 'bool';
	}
}
