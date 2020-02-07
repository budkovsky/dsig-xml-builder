#!/bin/bash

source bin/vars.sh

if [ -z "$1" ]
then
    PARAM=tests
else
    PARAM=$1
fi

docker exec -ti ${CONTAINER_NAME} ./vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox $PARAM