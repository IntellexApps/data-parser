<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Reflection;

use Intellex\DataParser\Exceptions\InvalidArrayItemType;
use Intellex\DataParser\ReflectionHelper;
use Intellex\DataParser\Tests\AbstractTestBase;
use Intellex\DataParser\Tests\Reflection\Cases\CommentInvalid1;
use Intellex\DataParser\Tests\Reflection\Cases\CommentInvalid2;
use Intellex\DataParser\Tests\Reflection\Cases\CommentInvalid3;
use Intellex\DataParser\Tests\Reflection\Cases\CommentMissing;
use Intellex\DataParser\Tests\Reflection\Cases\UndefinedArray;
use Intellex\DataParser\Tests\Reflection\Cases\WithSlashPrefix;
use Intellex\DataParser\Tests\Reflection\Cases\WithoutSlashPrefix;
use Intellex\DataParser\Tests\Reflection\Cases\UndefinedArrayNullable;
use Intellex\DataParser\Tests\Reflection\Cases\WithSlashPrefixNullable;
use Intellex\DataParser\Tests\Reflection\Cases\WithoutSlashPrefixNullable;
use ReflectionException;
use ReflectionProperty;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'cases.php';

class ReflectionHelperTest extends AbstractTestBase {

	/**
	 * @throws ReflectionException
	 * @see testExtractArrayItemType()
	 */
	public static function provideExtractArrayItemType(): array {
		return array_map(static fn(string $className) => [
			new ReflectionProperty($className, "property"),
			$className::EXPECTED,
		], [
			UndefinedArray::class,
			WithSlashPrefix::class,
			WithoutSlashPrefix::class,
			UndefinedArrayNullable::class,
			WithSlashPrefixNullable::class,
			WithoutSlashPrefixNullable::class,
		]);
	}

	/** @dataProvider provideExtractArrayItemType() */
	public function testExtractArrayItemType(ReflectionProperty $property, ?string $expected): void {
		$actual = ReflectionHelper::extractArrayItemType($property);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @throws ReflectionException
	 * @see testExtractArrayItemTypeException()
	 */
	public static function provideExtractArrayItemTypeException(): array {
		return array_map(
			static fn(string $className) => [ new ReflectionProperty($className, "property") ],
			[
				CommentMissing::class,
				CommentInvalid1::class,
				CommentInvalid2::class,
				CommentInvalid3::class,
			]);
	}

	/** @dataProvider provideExtractArrayItemTypeException() */
	public function testExtractArrayItemTypeException(ReflectionProperty $property): void {
		$className = $property->getDeclaringClass()->getName();
		$this->expectException(InvalidArrayItemType::class);
		$this->expectExceptionMessage("Unable to read item type for array property: {$className}::{$property->name}");
		ReflectionHelper::extractArrayItemType($property);
	}
}
