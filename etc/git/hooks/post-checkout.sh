#!/usr/bin/env bash

echo "execute composer install"
docker exec -i click_php composer install
echo "execute composer install done"
