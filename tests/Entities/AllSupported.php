<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

use DateTime;

/**
 * Contains all the supported native types.
 */
class AllSupported {

	private int $id;

	private ?int $parentId;

	private float $price;

	private ?float $discount;

	private bool $isAvailable;

	private bool $isPromoted;

	private string $name;

	private ?string $alternativeName;

	private DateTime $availableUntil;

	private ?DateTime $promotionEnds;

	public function getId(): int {
		return $this->id;
	}

	public function getParentId(): ?int {
		return $this->parentId;
	}

	public function getPrice(): float {
		return $this->price;
	}

	public function getDiscount(): ?float {
		return $this->discount;
	}

	public function isAvailable(): bool {
		return $this->isAvailable;
	}

	public function isPromoted(): bool {
		return $this->isPromoted;
	}

	public function getName(): string {
		return $this->name;
	}

	public function getAlternativeName(): ?string {
		return $this->alternativeName;
	}

	public function getAvailableUntil(): DateTime {
		return $this->availableUntil;
	}

	public function getPromotionEnds(): ?DateTime {
		return $this->promotionEnds;
	}
}
