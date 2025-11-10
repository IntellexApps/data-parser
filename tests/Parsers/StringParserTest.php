<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Parsers;

use Intellex\DataParser\Parsers\NativeTypes\StringParser;
use Intellex\DataParser\Tests\AbstractTestBase;

class StringParserTest extends AbstractTestBase {

	/** @see testValidStringValues() */
	public static function provideValidStringValues(): iterable {
		return [
			[ false, null, null ],
			[ false, "", "" ],
			[ false, " ", " " ],
			[ false, " : ", " : " ],
			[ false, 0, "0" ],
			[ false, 28, "28" ],
			[ false, true, "true" ],
			[ false, false, "false" ],
			[ false, 3.1416, "3.1416" ],
			[ true, "", "" ],
			[ true, " suffix", "suffix" ],
			[ true, " :	", ":" ],
			[ true, "DataParser ", "DataParser" ],
		];
	}

	/** @dataProvider provideValidStringValues() */
	public function testValidStringValues(bool $autoTrim, mixed $input, ?string $expected): void {
		$parser = new StringParser($autoTrim);
		$this->assertEquals($expected, $parser->parse($input));
	}
}
