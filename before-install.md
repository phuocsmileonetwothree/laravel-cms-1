# Add repo require
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/phpphamhuuphuoc/laravel-cms.git"
    }
],

# Add dev repo for test
"require": {
    "phpphamhuuphuoc/laravel-cms": "dev-main"
},

# Update composer.lock
composer update
composer install