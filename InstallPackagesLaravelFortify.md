Install Packages
Install Laravel Fortify and Laravel UI AdminLTE by the following command,

composer require laravel/fortify infyomlabs/laravel-ui-adminlte

Publish Fortify Resources
This command will publish all required actions in the app/Actions directory along with the Fortify configuration file and migration for two-factor authentication.

php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"

Run Migrations
Then run migrations,

php artisan migrate

Add Fortify Service Provider
Next step, add published FortifyServiceProvider to config/app.php

Run AdminLTE Fortify Command
Run the following command,

php artisan ui adminlte-fortify --auth

Install Node Modules and Run a Build
As a next step, install required npm modules and run a build,

npm install && npm run dev

And we are done. Now visit the home page and you should be able to see the full authentication system working including,

Login Registration Forgot Password Reset Password Home page

Laravel AdminLTE UI also provides a starting layout with a sidebar menu and header once you login. so you are all set to go.