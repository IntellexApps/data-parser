<?php declare(strict_types = 1);

namespace Intellex\DataParser\Tests\Cases;

use DateTime;
use Intellex\DataParser\Tests\AbstractTestBase;
use Intellex\DataParser\Tests\Entities\Article;
use Intellex\DataParser\Tests\Entities\ArticleAuthor;
use Intellex\DataParser\Tests\Entities\ArticleCategory;
use Intellex\DataParser\Tests\Entities\ArticleRelatedArticle;

class FullTest extends AbstractTestBase {

	public function testEverything(): void {
		$this->assertParsedObject(self::getExpected(), self::getData());
	}

	private static function getExpected(): Article {
		return new Article(
			280,
			"Something happened",
			null,
			true,
			new DateTime('2023-11-09 00:00:00'),
			new ArticleCategory(22, null, 'Culture'),
			new ArticleAuthor(90, "Max George"),
			null,
			[ 'tag', 'culture', 'article', 'happening' ],
			[
				new ArticleRelatedArticle(
					266,
					"Something happened, but what?",
					new ArticleAuthor(90, "Max George")
				),
				new ArticleRelatedArticle(
					252,
					"News id: 252",
					new ArticleAuthor(108, "Mini John")
				),
				new ArticleRelatedArticle(
					111,
					"Nonsense...",
					new ArticleAuthor(31, "Humble Pavel")
				),
			],
			[],
			false,
			null,
			[],
			[
				'mark'        => null,
				'time'        => "2025-11-02",
				'date'        => new DateTime('2023-11-01 00:00:00'),
				'events'      => [ 123, 9012, 1, 'approved' ],
				'approved_by' => [
					'id'    => 14,
					'email' => 'approver@gmail.com',
				]
			]
		);
	}

	private static function getData(): array {
		return [
			'id'           => 280,
			'title'        => "Something happened",
			'rating'       => null,
			'new'          => true,
			'published'    => '2023-11-09',
			'category'     => [
				'id'        => 22,
				'parent_id' => null,
				'name'      => 'Culture'
			],
			'author'       => [
				'id'   => 90,
				'name' => 'Max George',
			],
			'coauthor'     => null,
			'tags'         => [
				'tag',
				'culture',
				'article',
				'happening'
			],
			'contributors' => [],
			'approved'     => false,
			'moderators'   => null,
			'related'      => [
				[
					'id'     => 266,
					'title'  => "Something happened, but what?",
					'author' => [
						'id'   => 90,
						'name' => 'Max George',
					]
				],
				[
					'id'     => 252,
					'title'  => "News id: 252",
					'author' => [
						'id'   => 108,
						'name' => 'Mini John',
					]
				],
				[
					'id'     => 111,
					'title'  => "Nonsense...",
					'author' => [
						'id'   => 31,
						'name' => 'Humble Pavel',
					]
				]
			],
			'comments'     => null,
			'meta'         => [
				'mark'        => null,
				'time'        => "2025-11-02",
				'date'        => new DateTime('2023-11-01 00:00:00'),
				'events'      => [ 123, 9012, 1, 'approved' ],
				'approved_by' => [
					'id'    => 14,
					'email' => 'approver@gmail.com',
				]
			]
		];
	}
}
