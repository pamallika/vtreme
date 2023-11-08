docker-composer up -d
composer install  
php artisan migrate  
php artisan db:seed  
php artisan queue:work  
php artisan schedule:work  
php artisan user:check_expiration  
php artisan user:member  
php artisan schedule:work  
