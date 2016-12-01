    sudo chmod -R 777 storage bootstrap
    composer install
    cp .env.example .env
    change .env to use 'sqlite' -> DB_CONNECTION=sqlite
    mkdir -p data
    touch storage/database.sqlite
    php artisan key:generate
    php artisan db:seed --class=RecipiesTableSeeder
    php artisan serve

# DB definition
    CREATE TABLE "main"."recipies" (
        "id" INTEGER NOT NULL,
        "created_at" TEXT NOT NULL,
        "updated_at" TEXT NOT NULL,
        "box_type" TEXT NOT NULL,
        "title" TEXT NOT NULL,
        "slug" TEXT NOT NULL,
        "short_title" TEXT NULL,
        "marketing_description" TEXT NOT NULL DEFAULT (0),
        "calories_kcal" INTEGER NOT NULL DEFAULT (0),
        "protein_grams" INTEGER NOT NULL DEFAULT (0),
        "fat_grams" INTEGER NOT NULL DEFAULT (0),
        "carbs_grams" INTEGER NOT NULL DEFAULT (0),
        "bulletpoint1" TEXT,
        "bulletpoint2" TEXT,
        "bulletpoint3" TEXT,
        "recipe_diet_type_id" TEXT,
        "season" TEXT,
        "base" TEXT,
        "protein_source" TEXT,
        "preparation_time_minutes" INTEGER NOT NULL DEFAULT (0),
        "shelf_life_days" INTEGER NOT NULL DEFAULT (0),
        "equipment_needed" TEXT,
        "origin_country" TEXT,
        "recipe_cuisine" TEXT,
        "in_your_box" TEXT,
        "gousto_reference" INTEGER NOT NULL DEFAULT (0)
    );



--------
<p align="center"><a href="https://laravel.com" target="_blank"><img width="150"src="https://laravel.com/laravel.png"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
