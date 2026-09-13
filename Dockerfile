# ---------- Frontend build ----------
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./

RUN npm ci

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./

RUN npm run build


# ---------- Laravel application ----------
FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

# Copy Vite production assets
COPY --from=frontend /app/public/build ./public/build

# Render / Laravel configuration
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV SKIP_COMPOSER=1
# PHP_CATCHALL=1 tells start.sh to patch try_files fallback from =404 to /index.php?$args.
# This is a secondary safety net. Primary fix is conf/nginx/nginx-site.conf which
# start.sh auto-copies to /etc/nginx/sites-available/default.conf at container boot.
ENV PHP_CATCHALL=1

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

ENV COMPOSER_ALLOW_SUPERUSER=1

CMD ["/start.sh"]