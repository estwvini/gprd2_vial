# ----------------------
# Assets install step
# ----------------------
FROM node:16-alpine as assets

WORKDIR /var/www/html

COPY ./src /var/www/html

RUN apk add git

FROM php:8.1-fpm

# Add docker php ext repo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install php extensions dependencies
RUN pecl install redis \
    && docker-php-ext-enable redis

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring pdo pdo_pgsql zip exif gd memcached bcmath

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
	curl \
	nano \
    lua-zlib-dev \
    libmemcached-dev \
    nginx \
    openssh-server \
	gdal-bin 

# Install supervisor
RUN apt-get install -y supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy nginx/php/supervisor configs
COPY ./docker/supervisor.conf /etc/supervisord.conf
COPY ./docker/php.ini /usr/local/etc/php/conf.d/app.ini
COPY ./docker/nginx.conf /etc/nginx/sites-enabled/default

# PHP Error Log Files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod -R 777 /var/log
RUN chmod -R 777 /var/run

# Copy code to /var/www/html
RUN rm -rf /var/www/html/*
COPY ./src /var/www/html
#COPY --from=assets /app/public/mix-manifest.json /var/www/html/public/mix-manifest.json

RUN chmod -R 777 /var/www/html/storage



# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-dev

RUN chmod +x run.sh

# Install dependencies and compile assets
RUN apt-get update && apt-get install -y npm
#RUN npm install 

# ssh setup
RUN rm -f /etc/ssh/sshd_config
RUN echo "root:Docker!" | chpasswd
RUN mkdir -p /tmp
COPY ./docker/sshd_config /etc/ssh/
RUN rm -rf /etc/ssh/ssh_host_rsa_key /etc/ssh/ssh_host_dsa_key /etc/ssh/ssh_host_ecdsa_key /etc/ssh/ssh_host_ed25519_key
COPY ./docker/ssh_setup.sh /tmp
RUN chmod -R +x /tmp/ssh_setup.sh \
   && (sleep 1;/tmp/ssh_setup.sh) \
   && rm -rf /tmp/*

EXPOSE 8080 2222
ENTRYPOINT ["/var/www/html/run.sh"]
