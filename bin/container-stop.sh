#!/bin/bash
source bin/vars.sh

if [ "$(docker ps -q -f name=${CONTAINER_NAME})" ] 
then
	docker stop ${CONTAINER_NAME} && echo "container ${CONTAINER_NAME} stopped"
else
	echo "container ${CONTAINER_NAME} is not run"
fi

exit 0