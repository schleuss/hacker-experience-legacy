FROM php:5-fpm

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libldb-dev \
        libldap2-dev \
        libmagickwand-dev \
        imagemagick \
        locales

RUN sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
    sed -i -e 's/# pt_BR.UTF-8 UTF-8/pt_BR.UTF-8 UTF-8/' /etc/locale.gen && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG=en_US.UTF-8

ENV LANG en_US.UTF-8 

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

