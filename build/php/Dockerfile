FROM php:5-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libldb-dev \
        libldap2-dev \
        libmagickwand-dev \
        imagemagick

RUN docker-php-ext-install -j$(nproc) iconv 

RUN docker-php-ext-configure gd \
                    --with-freetype-dir=/usr/include/ \
                    --with-jpeg-dir=/usr/include/ \
                    --with-png-dir=/usr/include/ 

RUN docker-php-ext-install -j$(nproc) gd 

RUN docker-php-ext-install -j$(nproc) mcrypt 
RUN docker-php-ext-install -j$(nproc) mbstring 
RUN docker-php-ext-install -j$(nproc) mysqli 
RUN docker-php-ext-install -j$(nproc) pdo_mysql 
RUN docker-php-ext-install -j$(nproc) zip 
RUN docker-php-ext-install -j$(nproc) json 
RUN docker-php-ext-install -j$(nproc) opcache 
RUN docker-php-ext-install -j$(nproc) gettext

RUN curl -L https://pecl.php.net/get/imagick-3.4.4.tgz >> /tmp/imagick.tgz && \
    mkdir -p /usr/src/php/ext/ && \
    tar -xf /tmp/imagick.tgz -C /usr/src/php/ext/ && \
    rm /tmp/imagick.tgz

RUN docker-php-ext-install -j$(nproc) imagick-3.4.4

RUN ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so && \
    ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so

RUN docker-php-ext-install -j$(nproc) ldap 

RUN apt-get install -y python python-pip python-mysqldb