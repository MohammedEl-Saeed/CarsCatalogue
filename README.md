# CarsCatalogue


# API Endpoints:

• set of API endpoints for managing the cars:

• GET /api/cars - Fetch all cars.

• GET /api/cars/{id} - Fetch a single car by ID.

• POST /api/cars - Add a new car.

• PUT /api/cars/{id} - Update a car by ID.

• DELETE /api/cars/{id} - Delete a car by ID.


Bonus Features implemented:

1. Image Upload:

2. Pagination:


3. Authentication:


4. Relationship between user logged in and cars created:


## Main Steps to run project successully 

- composer install.
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- use api/register to create account and using it to login and auth cars apis.
- use api/login and use the returned key to auth.
- now you can use api/cars resource as required from sheet.
- php artisan test