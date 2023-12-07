<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * Subclass for {@see Article}.
 */
class ArticleRelatedArticle {

	private int $id;

	private string $title;

	private ?ArticleAuthor $author;

	public function getId(): int {
		return $this->id;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function getAuthor(): ?ArticleAuthor {
		return $this->author;
	}
}
