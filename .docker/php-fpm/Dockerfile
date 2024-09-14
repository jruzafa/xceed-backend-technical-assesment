FROM php:8.2-fpm-bullseye

ARG TIMEZONE
ARG UID
ARG GID
ARG LOCAL_USER

ENV UID=${UID}
ENV GID=${GID}
ENV LOCAL_USER=${LOCAL_USER}

COPY .docker/php-fpm/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini
COPY .docker/php-fpm/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apt-get update && apt-get install -y \
    gnupg \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    acl \
    libcurl4-openssl-dev  \
    pkg-config \
    libssl-dev \
    && echo 'alias sf="php bin/console"' >> ~/.bashrc

RUN docker-php-ext-install pdo zip xsl intl opcache mbstring

RUN pecl install xdebug-3.3.0 redis

RUN docker-php-ext-enable redis

RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN addgroup --gid ${GID} ${LOCAL_USER}
RUN adduser --gid ${GID} --disabled-password --shell /bin/sh -u ${UID} ${LOCAL_USER}

RUN sed -i "s/user = www-data/user = ${LOCAL_USER}/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = ${LOCAL_USER}/g" /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www