<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * Test paring various input for arrays.
 */
class Arrays {
	public function __construct(
		/** @var array */
		public readonly array $anyArray,
		/** @var ?array */
		public readonly ?array $anyNullableArray,
		/** @var \Intellex\DataParser\Tests\Entities\Arrays[] $recursive */
		public readonly array $recursive,
		/** @var ?\Intellex\DataParser\Tests\Entities\Arrays[] $nullableRecursive */
		public readonly ?array $nullableRecursive,
	) {
	}
}
