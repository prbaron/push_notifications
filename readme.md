# Tutorial push notifications

This repository provide a base to a PHP application with push notifications provided by socket.io.

# Technologies
 - *server* : Lumen
 - *push* : socket.io + elephant.io (socket.io PHP library)
 - *client* : AngularJS

# install

1. clone the project
2. run `composer insall`
3. run `mv .env.example .en`
4. Open the .env file and update the APP_KEY and databases information
5. Create a MySQL database 
6. run `php artisan migrate` to create tables
7. run `npm install`
8. run `npm start` to launch the push server
9. head over `http://localhost:8000` and enjoy !


