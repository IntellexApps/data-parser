<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

use DateTime;

/**
 * A single comment for an {@see Article}.
 */
class ArticleComment {
	public function __construct(
		public readonly string $comment,
		public readonly DateTime $created,
		public readonly ArticleCommentUser $user,
	) {
	}
}
