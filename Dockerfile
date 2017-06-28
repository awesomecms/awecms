FROM ubuntu:16.10
MAINTAINER Jens Laur <jens@laur.me>
# Adding build Information
RUN printf "Build of awecms Image, date: %s\n"  $(date -u +"%Y-%m-%dT%H:%M:%SZ") >> /etc/BUILD
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y curl \
      apache2 \
      php7.0-common \
      php7.0-cli \
      libapache2-mod-php7.0 \
      php7.0-curl \
      php7.0-gd \
      php7.0-intl \
      php7.0-xml \
      php7.0-mcrypt \
      php-memcached \
      php7.0-mysql \
      php-xdebug \
      php-apcu && \
      apt-get autoclean && rm -rf /var/lib/apt/lists/*
RUN chmod 777 /var/www/html
RUN rm /var/www/html/index.html
RUN a2enmod rewrite
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
ENV APACHE_SERVERADMIN=admin@localhost
ENV APACHE_SERVERNAME=localhost
ENV APACHE_SERVERALIAS=docker.localhost
ENV APACHE_DOCUMENTROOT=/var/www/html
ENV APACHE_RUN_USER=www-data
ENV APACHE_RUN_GROUP=www-data
ENV APACHE_LOG_DIR=/var/log/apache2
ENV APACHE_PID_FILE=/var/run/apache2.pid
ENV APACHE_RUN_DIR=/var/run/apache2
ENV APACHE_LOCK_DIR=/var/lock/apache2
EXPOSE 80

RUN chown www-data /var/www/html -R
# These steps have to go into a standardized apache container
WORKDIR /var/www/html
ENTRYPOINT /usr/sbin/apache2 -D FOREGROUND
