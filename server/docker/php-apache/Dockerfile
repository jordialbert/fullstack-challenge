FROM php:8.2-apache

ENV TZ=Europe/Madrid
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  libzip-dev \
  libzip-dev git wget --no-install-recommends \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install pdo mysqli pdo_mysql zip;

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/html

CMD ["apache2-foreground"]
