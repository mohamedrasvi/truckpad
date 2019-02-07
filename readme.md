# truckpad
Truckers registration basic RESTful API build by Lumen framework
# requirements
PHP >= 7.0<br />
OpenSSL PHP Extension<br />
PDO PHP Extension<br />
Mbstring PHP Extension<br />
MYSQL minimum version 5.5 or above
# Installation

Clone the repository from github  (git clone git@github.com:mohamedrasvi/truckpad.git) <br>
Run the command (composer install) to download all the dependencies.<br>
Copy the env.example file to env <br>
Change the Database credentials to yours on .env file <br>
Change the variable GMAP_API_KEY value to yours on .env file (Note you must have google api key)

Run the command (php artisan db:seed) to insert the sample data of vehicle's types
# Serving Your Application
To serve your project locally, you may use the Laravel Homestead virtual machine, Laravel Valet, local virtual or the built-in PHP development server: <br>
php -S localhost:8000/api/v1/ -t public <br>

# Endpoints 
**You can use Postman to test endpoints** <br><br>
POST /api/v1/trucks  (register truckers)<br>
parameters ex :<br>
name:Valaentine<br>
age:29<br>
sex:M<br>
trucks_code:3<br>
cnh:A<br>
is_own:N<br>
is_loaded:Y<br>
number:100<br>
street:cristiano viana<br>
neighborhood:Pinheiros<br>
city:São Paulo<br>
state:SP<br>
country:Brazil <br><br>
GET /api/v1/trucks (get all truckers)<br>
GET /api/v1/trucks-notloaded (get all unloaded truckers)<br>
POST /api/v1/trucks-filter (get all truckers by specific filters)<br>
**Example parameters to filter truckers**<br>
trucks_code:1 (filter by truck type)<br>
cnh:E (filter by truck CNH) <br>
is_loaded:N (filter by truck is loaded or not)<br>
date:monthly (filter by date daily,weekly,monthly)<br>
is_own:N (filter by truck's owners)<br>
Date parameter we can filter by one of these values ('daily','weekly','monthly')<br>

# Unit Test
Note I added vendor/bin/phpunit on composer.json file so you just have to call (composer test) on terminal to run the unit test



