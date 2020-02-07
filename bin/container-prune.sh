#!/bin/bash
source bin/vars.sh

echo ${CONTAINER_NAME}

if [ "$(docker ps -q -f name=${CONTAINER_NAME})" ] 
then
#stop container if running
	docker stop ${CONTAINER_NAME}
fi

if [ "$(docker ps -qa -f name=${CONTAINER_NAME})" ] 
then
#remove container, if exists
	docker rm ${CONTAINER_NAME} $@
fi

if [ "$(docker image ls ${CONTAINER_NAME})" ] 
then
#remove image, if exists
	docker rmi ${CONTAINER_NAME}
fi