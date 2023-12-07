<?php declare(strict_types = 1);

namespace Intellex\DataParser;

use Intellex\DataParser\Parsers\NativeClasses\DateTimeParser;
use Intellex\DataParser\Parsers\NativeTypes\BoolParser;
use Intellex\DataParser\Parsers\NativeTypes\FloatParser;
use Intellex\DataParser\Parsers\NativeTypes\IntParser;
use Intellex\DataParser\Parsers\NativeTypes\StringParser;
use Intellex\DataParser\Parsers\Parser;

/**
 * The pool of all specific parsers to use.
 */
class ParserPool {

	/** @var Parser[] $pool The initial pool of parsers to use. */
	private array $pool = [];

	/**
	 * @param bool $includeNativeParsers True to include native PHP parser, false to omit them.
	 */
	public function __construct(
		readonly bool $includeNativeParsers = true
	) {
		if ($includeNativeParsers) {

			// Native classes
			$this->register(new DateTimeParser());

			// Native types
			$this->register(new IntParser());
			$this->register(new BoolParser());
			$this->register(new FloatParser());
			$this->register(new StringParser());
		}
	}

	/**
	 * Register a parser to the pool.
	 * This method will override the previous parser for a class.
	 *
	 * @param Parser $parser The parser to register.
	 */
	public function register(Parser $parser): void {
		$this->pool[$parser->defineTargetClass()] = $parser;
	}

	/**
	 * Get the parser for a class.
	 *
	 * @param class-string $className The name of the class to get the parser for.
	 *
	 * @return Parser|null The parser to use, or null if none is found.
	 */
	public function getParser(string $className): ?Parser {
		return $this->pool[$className] ?? null;
	}
}
