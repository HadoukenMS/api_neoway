FROM wyveo/nginx-php-fpm:php72

RUN apt-get update
RUN apt-get install -y build-essential
RUN apt-get install -y php-pear
RUN pecl install mongodb

RUN echo "extension=mongodb.so" > /etc/php/7.2/cli/php.ini && \
	echo "extension=mongodb.so" > /etc/php/7.2/fpm/php.ini && \
	echo "extension=mongodb.so" > /etc/php/7.2/mods-available/mongodb.ini

COPY config-docker/default.conf /etc/nginx/conf.d/default.conf
COPY config-docker/www.conf /etc/php/7.2/fpm/pool.d/www.conf

WORKDIR /usr/share/nginx/
RUN rm -rf /usr/share/nginx/html
COPY . /usr/share/nginx
RUN ln -s public html
RUN chown nginx. -R /usr/share/nginx/storage/*