#FROM yiisoftware/yii2-php:8.2-fpm-nginx

FROM yiisoftware/yii2-php:8.1-apache

# Change document root for Apache
#RUN sed -i -e 's|/app/web|/app/frontend/web|g'  /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y libmemcached-dev libssl-dev zlib1g-dev \
	&& pecl install memcached-3.2.0 \
	&& docker-php-ext-enable memcached



