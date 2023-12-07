# Parse arrays into objects

- Simple to use
- Lightweight, no additional libraries used
- Handles object arrays from the comment

Installation
--------------------

`composer require intellexapps/data-parser`

Usage
--------------------

```php
use Intellex\DataParser\DataParser;

// Classes
class User {
    public int $id;
    public string $name;
    public Car $car;
    /** @var Role[] */ public array $roles;
}
class Car {
    public string $manufacturer;
    public string $model;
    public int $year;
}
class Role {
    public string $module;
    public string $access;
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

Arrays
--------------------

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

Credits
--------------------
Written by the [Intellex](https://intellex.rs/en) team.
