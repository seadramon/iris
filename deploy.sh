#!/bin/sh
docker-compose up -d --build iris_wton;
docker exec iris_wton bash -c "composer install;php artisan optimize:clear"
#docker restart nginx;
#docker restart dashboard;