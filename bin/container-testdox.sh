#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
source ${DIR}/vars.sh

if [ -z "$1" ]
then
    PARAM=tests
else
    PARAM=$1
fi

docker exec -ti ${CONTAINER_NAME} ./vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox $PARAM