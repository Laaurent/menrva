FROM php:8-cli

WORKDIR /var/www/html/

# Setting up Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Install system dependencies
RUN apt update                              \
    && apt install sudo -y \ 
    && curl -sL https://deb.nodesource.com/setup_16.x | sudo -E bash - \
    && apt install -y git libzip-dev zip unzip nodejs \
    && curl -f https://get.pnpm.io/v6.16.js | node - add --global pnpm


# Install PHP dependencies
RUN docker-php-ext-install pdo_mysql zip

COPY ./.docker/entrypoint.sh /entrypoint.sh
RUN chmod 777 /entrypoint.sh

ENTRYPOINT /entrypoint.sh

EXPOSE 8000

VOLUME /var/www/html
