<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Parsers;

use Intellex\DataParser\Parsers\NativeTypes\IntParser;
use Intellex\DataParser\Tests\AbstractTestBase;

class IntParserTest extends AbstractTestBase {

	/** @see testValidIntValues() */
	public static function provideValidIntValues(): iterable {
		return [
			[ null, null ],
			[ 1, 1 ],
			[ -92, -92 ],
			[ "16", 16 ],
			[ "-801", -801 ],
			[ 4.2, 4 ],
			[ 99.999, 99 ],
			[ "+919.8878", 919 ],
			[ PHP_INT_MIN, PHP_INT_MIN ],
			[ PHP_INT_MAX, PHP_INT_MAX ],
		];
	}

	/** @dataProvider provideValidIntValues() */
	public function testValidIntValues(mixed $input, ?int $expected): void {
		$parser = new IntParser();
		$this->assertEquals($expected, $parser->parse($input));
	}
}
