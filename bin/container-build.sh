#!/bin/bash

source bin/vars.sh

if [ ! "$(docker image ls ${CONTAINER_NAME} | grep ${CONTAINER_NAME})" ]
then
	docker build -t ${CONTAINER_NAME} $(pwd)/${DOCKERFILE_PATH}
fi

exit 0