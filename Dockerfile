# ===== Stage 1: Composer deps =====
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress
# Salin source agar autoload classmap bisa dioptimasi jika dibutuhkan
COPY . .
RUN composer dump-autoload --optimize

# ===== Stage 2: Build assets =====
FROM node:20 AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# ===== Stage 3: Runtime (Nginx + PHP-FPM 8.3) =====
FROM webdevops/php-nginx:8.3-alpine

# ---- Default ENV (non-secret) ----
# Ganti sesuai kebutuhan, tapi jangan taruh secrets di sini.
ENV APP_KEY= \
    APP_NAME="Minum 24 - Toko Minuman Indonesia" \
    APP_URL= \
    DB_DATABASE=db_simetri_saas \
    DB_USERNAME=simetrisaas \
    DB_PASSWORD=!ndoM13goreng \
    APP_ENV=local \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    PORT=8080 \
    WEB_DOCUMENT_ROOT=/app/public \
    PHP_DISPLAY_ERRORS=0 \
    PHP_MEMORY_LIMIT=512M \
    PHP_MAX_EXECUTION_TIME=120 \
    PHP_POST_MAX_SIZE=50M \
    PHP_UPLOAD_MAX_FILESIZE=50M \
    NGINX_CLIENT_MAX_BODY_SIZE=50m \
    DB_CONNECTION=mysql \
    DB_HOST=127.0.0.1 \
    DB_PORT=3306

# Koneksi Cloud SQL via Unix socket dibikin fleksibel lewat build-arg
# agar tidak perlu set di deploy time (opsional).
ARG INSTANCE_CONNECTION_NAME=""
ENV DB_SOCKET=/cloudsql/${INSTANCE_CONNECTION_NAME}

WORKDIR /app

# Salin source + vendor + assets hasil build
COPY . .
COPY --from=vendor /app/vendor /app/vendor
COPY --from=assets /app/public/build /app/public/build

# Permission Laravel
RUN mkdir -p storage bootstrap/cache \
 && chown -R application:application storage bootstrap/cache

# Symlink storage ke public (aman dijalankan di build)
RUN php artisan storage:link || true

# Bersihkan cache agar selalu fresh di runtime (APP_KEY dari Secret Manager)
RUN php artisan config:clear || true \
 && php artisan route:clear || true \
 && php artisan view:clear || true

# Healthcheck sederhana (buat route /health yang return "ok")
HEALTHCHECK --interval=30s --timeout=3s CMD wget -qO- http://127.0.0.1:${PORT}/health || exit 1
