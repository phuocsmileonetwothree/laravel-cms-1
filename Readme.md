# Install new laravel 10 or newest
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
    "phpcorp/laravel-cms": "dev-main"
},
## Update composer.lock
composer update
composer install
# Publish all assets from Laravel CMS (need --force for override)
php artisan vendor:publish --tag=laravel-cms-all --force
# Run migrate , helper , service provider , build assets, starting serve
## Thêm các câu lệnh vào file database\seeders\DatabaseSeeder.php
use Database\Seeders\CMS\CategoryTypeSeeder;
use Database\Seeders\CMS\TemplateSeeder;
$this->call([
    TemplateSeeder::class,
    CategoryTypeSeeder::class,
]);


## Định nghĩa các file Helpers vào file composer.json (object composer.json['autoload'])
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

## Thêm các câu lệnh vào app\Providers\AppServiceProvider.php function boot()
use App\Models\CMS\Page;
use Illuminate\Support\Facades\View;
$this->loadRoutesFrom(base_path('routes/web_cms.php'));
View::share('globalData', [
    'menu' => Page::where('parent_id', NULL)->with('childrens')->orderBy('order')->get(),
]);

## Comment route '/' in routes\web.php
// Route::get('/', function () {
//     return view('welcome');
// });

## Run assets
npm run build
npm run dev

## Starting Serve
php artisan serve

# Follow URL CMS Admin
http://example/cms/
http://127.0.0.1:8000/cms

# Create page home and follow URL end point for user
http://example/
http://127.0.0.1:8000
