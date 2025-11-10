<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * Subclass for {@see Article}.
 */
class ArticleRelatedArticle {
	public function __construct(
		public readonly int $id,
		public readonly string $title,
		public readonly ?ArticleAuthor $author,
	) {
	}
}
