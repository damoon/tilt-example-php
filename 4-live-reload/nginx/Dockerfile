FROM nginx:1.17.9-alpine

ADD nginx/site.conf /etc/nginx/conf.d/default.conf

ADD index.php /app/index.php
ADD live-reload.php /app/live-reload.php
ADD static /app/static
