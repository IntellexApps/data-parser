<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

use DateTime;

/**
 * The most complicated example.
 */
class Article {

	private int $id;

	private string $title;

	private ?float $rating;

	private bool $new;

	private bool $approved;

	private ?DateTime $published;

	private ?ArticleCategory $category;

	private ArticleAuthor $author;

	/** @var string[] $tags */
	private array $tags;

	/** @var ArticleRelatedArticle[] $related */
	private array $related;

	private array $meta;

	public function getId(): int {
		return $this->id;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function getRating(): ?float {
		return $this->rating;
	}

	public function isNew(): bool {
		return $this->new;
	}

	public function isApproved(): bool {
		return $this->approved;
	}

	public function getPublished(): ?DateTime {
		return $this->published;
	}

	public function getCategory(): ?ArticleCategory {
		return $this->category;
	}

	public function getAuthor(): ArticleAuthor {
		return $this->author;
	}

	/** @return string[] $tags */
	public function getTags(): array {
		return $this->tags;
	}

	/** @return ArticleRelatedArticle[] */
	public function getRelated(): array {
		return $this->related;
	}

	public function getMeta(): array {
		return $this->meta;
	}
}
