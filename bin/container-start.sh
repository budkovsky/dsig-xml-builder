#!/bin/bash

source bin/vars.sh

if [ "$(docker ps -q -f name=${CONTAINER_NAME})" ] 
then
	echo "container ${CONTAINER_NAME} is already working, nothing to do"
	exit 0
fi

if [ "$(docker ps -qa -f name=${CONTAINER_NAME})" ]
then
	docker start ${CONTAINER_NAME}
	echo "container ${CONTAINER_NAME} has been started"
	exit 0
fi

./bin/container-run.sh

exit 0