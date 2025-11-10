<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

use DateTime;

/**
 * The most complicated example.
 */
class Article {
	public function __construct(
		public readonly int $id,
		public readonly string $title,
		public readonly ?float $rating,
		public readonly bool $new,
		public readonly ?DateTime $published,
		public readonly ArticleCategory $category,
		public readonly ArticleAuthor $author,
		public readonly ?ArticleAuthor $coauthor,
		/** @var string[] $tags */
		public readonly array $tags,
		/** @var \Intellex\DataParser\Tests\Entities\ArticleRelatedArticle[] $related */
		public readonly array $related,
		/** @var \Intellex\DataParser\Tests\Entities\ArticleAuthor[] $comments */
		public readonly array $contributors,
		public readonly bool $approved,
		/** @var ?\Intellex\DataParser\Tests\Entities\ArticleCommentUser[] $comments */
		public readonly ?array $moderators,
		/** @var \Intellex\DataParser\Tests\Entities\ArticleComment[] $comments */
		public readonly array $comments,
		/** @var array */
		public readonly array $meta,
	) {
	}
}