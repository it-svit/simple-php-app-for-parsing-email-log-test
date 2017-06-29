#!/bin/bash

# create the network
docker network create test-app

# start the mysql container
docker run -d --net test-app -p 3382:3306 --env="MYSQL_ROOT_PASSWORD=strongpassword" --name db mysql

# start the laravel app container
docker run --net test-app -p 8082:80 -v $PWD:/app/ -d   -e WEB_DOCUMENT_ROOT=/app/public --name test webdevops/php-apache
