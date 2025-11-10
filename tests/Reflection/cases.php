<?php /** @noinspection ALL */

namespace Intellex\DataParser\Tests\Reflection\Cases;

class UndefinedArray {
	public const EXPECTED = "array";

	public function __construct(
		/** @var array */
		public readonly array $property
	) {
	}
}

class WithoutSlashPrefix {
	public const EXPECTED = \Intellex\DataParser\ReflectionHelper::class;

	public function __construct(
		/** @var Intellex\DataParser\ReflectionHelper[] */
		public readonly array $property
	) {
	}
}

class WithSlashPrefix {
	public const EXPECTED = \Intellex\DataParser\ReflectionHelper::class;

	public function __construct(
		/** @var \Intellex\DataParser\ReflectionHelper[] */
		public readonly array $property
	) {
	}
}

class UndefinedArrayNullable {
	public const EXPECTED = "array";

	public function __construct(
		/** @var ?array */
		public readonly array $property
	) {
	}
}

class WithoutSlashPrefixNullable {
	public const EXPECTED = \Intellex\DataParser\ReflectionHelper::class;

	public function __construct(
		/** @var ?Intellex\DataParser\ReflectionHelper[] */
		public readonly array $property
	) {
	}
}

class WithSlashPrefixNullable {
	public const EXPECTED = \Intellex\DataParser\ReflectionHelper::class;

	public function __construct(
		/** @var ?\Intellex\DataParser\ReflectionHelper[] */
		public readonly array $property
	) {
	}
}

class CommentMissing {
	public function __construct(
		public readonly array $property
	) {
	}
}

class CommentInvalid1 {
	public function __construct(
		/** @property CommentInvalid[] */
		public readonly array $property
	) {
	}
}

class CommentInvalid2 {
	public function __construct(
		/** @var CommentInvalid */
		public readonly array $property
	) {
	}
}

class CommentInvalid3 {
	public function __construct(
		/** @var array<CommentInvalid> */
		public readonly array $property
	) {
	}
}
