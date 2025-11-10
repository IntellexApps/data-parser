<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests;

use Intellex\DataParser\DataParser;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestBase extends TestCase {

	/**
	 * Assert that the parsed data is equal to an actual data object.
	 *
	 * @param object       $expected The expected data object.
	 * @param array<mixed> $data     The data that should be parsed into a data object.
	 */
	protected function assertParsedObject(mixed $expected, array $data): void {
		$dataParser = new DataParser();
		$className = get_class($expected);
		$this->assertEquals($expected, $dataParser->parse($className, $data));
	}

	/**
	 * Assert two arrays are equals..
	 *
	 * @param array $expected The expected array of data objects.
	 * @param array $actual   The actual array of data objects.
	 */
	protected function assertParsedArray(array $expected, array $actual): void {

		// Assert: The structures of the both arrays
		$this->assertSameSize($expected, $actual);
		$this->assertEquals(array_keys($expected), array_keys($actual));

		// Assert: Same
		$this->assertEquals($expected, $actual);
	}
}
