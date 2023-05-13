# Convertedin-task
For First time Setup run the following commands:
<pre>
docker-compose up --build -d<br>
docker-compose exec app composer install<br>
docker-compose exec app php artisan key:generate<br>
docker-compose exec app php artisan config:cache<br>
docker-compose exec db bash -c 'echo "GRANT ALL ON laravel_web.* TO '\''convertedIn'\''@'\''%'\'' IDENTIFIED BY '\''P@ssword'\'';" | mysql -u root -p"password"'<br>
docker-compose exec db_testing bash -c 'echo "GRANT ALL ON test_database.* TO '\''convertedIn'\''@'\''%'\'' IDENTIFIED BY '\''P@ssword'\''; FLUSH PRIVILEGES;" | mysql -u root -p"password"'<br>
docker-compose exec app php artisan migrate --database=mysql<br>
docker-compose exec app php artisan migrate --database=mysql_testing<br>
docker-compose exec app php artisan db:seed<br>
</pre>

On Subsequents runs only run the follwing:<br>
<pre>
docker-compose up --build -d<br>
</pre>

DataBase View :<br>
<pre>
Development:db<br>
http://localhost:8080/adminer<br>
system:MySQL<br>
server :db<br>
username:convertedIn<br>
passsword P@ssword<br>
</pre>
Testing database View:db<br>
<pre>
http://localhost:8080/adminer<br>
system:MySQL<br>
server :db_testing<br>
username:convertedIn<br>
passsword P@ssword<br>
</pre>
Access the Dashboard : 
<pre>
localhost/login
</pre>

