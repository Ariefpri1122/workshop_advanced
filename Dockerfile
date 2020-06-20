FROM php

RUN apt-get update

RUN apt-get install -y unzip wget
RUN apt-get install -qq libpq-dev git curl libzip-dev libmcrypt-dev libjpeg-dev libpng-dev libfreetype6-dev libbz2-dev

RUN apt-get -y autoclean
RUN apt-get -y autoremove

RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql zip

RUN cd ~

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN export PATH="$PATH:$HOME/.composer/vendor/bin"
RUN composer global require "laravel/installer"
RUN composer global require "laravel/envoy"

RUN apt-get install gnupg -y
RUN apt-get install gnupg2 -y
RUN apt-get install gnupg1 -y

WORKDIR '/app'
COPY . .

RUN apt-get -y autoclean
RUN apt-get -y autoremove

RUN apt-get update
RUN apt-get install -y software-properties-common
RUN apt-get install -y postgresql

RUN apt-get -y autoclean
RUN apt-get -y autoremove

RUN apt-get install -y postgresql-client
RUN apt-get install -y postgresql-contrib

RUN apt-key adv --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys B97B0AFCAA1A47F044F244A07FCC7D46ACCC4CF8
RUN echo "deb http://apt.postgresql.org/pub/repos/apt/ precise-pgdg main" > /etc/apt/sources.list.d/pgdg.list

USER postgres

RUN    /etc/init.d/postgresql start &&\
    psql --command "CREATE USER docker WITH SUPERUSER PASSWORD 'docker';" &&\
    createdb -O docker docker

RUN echo "host all  all    0.0.0.0/0  md5" >> /etc/postgresql/11/main/pg_hba.conf

RUN echo "listen_addresses='*'" >> /etc/postgresql/11/main/postgresql.conf

EXPOSE 5432

RUN php artisan serve --port 8000

EXPOSE 8000

VOLUME  ["/etc/postgresql", "/var/log/postgresql", "/var/lib/postgresql"]

CMD ["/usr/lib/postgresql/11/bin/postgres", "-D", "/var/lib/postgresql/11/main", "-c", "config_file=/etc/postgresql/11/main/postgresql.conf"]
