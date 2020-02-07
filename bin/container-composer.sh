#!/bin/bash

source bin/vars.sh

./bin/container-start.sh

docker exec -ti ${CONTAINER_NAME} composer $@