<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * Subclass for {@see Article}.
 */
class ArticleCategory {

	private int $id;

	private ?int $parentId;

	private string $name;

	public function getId(): int {
		return $this->id;
	}

	public function getParentId(): ?int {
		return $this->parentId;
	}

	public function getName(): string {
		return $this->name;
	}
}
