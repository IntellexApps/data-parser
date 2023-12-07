<?php declare(strict_types = 1);

namespace Intellex\DataParser\Parsers;

/**
 * The mandatory methods required for all parsers.
 *
 * @template T
 */
interface Parser {

	/**
	 * Define for which class this parser is eligible for.
	 *
	 * @return class-string<T> The fully qualified name of the class this parser handles.
	 */
	public function defineTargetClass(): string;

	/**
	 * Parse a raw value to a type or a class.
	 *
	 * @param mixed $value The raw value to parse.
	 *
	 * @return T The parsed value.
	 */
	public function parse(mixed $value): mixed;
}
