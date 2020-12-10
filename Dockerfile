FROM php:7.4-apache
RUN apt-get update
RUN apt-get install -y --no-install-suggests --no-install-recommends libcurl4-openssl-dev libpq-dev
RUN docker-php-ext-install curl pdo pgsql pdo_pgsql
COPY apache_env.conf /etc/apache2/conf-enabled/environment.conf
COPY src/ /var/www/html/
