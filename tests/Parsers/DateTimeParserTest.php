<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Parsers;

use DateTime;
use Intellex\DataParser\Exceptions\ValueCannotBeParsed;
use Intellex\DataParser\Parsers\NativeClasses\DateTimeParser;
use Intellex\DataParser\Tests\AbstractTestBase;

/**
 * @todo Test timezones
 * @todo Test multiple formats
 * @todo Throw an error when a class is supplied, not a scalar, ie: stdClass()
 * @todo Handle dates that have more days than possible: "2000-07-30 01:24:29"
 */
class DateTimeParserTest extends AbstractTestBase {

	/** @see testValidDateTimeValues() */
	public static function provideValidDateTimeValues(): iterable {
		return [
			[ null, null ],
			[ "2025-11-10", new DateTime("2025-11-10 00:00:00") ],
			[ "1987-09-01 12:29:55", new DateTime("1987-09-01 12:29:55") ],
			[ new DateTime("2000-07-30 01:24:29"), new DateTime("2000-07-30 01:24:29") ],
		];
	}

	/** @dataProvider provideValidDateTimeValues() */
	public function testValidDateTimeValues(mixed $input, ?DateTime $expected): void {
		$parser = new DateTimeParser();
		$this->assertEquals($expected, $parser->parse($input));
	}

	/** @see testInvalidDateTimeValues() */
	public static function provideInvalidDateTimeValues(): iterable {
		return [
			[ "" ],
			[ "null" ],
			[ "25-10-10" ],
			[ "10/10/2025" ],
			[ "2025-12-12-00:00:00" ],
		];
	}

	/** @dataProvider provideInvalidDateTimeValues() */
	public function testInvalidDateTimeValues(mixed $input): void {
		$this->expectException(ValueCannotBeParsed::class);
		$parser = new DateTimeParser();
		$parser->parse($input);
	}
}
