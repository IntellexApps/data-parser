<?php return [
	'id'        => 280,
	'title'     => "Something happened",
	'rating'    => null,
	'new'       => true,
	'approved'  => true,
	'published' => '2023-11-09 11:17:02',
	'category'  => [
		'id'        => 22,
		'parent_id' => null,
		'name'      => 'article'
	],
	'author'    => [
		'id'   => 90,
		'name' => 'Max George',
	],
	'tags'      => [
		'tag',
		'article',
		'happening'
	],
	'related'   => [
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
			'id'     => 250,
			'title'  => "Nonsense...",
			'author' => [
				'id'   => 31,
				'name' => 'Humble Pavel',
			]
		]
	],
	'meta'      => [
		'mark'        => null,
		'events'      => [ 123, 9012, 1, 'approved' ],
		'approved_by' => [
			'id'    => 14,
			'email' => 'approver@gmail.com',
		]
	]
];
