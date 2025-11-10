<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * Simple model.
 */
class SimpleModel {
	public function __construct(
		public readonly int $id,
		public readonly string $name,
	) {
	}
}
