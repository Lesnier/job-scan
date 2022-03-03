#!/bin/bash

source .env.example
WWWGROUP=$(id -g);
export WWWGROUP
export WWWUSER=$UID;

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs \
    npm install \
    npm run dev;

vendor/bin/sail up --build -d;

vendor/bin/sail composer run post-root-package-install;
vendor/bin/sail composer run post-create-project-cmd;

vendor/bin/sail artisan migrate:fresh --seed;

