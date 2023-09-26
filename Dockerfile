FROM registry.digitalocean.com/dslk/php/wordpress:php7.4

WORKDIR /var/www

COPY --chown=www-data:www-data . .

VOLUME ["/var/www/wp-content/uploads"]
