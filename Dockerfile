FROM php:8.2-cli-alpine as app
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir -p /usr/src/app
COPY . /usr/src/app
WORKDIR /usr/src/app
RUN composer install --optimize-autoloader
RUN php bin/phpunit
ENV APP_ENV=prod

CMD ["-S", "0.0.0.0:8080", "-t", "public"]
EXPOSE 8080