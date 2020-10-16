#!/usr/bin/bash

export APP_DOCKER="app"
export NGINX_DOCKER="webserver"
export MYSQL_DOCKER="db"
export DATABASE="laravel"
export DB_ROOT="root"
export DB_PASSWORD="your_mysql_root_password"
export LARAVEL_USER="laraveldb"
export LARAVEL_PASSWORD="laravelpassworddb"
export ACTIVE_USER_DATABASE="GRANT ALL ON ${DATABASE}.* TO '${LARAVEL_USER}'@'%' IDENTIFIED BY '${LARAVEL_PASSWORD}';";
export PRIVILEGES="FLUSH PRIVILEGES;"
