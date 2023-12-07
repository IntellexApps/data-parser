<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * Used to test the very basic functionality.
 */
class SuperSimple {

	private int $id;

	public function getId(): int {
		return $this->id;
	}
}
