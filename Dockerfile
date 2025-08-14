# Stage 1: Composer dependencies
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-req=ext-intl \
    --ignore-platform-req=ext-exif \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-scripts \
    --optimize-autoloader

# Stage 2: Node dependencies and build
FROM node:20 AS frontend
WORKDIR /app
COPY package*.json ./
COPY resources/ ./resources/
COPY vite.config.js ./
RUN npm install && npm run build

# Stage 3: Runtime
FROM php:8.3-fpm
WORKDIR /var/www

# Install system dependencies + Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev \
    zip unzip git nginx libicu-dev \
    libfreetype6-dev libjpeg62-turbo-dev libwebp-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy from previous stages
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build
COPY . .

# Set permissions and optimize
RUN chown -R www-data:www-data storage bootstrap/cache \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:clear

# Nginx configuration
RUN mkdir -p /etc/nginx/sites-available && \
    echo "server { \
        listen 8080; \
        root /var/www/public; \
        index index.php index.html; \
        \
        location / { \
            try_files \$uri \$uri/ /index.php?\$query_string; \
        } \
        \
        location ~ \.php$ { \
            fastcgi_pass 127.0.0.1:9000; \
            fastcgi_index index.php; \
            fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name; \
            include fastcgi_params; \
        } \
    }" > /etc/nginx/sites-available/default

EXPOSE 8080
CMD ["bash", "-c", "php-fpm -F & nginx -g 'daemon off;'"]
