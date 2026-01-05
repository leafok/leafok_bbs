# Use an official PHP-FPM image (adjust version as needed)
FROM php:8.4-fpm

# Example: Install common PHP extensions
RUN apt-get update && apt-get install -y \
	libfreetype-dev libjpeg62-turbo-dev libpng-dev libxml2-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd mysqli \
	&& rm -rf /var/lib/apt/lists/*

# Copy the custom configuration file
COPY ./Dockerfile/php.ini /usr/local/etc/php/php.ini

# Set ownership to www-data user and group
RUN mkdir -p /var/lib/php/sessions \
	&& chown -R www-data:www-data /var/lib/php/sessions

# Install PEAR Mail package
RUN pear install -a Mail
