<?php declare(strict_types = 1);

namespace Intellex\DataParser\Parsers\NativeClasses;

use DateTime;
use DateTimeZone;
use Intellex\DataParser\Exceptions\ValueCannotBeParsed;
use Intellex\DataParser\Parsers\Parser;
use Stringable;

/**
 * Parse a value to a PHP native DateTime.
 *
 * @template-implements Parser<DateTime>
 */
class DateTimeParser implements Parser {

	public function __construct(
		/** @var string $formats The list of formats used to use to try to parse the date from a string. */
		public readonly array $formats = [ "Y-m-d H:i:s" ],
		/** @var string $timezone The timezone to use, or null for automatic.Z */
		public readonly ?DateTimeZone $timezone = null,
	) {
	}

	/** @inheritdoc */
	public function parse(mixed $value): ?DateTime {

		// Assert: There is something to do
		if ($value === null || $value instanceof DateTime) {
			return $value;
		}

		// Assert: Value can be cast to a string
		if (!is_string($value) && !($value instanceof Stringable)) {
			throw new ValueCannotBeParsed($this->targetClass(), $value);
		}

		// Convert to string
		$value = (string) $value;

		// If only date part is present, append time
		if (strlen($value) === 10) {
			$value .= " 00:00:00";
		}

		// Handle other representations
		foreach ($this->formats as $format) {
			$datetime = DateTime::createFromFormat($format, $value);
			if ($datetime !== false) {
				return $datetime;
			}
		}

		throw new ValueCannotBeParsed($this->targetClass(), $value);
	}

	/** @inheritdoc */
	public function targetClass(): string {
		return DateTime::class;
	}
}
