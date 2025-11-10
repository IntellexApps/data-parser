<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

use DateTime;

/**
 * Contains all the supported native types.
 */
class AllSupported {

	public function __construct(
		public readonly int $id,
		public readonly ?int $parentId,
		public readonly float $price,
		public readonly ?float $discount,
		public readonly bool $isAvailable,
		public readonly ?bool $isPromoted,
		public readonly string $name,
		public readonly ?string $alternativeName,
		public readonly DateTime $availableUntil,
		public readonly ?DateTime $promotionEnds,
	) {
	}
}
