#Pull base image
FROM ubuntu
MAINTAINER jalon50 <leonjosealonso@gmail.com>
ENV DEBIAN_FRONTEND=noninteractive

#Install Apache, php, vim, and composer
RUN apt-get update -y && apt-get upgrade -y && apt-get install -y php7.2-dev  build-essential libaio1 apache2 apache2-utils composer openssl php7.2-zip php7.2-mbstring vim

EXPOSE 80 443
ENV APACHE_RUN_USER  www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR   /var/log/apache2
ENV APACHE_PID_FILE  /var/run/apache2/apache2.pid
ENV APACHE_RUN_DIR   /var/run/apache2
ENV APACHE_LOCK_DIR  /var/lock/apache2
ENV APACHE_LOG_DIR   /var/log/apache2

RUN mkdir -p $APACHE_RUN_DIR
RUN mkdir -p $APACHE_LOCK_DIR
RUN mkdir -p $APACHE_LOG_DIR

#Install composer
RUN composer global require "laravel/lumen-installer"

WORKDIR /var/www

ENTRYPOINT [ "/usr/sbin/apache2ctl" ]
CMD [ "-D", "FOREGROUND" ]
