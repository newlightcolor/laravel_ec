
PROJECT_PATH=$(cd $(dirname $0);pwd)
PROJECT_DIR=`echo ${PROJECT_PATH##*/}`

cp $PROJECT_PATH/.env.local $PROJECT_PATH/.env
docker compose exec app /bin/sh -c "cd ${PROJECT_DIR} && composer update"
docker compose exec app /bin/sh -c "cd ${PROJECT_DIR} && php artisan migrate"
docker compose exec app /bin/sh -c "cd ${PROJECT_DIR} && php artisan db:seed"
# sudo chmod 777 -R ${PROJECT_PATH}