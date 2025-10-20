#!/bin/bash

sleep 5

php artisan migrate --force

apache2-foreground #start apache
