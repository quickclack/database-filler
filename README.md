# Laravel database filler

[Quickclack/Fillers](https://packagist.org/packages/quickclack/database-filler)

This package will help you update database data using php classes

## Installation
```
composer require quickclack/database-filler:dev-master
```

## Usage

```
created directory fillers in ./database

php artisan make:filler UpdateProductPriceFiller

    <?php
    
    declare(strict_types = 1);
    
    return new class
    {
        public function run(): void
        {
            DB::table('prices')
                ->where('product_id', '=', 1)
                ->update([
                    'price' => 18.99
                ]);
        }
    };

php artisan db:fill
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
