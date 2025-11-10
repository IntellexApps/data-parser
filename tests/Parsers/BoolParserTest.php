<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Parsers;

use Intellex\DataParser\Parsers\NativeTypes\BoolParser;
use Intellex\DataParser\Tests\AbstractTestBase;

class BoolParserTest extends AbstractTestBase {

	/** @see testValidBoolValues() */
	public static function provideValidBoolValues(): iterable {
		return [
			[ null, null ],
			[ false, null, true ],
			[ false, "" ],
			[ false, " " ],
			[ false, 0 ],
			[ false, false ],
			[ false, "0" ],
			[ false, "f" ],
			[ false, " F " ],
			[ false, "False" ],
			[ false, "0" ],
			[ false, "N" ],
			[ false, "no" ],
			[ false, "off" ],
			[ false, " NULL " ],
			[ true, 1 ],
			[ true, -1 ],
			[ true, true ],
			[ true, "1" ],
			[ true, "-1" ],
			[ true, "T" ],
			[ true, "true" ],
			[ true, "y" ],
			[ true, "YES" ],
			[ true, "ON" ],
			[ true, "whatever..." ],
		];
	}

	/** @dataProvider provideValidBoolValues() */
	public function testValidBoolValues(?bool $expected, mixed $input, bool $nullable = false): void {
		$parser = new BoolParser($nullable);
		$this->assertEquals($expected, $parser->parse($input));
	}
}
