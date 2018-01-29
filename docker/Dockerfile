FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
    git zip unzip libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev && \
    docker-php-ext-install -j$(nproc) mbstring pdo_mysql tokenizer mcrypt iconv mysqli && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd && \
    php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
    #&& \
#    apt-get -y autoremove && \
#    apt-get clean && \
#    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

CMD ["php composer"]