# Tutorial push notifications

demo :   
tutorial (FR) : 

This repository provides a base code to a PHP application with push notifications provided by socket.io.

# Technologies
 - *server* : Lumen
 - *push* : socket.io + elephant.io (socket.io PHP library)
 - *client* : AngularJS

# install

1. clone the project
2. run `composer install`
3. run `mv .env.example .env`
4. Open the .env file and update the APP_KEY and database information
5. Create a MySQL database 
6. run `php artisan migrate` to create tables
7. run `cd push; npm install` to install nodejs vendor (Express and socket.io)
8. run `npm start` to launch the push server
9. head over to `http://localhost:8000` and enjoy !


