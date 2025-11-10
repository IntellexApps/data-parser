<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * A user that wrote a {@see Comment}.
 */
class ArticleCommentUser {
	public function __construct(
		public readonly int $id,
		public readonly string $name,
		public readonly string $lastName,
		public readonly ?string $email,
		public readonly bool $isActive,
	) {
	}
}
