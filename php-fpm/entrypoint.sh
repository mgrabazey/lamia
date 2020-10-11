#!/bin/bash

# wait until mysql will start
sleep 5
php /var/www/app/src/migration/migrate.php
php-fpm