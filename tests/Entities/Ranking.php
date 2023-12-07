<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * Used to test the parsing of arrays.
 */
class Ranking {

	private int $rank;

	private int $points;

	private string $name;

	public function getRank(): int {
		return $this->rank;
	}

	public function getPoints(): int {
		return $this->points;
	}

	public function getName(): string {
		return $this->name;
	}
}
