#!/bin/bash

# Wait a few seconds to ensure DB is ready
sleep 5

# Run Laravel migrations
php artisan migrate --force

# Start Apache
apache2-foreground
