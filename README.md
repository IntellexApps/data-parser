# Parse arrays into objects

- Simple to use out of the box
- Handles object arrays from the comment

## Usage

`composer require intellex/data-parser`

```php
use Intellex\DataParser\DataParser;

// Classes
class User {
    public function __construct(
        public readonly int $id;
        public readonly string $name;
        public readonly Car $car;
        /** @var Role[] */
        public readonly array $roles;
    ) { }
}
class Car {
    public function __construct(
        public readonly string $manufacturer;
        public readonly string $model;
        public readonly int $year;
    ) { }
}
class Role {
    public function __construct(
        public readonly string $module;
        public readonly string $access;
    ) { }
}

// Data
$data = [
    'id' => 100,
    'name' => 'John Doe',
    'car' => [
        'manufacturer' => 'Volkswagen',
        'model' => 'Golf',
        'year' => 2023
    ],
    'roles' => [
        [ 'module' => 'news', 'access' => 'rw' ],
        [ 'module' => 'video', 'access' => 'r' ],
    ]
];

// Parse
$dataParser = new DataParser();
$user = $dataParser->parse(User::class, $data);
```

Output:

```
User Object
(
    [id] => 100
    [name] => John Doe
    [car] => Intellex\DataParser\Tests\Car Object
        (
            [manufacturer] => Volkswagen
            [model] => Golf
            [year] => 2023
        )

    [roles] => Array
        (
            [0] => Intellex\DataParser\Tests\Role Object
                (
                    [module] => news
                    [access] => rw
                )

            [1] => Intellex\DataParser\Tests\Role Object
                (
                    [module] => video
                    [access] => r
                )

        )

)
```

## Arrays

```php
use Intellex\DataParser\DataParser;

// Class
class User {
    public int $id;
    public string $name;
}

// Data
$data = [
    [ 'id' => 1, 'name' => 'John Doe' ],
    [ 'id' => 2, 'name' => 'Jane Doe' ]
];

// Parse
$dataParser = new DataParser();
$users = $dataParser->parseArray(User::class, $data);
```

## Credits

Written by the [Intellex team](https://intellex.rs/en).
