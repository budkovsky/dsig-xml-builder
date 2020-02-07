#!/bin/bash
source bin/vars.sh

if [ "$(docker ps -qa -f name=${CONTAINER_NAME})" ]
then
	echo "container ${CONTAINER_NAME} exists, can't run"
	exit 0
fi

./bin/container-build.sh

#run container 
docker run -t -d -v /$(pwd)://app -w //app --name=${CONTAINER_NAME} ${CONTAINER_NAME} \
 	&& echo "container ${CONTAINER_NAME} created"
exit 0