# Convertedin-task
For First time Setup plz run the following commands:

docker-compose up --build -d
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan config:cache
docker-compose exec db bash -c 'echo "GRANT ALL ON laravel_web.* TO '\''convertedIn'\''@'\''%'\'' IDENTIFIED BY '\''P@ssword'\'';" | mysql -u root -p"password"'
docker-compose exec db_testing bash -c 'echo "GRANT ALL ON test_database.* TO '\''convertedIn'\''@'\''%'\'' IDENTIFIED BY '\''P@ssword'\''; FLUSH PRIVILEGES;" | mysql -u root -p"password"'
docker-compose exec app php artisan migrate --database=mysql
docker-compose exec app php artisan migrate --database=mysql_testing
docker-compose exec app php artisan db:seed

On Subsequents run only run the follwing:
docker-compose up --build -d


DataBase Views :
Development:db
http://localhost:8080/adminer
system:MySQL
server :db
username:convertedIn
passsword P@ssword

Testing:db
http://localhost:8080/adminer
system:MySQL
server :db_testing
username:convertedIn
passsword P@ssword

Access the Dashboard : localhost/login
