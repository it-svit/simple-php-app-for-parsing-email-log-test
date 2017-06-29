#!/bin/bash

docker stop db
docker stop test
docker rm db
docker rm test
docker network rm test-app
