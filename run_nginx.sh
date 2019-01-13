#!/usr/bin/env bash

echo "################################## Run nginx"
export DOLLAR='$'
envsubst < /var/www/default.conf.template > /etc/nginx/nginx.conf # /etc/nginx/conf.d/default.conf
envsubst < /var/www/env.php.template > /var/www/html/env.php # /etc/nginx/conf.d/default.conf
nginx -g "daemon off;"