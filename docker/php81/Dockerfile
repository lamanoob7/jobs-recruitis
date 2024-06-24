FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    nano \
    openssl \
    git \
    unzip \
    zip \
    zlib1g-dev \
    libicu-dev \
    g++ \
    libzip-dev

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install zip pdo pdo_mysql

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
&& printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
&& "date"

RUN pecl install -o -f redis-5.3.7 \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

# install xdebug
RUN pecl install xdebug-3.3.2 \
&& docker-php-ext-enable xdebug \
&& echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20210902/xdebug.so"  >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.discover_client_host=true" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.client_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN echo "memory_limit=-1" > "/usr/local/etc/php/conf.d/memory-limit.ini"

# Install Composer
RUN curl -sS https://getcomposer.org/download/latest-stable/composer.phar -o composer.phar \
&& mv ./composer.phar /usr/local/bin/composer \
&& chmod 755 /usr/local/bin/composer \
&& composer --version

# Install symfony
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash && apt install symfony-cli
