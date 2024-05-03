FROM dunglas/frankenphp
ENV SERVER_NAME=:80
RUN install-php-extensions \
  bcmath \
  bz2 \
  gmp \
  calendar \
  exif \
  gd \
  intl \
  ldap \
  mcrypt \
  mysqli \
  opcache \
  pdo_mysql \
  zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
