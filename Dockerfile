FROM node:22 AS build-stage

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build

FROM richarvey/nginx-php-fpm:latest

COPY --from=build-stage /app /var/www/html



# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV DATABASE_URL [Aca la url que te tire el host de mysql]
ENV APP_KEY [Pone lo q tengas en el .env donde dice APP_KEY, sino lo tenes hace php artisan key:generate]

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]