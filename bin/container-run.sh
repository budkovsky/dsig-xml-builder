#!/bin/bash
source bin/vars.sh

if [ "$(docker ps -q -f name=${CONTAINER_NAME})" ] 
then
#container is running, nothing to do
	exit 0
fi

if [ "$(docker ps -qa -f name=${CONTAINER_NAME})" ]
then
	#container stopped, start needed only
	docker start ${CONTAINER_NAME}
	exit 0
fi

if [ ! "$(docker image ls ${CONTAINER_NAME})" ]
then
	docker build -t ${CONTAINER_NAME} $(pwd)/${DOCKERFILE_PATH}
fi 

#run container 
docker run -t -d -v /$(pwd)://app -w //app --name=${CONTAINER_NAME} ${CONTAINER_NAME}
exit 0