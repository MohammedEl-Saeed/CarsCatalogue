
## Main Steps to run project successully 

- composer install.
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- use api/register to create account and using it to login and auth cars apis.
- use api/login and use the returned key to auth.
- now you can use api/cars resource as required from sheet.
