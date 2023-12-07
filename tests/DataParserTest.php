<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests;

use DateTime;
use Intellex\DataParser\Tests\Entities\AllSupported;
use Intellex\DataParser\Tests\Entities\Article;
use Intellex\DataParser\Tests\Entities\Ranking;
use Intellex\DataParser\Tests\Entities\SuperSimple;
use Intellex\DataParser\Tests\Entities\User;
use Intellex\DataParser\DataParser;
use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\TestCase;

class DataParserTest extends TestCase {

	private DataParser $dataParser;

	public function setUp(): void {
		$this->dataParser = new DataParser();
	}

	public function testSuperSimple(): void {
		/** @var SuperSimple $obj */
		[ $obj, $data ] = $this->loadEntity();

		$this->assertEquals($data['id'], $obj->getId());
	}

	public function testUser(): void {
		/** @var User $obj */
		[ $obj, $data ] = $this->loadEntity();

		$this->assertEquals($data['first_name'], $obj->getFirstName());
		$this->assertEquals($data['last_name'], $obj->getLastName());
		$this->assertEquals($data['email'], $obj->getEmail());
	}

	public function testRanking(): void {
		/** @var Ranking[] $obj */
		[ $obj, $data ] = $this->loadEntity(true);

		foreach ($data as $i => $ranking) {
			$this->assertEquals($ranking['rank'], $obj[$i]->getRank());
			$this->assertEquals($ranking['points'], $obj[$i]->getPoints());
			$this->assertEquals($ranking['name'], $obj[$i]->getName());
		}
	}

	public function testAllSupported(): void {
		/** @var AllSupported $obj */
		[ $obj, $data ] = $this->loadEntity();

		$this->assertEquals($data['id'], $obj->getId());
		$this->assertEquals($data['parent_id'], $obj->getParentId());
		$this->assertEquals($data['price'], $obj->getPrice());
		$this->assertEquals($data['discount'], $obj->getDiscount());
		$this->assertEquals($data['is_available'], $obj->isAvailable());
		$this->assertEquals($data['is_promoted'], $obj->isPromoted());
		$this->assertEquals($data['name'], $obj->getName());
		$this->assertEquals($data['alternative_name'], $obj->getAlternativeName());
		$this->assertEquals(DateTime::createFromFormat('Y-d-m H:i:s', $data['available_until']), $obj->getAvailableUntil());
		$this->assertEquals($data['promotion_ends'], $obj->getPromotionEnds());
	}

	public function testArticle(): void {
		/** @var Article $article */
		[ $article, $data ] = $this->loadEntity();

		$this->assertEquals($data['id'], $article->getId());
		$this->assertEquals($data['title'], $article->getTitle());
		$this->assertEquals($data['rating'], $article->getRating());
		$this->assertEquals($data['new'], $article->isNew());
		$this->assertEquals($data['approved'], $article->isApproved());
		$this->assertEquals(DateTime::createFromFormat('Y-d-m H:i:s', $data['published']), $article->getPublished());

		$category = $article->getCategory();
		$this->assertEquals($data['category']['id'], $category->getId());
		$this->assertEquals($data['category']['name'], $category->getName());
		$this->assertEquals($data['category']['parent_id'], $category->getParentId());

		$author = $article->getAuthor();
		$this->assertEquals($data['author']['id'], $author->getId());
		$this->assertEquals($data['author']['name'], $author->getName());

		$this->assertEquals($data['tags'], $article->getTags());
		$this->assertEquals($data['meta'], $article->getMeta());

		$relatedObjects = $article->getRelated();
		foreach ($data['related'] as $i => $relatedData) {
			$this->assertEquals($relatedData['id'], $relatedObjects[$i]->getId());
			$this->assertEquals($relatedData['title'], $relatedObjects[$i]->getTitle());
			$this->assertEquals($relatedData['author']['id'], $relatedObjects[$i]->getAuthor()->getId());
			$this->assertEquals($relatedData['author']['name'], $relatedObjects[$i]->getAuthor()->getName());
		}
	}

	/**
	 * @param bool $arrayInput Set to true to parse the input data as an array, false as a single object.
	 *
	 * @return array{object, array} The tuple containing the fully loaded class and the data.
	 * @noinspection PhpIncludeInspection
	 */
	private function loadEntity(bool $arrayInput = false): array {

		// Load the class we want to load from the name of the function this method was called from
		$functionName = debug_backtrace()[1]['function'];
		$baseClassName = substr($functionName, 4);
		$fullClassName = implode("\\", [ "Intellex", "DataParser", "Tests", "Entities", $baseClassName ]);

		// Load the data
		$arraySuffix = $arrayInput ? '-array' : '';
		$data = require __DIR__ . "/Data/{$baseClassName}.data{$arraySuffix}.php";

		// Handle either as a single object or an array of objects
		$result = $arrayInput
			? $this->dataParser->parseArray($fullClassName, $data)
			: $this->dataParser->parse($fullClassName, $data);

		// Return both the final result and the input data
		return [ $result, $data ];
	}
}

// Quick and dirty debug
if (!function_exists('dd')) {
	/** @noinspection PhpUnused */
	#[NoReturn] function dd(): void {
		$vars = func_get_args();
		foreach ($vars as $var) {
			echo "\n\n============================================================================================\n\n";
			print_r($var);
		}
		echo "\n\n=============================================================================================\n\n";
		die;
	}
}
