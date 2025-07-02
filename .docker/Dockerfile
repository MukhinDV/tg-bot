FROM ubuntu:22.04

RUN apt-get update \
    && apt-get install -y software-properties-common \
    && apt-get update \
    && add-apt-repository ppa:ondrej/php \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends tzdata \
    && apt-get install -y php8.3 \
    && apt-get install -y php8.3-fpm php8.3-cli php8.3-mbstring php8.3-xml php8.3-gd php8.3-curl \
       php8.3-zip php8.3-redis php8.3-mysql

ARG WITH_XDEBUG=false
RUN if [ $WITH_XDEBUG = "true" ] ; then \
    apt-get install -y php8.3-xdebug; \
fi

RUN rm -rf /var/lib/apt/lists/*

RUN apt-get update && \
    apt-get -y install apache2 wget git curl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get install nano

#ssl
RUN a2enmod rewrite \
    && a2enmod ssl \
    && service apache2 restart

WORKDIR /var/www/html

ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]