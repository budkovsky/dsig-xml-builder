#!/bin/bash

if [ -z "$1" ]
then
    PARAM=tests
else
    PARAM=$1
fi

docker exec -ti dsig-php71 ./vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox $PARAM