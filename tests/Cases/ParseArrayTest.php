<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Cases;

use Intellex\DataParser\DataParser;
use Intellex\DataParser\Tests\AbstractTestBase;
use Intellex\DataParser\Tests\Entities\Arrays;
use Intellex\DataParser\Tests\Entities\SimpleModel;
use stdClass;

class ParseArrayTest extends AbstractTestBase {

	/** @see simpleArraysProviders() */
	public static function provideSimpleArrays(): array {
		return [
			[
				stdClass::class, [], [],
			],
			[
				SimpleModel::class,
				[ [ 'id' => 1, 'name' => "The first" ], [ 'id' => 2, 'name' => "The second" ], ],
				[ new SimpleModel(1, "The first"), new SimpleModel(2, "The second"), ],
			],
		];
	}

	/** @dataProvider provideSimpleArrays() */
	public function testSimpleArrays(string $className, array $input, array $expected): void {
		$dataParser = new DataParser();
		$actual = $dataParser->parseArray($className, $input);

		$this->assertParsedArray($expected, $actual);
	}

	/** @see complexArraysProvider() */
	public static function provideComplexArrays(): array {
		return [
			[
				[
					'anyArray'          => [],
					'anyNullableArray'  => null,
					'recursive'         => [],
					'nullableRecursive' => null,
				],
				new Arrays(
					[],
					null,
					[],
					null
				)
			],
			[
				// TODO: Test with or without configuration
				[
					'anyArray'          => null,
					'anyNullableArray'  => null,
					'recursive'         => null,
					'nullableRecursive' => null,
				],
				new Arrays(
					[],
					null,
					[],
					null
				)
			],
			[
				// TODO: Test with or without configuration
				[
					'anyArray'          => [
						[
							'id'   => 1,
							'name' => "One",
						],
					],
					'anyNullableArray'  => [
						[
							'id'   => 2,
							'name' => "Two",
						],
					],
					'recursive'         => [
						[
							'anyArray'          => [],
							'anyNullableArray'  => null,
							'recursive'         => [],
							'nullableRecursive' => null,
						],
					],
					'nullableRecursive' => [
						[
							'anyArray'          => [],
							'anyNullableArray'  => null,
							'recursive'         => [],
							'nullableRecursive' => null,
						],
					],
				],
				new Arrays(
					[
						[ 'id' => 1, 'name' => "One", ],
					],
					[
						[ 'id' => 2, 'name' => "Two", ],
					],
					[
						new Arrays([], null, [], null),
					],
					[
						new Arrays([], null, [], null),
					]
				)
			],
		];
	}

	/** @dataProvider provideComplexArrays */
	public function testComplexArrays(array $input, Arrays $expected): void {
		$dataParser = new DataParser();
		$actual = $dataParser->parse(Arrays::class, $input);

		$this->assertEquals($expected, $actual);
	}
}
