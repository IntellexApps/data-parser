<?php declare(strict_types = 1);

namespace Intellex\DataParser\Parsers\NativeClasses;

use DateTime;
use Intellex\DataParser\Exceptions\ValueCannotBeParsed;
use Intellex\DataParser\Parsers\Parser;

/**
 * Parse a value to a PHP native DateTime.
 *
 * @template-implements Parser<DateTime>
 */
class DateTimeParser implements Parser {

	/**
	 * @param string      $format   The format used to parse the datetime from a string.
	 * @param string|null $timezone The timezone to use when parsing the datetime from string.
	 */
	public function __construct(
		private readonly string $format = 'Y-d-m H:i:s',
		private readonly ?string $timezone = null
	) {
	}

	/** @inheritdoc */
	public function parse(mixed $value): DateTime {
		$datetime = DateTime::createFromFormat($this->format, $value, $this->timezone);
		if ($datetime === false) {
			throw new ValueCannotBeParsed(DateTime::class, $value);
		}

		return $datetime;
	}

	/** @inheritdoc */
	public function defineTargetClass(): string {
		return 'DateTime';
	}
}
