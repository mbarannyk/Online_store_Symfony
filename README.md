# Online_store_Symfony

Склонуйте даний репозиторій:

    git clone https://github.com/mbarannyk/Online_store_Symfony.git folder

де folder - назва папки з майбутнім проектом.

Виконайте наступну команду у терміналі:

    sudo docker compose up -d

Перейдіть у папку проекту

    cd project

та виконайте наступну команду

    sudo docker exec -it project_php-fpm bash

У контейнері, що відкрився, виконайте

    composer install
    exit

Перейдіть у контейнер mysql

    sudo docker exec -it project_mysql bash

Виконайте

    mysql -h 127.0.0.1 -u root -proot
    create database Online_store;
    exit

Вихід із контейнера mysql

    exit

Вийдіть в головну папку проекту

    сd ..

Імпортуйте дані з дампу у БД Online_store

    docker exec -i project_mysql mysql -uroot -proot Online_store < /dbDump/DBdump.sql

