#Pull base image
FROM ubuntu
MAINTAINER jalon50 <leonjosealonso@gmail.com>
ENV DEBIAN_FRONTEND=noninteractive

#Install Apache, php, vim, and composer
RUN apt-get update -y && apt-get upgrade -y && apt-get install -y php7.2-dev  build-essential libaio1 apache2 apache2-utils composer openssl php7.2-zip php7.2-mbstring vim php7.2-mysql libapache2-mod-php7.2


EXPOSE 80 443
ENV APACHE_RUN_USER  www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR   /var/log/apache2
ENV APACHE_PID_FILE  /var/run/apache2/apache2.pid
ENV APACHE_RUN_DIR   /var/run/apache2
ENV APACHE_LOCK_DIR  /var/lock/apache2
ENV APACHE_LOG_DIR   /var/log/apache2
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/7.2/apache2/php.ini


RUN mkdir -p $APACHE_RUN_DIR
RUN mkdir -p $APACHE_LOCK_DIR
RUN mkdir -p $APACHE_LOG_DIR

RUN a2enmod rewrite


#Install composer
RUN composer global require "laravel/lumen-installer"

WORKDIR /var/www/html

ENTRYPOINT [ "/usr/sbin/apache2ctl" ]
CMD [ "-D", "FOREGROUND" ]
