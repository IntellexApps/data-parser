<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * Subclass for {@see Article}.
 */
class ArticleAuthor {

	private int $id;

	private string $name;

	public function getId(): int {
		return $this->id;
	}

	public function getName(): string {
		return $this->name;
	}
}
