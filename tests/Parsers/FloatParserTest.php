<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Parsers;

use Intellex\DataParser\Parsers\NativeTypes\FloatParser;
use Intellex\DataParser\Tests\AbstractTestBase;

class FloatParserTest extends AbstractTestBase {

	/** @see testValidFloatValues() */
	public static function provideValidFloatValues(): iterable {
		return [
			[ null, null ],
			[ 1, 1 ],
			[ -92, -92 ],
			[ "16", 16 ],
			[ "-801", -801 ],
			[ 4.2, 4.2 ],
			[ 99.999, 99.999 ],
			[ "+919.8878", 919.8878 ],
			[ PHP_INT_MIN, PHP_INT_MIN ],
			[ PHP_INT_MAX, PHP_INT_MAX ],
		];
	}

	/** @dataProvider provideValidFloatValues() */
	public function testValidFloatValues(mixed $input, ?float $expected): void {
		$parser = new FloatParser();
		$this->assertEquals($expected, $parser->parse($input));
	}
}
