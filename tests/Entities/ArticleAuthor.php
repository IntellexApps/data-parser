<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * The author or an {@see Article}.
 */
class ArticleAuthor {
	public function __construct(
		public readonly int $id,
		public readonly string $name,
	) {
	}
}
