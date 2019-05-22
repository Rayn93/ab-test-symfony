FROM 084824767965.dkr.ecr.eu-west-1.amazonaws.com/base/alpine39-php72:20190522-1

COPY . /app/

RUN composer install --no-interaction --prefer-dist --no-dev --apcu-autoloader
RUN php bin/console cache:warmup --env prod --no-debug
RUN chmod -R 777 /app/var

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
