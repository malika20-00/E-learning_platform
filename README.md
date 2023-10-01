## Installation & building the env

docker-compose up -d --build

## Starting the env

docker-compose up -d --no-recreate --remove-orphans

## Rebuilding after adding a container or a config

docker-compose up -d --force-recreate

## starting application

Adding this line to /etc/hosts

127.0.0.1 pfe.d9.sqli.com