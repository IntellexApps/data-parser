<?php /** @noinspection PhpPropertyOnlyWrittenInspection */
declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Entities;

/**
 * Test fairly simple classes.
 */
class User {

	private string $firstName;

	private string $lastName;

	private string $email;

	public function getFirstName(): string {
		return $this->firstName;
	}

	public function getLastName(): string {
		return $this->lastName;
	}

	public function getEmail(): string {
		return $this->email;
	}
}
