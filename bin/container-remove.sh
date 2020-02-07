#!/bin/bash
source bin/vars.sh

./bin/container-stop.sh

if [ "$(docker ps -qa -f name=${CONTAINER_NAME})" ] 
then
#remove container, if exists
	docker rm ${CONTAINER_NAME} $@ && echo "container ${CONTAINER_NAME} removed"
else
	echo "container ${CONTAINER_NAME} does not exists"
fi

exit 0

