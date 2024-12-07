FROM php:8.1-cli

WORKDIR /app

# Install dependencies (if any)
RUN apt-get update && apt-get install -y \
    zip unzip git \

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

