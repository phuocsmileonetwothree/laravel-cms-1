# Install new laravel 10 or higher
composer create-project --prefer-dist laravel/laravel:^10.0 new-project
composer create-project --prefer-dist laravel/laravel new-project
# Install package
## Add repo in composer.json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/phpphamhuuphuoc/laravel-cms.git"
    }
],
## Add dev repo for test
"require": {
    "phpphamhuuphuoc/laravel-cms": "dev-main"
},
## Update composer.lock
composer update
composer install
# Publish all assets from Laravel CMS (need --force for override)
php artisan vendor:publish --tag=laravel-cms-all --force
# Step 3
## Thêm các câu lệnh vào file DatabaseSeeder.php
$this->call([
    TemplateSeeder::class,
    CategoryTypeSeeder::class,
]);


## Định nghĩa các file Helpers vào file composer.json
"files": [
    "app/Helpers/CMS/Dispatch.php",
    "app/Helpers/CMS/File.php",
    "app/Helpers/CMS/Path.php",
    "app/Helpers/CMS/String.php"
]

## Cập nhật autoload files
composer dump-autoload

## Migrate Database and Seeder
php artisan migrate
php artisan db:seed

## Install Vite Local
npm i 
npm update
npm install vite --save-dev

## Thêm các câu lệnh vào AppServiceProviders
$this->loadRoutesFrom(base_path('routes/web_cms.php'));
View::share('globalData', [
    'menu' => Page::where('parent_id', NULL)->with('childrens')->get(),
]);

## Comment route '/' in web.php
// Route::get('/', function () {
//     return view('welcome');
// });

## Run assets
npm run build
npm run dev

## Starting Serve
php artisan serve