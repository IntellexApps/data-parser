<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Cases;

use DateTime;
use Intellex\DataParser\Tests\AbstractTestBase;
use Intellex\DataParser\Tests\Entities\AllSupported;

/**
 * @todo Handle non-existent data for nullable values
 */
class AllSupportedNativeTest extends AbstractTestBase {

	public function testWithoutNullValues(): void {
		$this->assertParsedObject(
			new AllSupported(
				100,
				63,
				1.99,
				-2.99,
				true,
				false,
				"Bread",
				"White bread",
				new DateTime('2025-10-24 10:50:44'),
				new DateTime('2000-01-01 00:00:00')),
			[
				'id'              => 100,
				'parentId'        => 63,
				'price'           => 1.99,
				'discount'        => -2.99,
				'isAvailable'     => true,
				'isPromoted'      => false,
				'name'            => "Bread",
				'alternativeName' => "White bread",
				'availableUntil'  => '2025-10-24 10:50:44',
				'promotionEnds'   => '2000-01-01' ],
		);
	}

	public function testWithNullValues(): void {
		$this->assertParsedObject(
			new AllSupported(
				45,
				null,
				1.99,
				null,
				true,
				null,
				"Beans",
				null,
				new DateTime('2025-10-24 10:50:44'),
				null),
			[
				'id'              => 45,
				'parentId'        => null,
				'price'           => 1.99,
				'discount'        => null,
				'isAvailable'     => true,
				'isPromoted'      => null,
				'name'            => "Beans",
				'alternativeName' => null,
				'availableUntil'  => new DateTime('2025-10-24 10:50:44'),
				'promotionEnds'   => null ]
		);
	}
}
