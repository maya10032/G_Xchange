# ベースイメージ
FROM php:8.2-fpm

# DNS設定（GoogleのDNSを使用）
RUN echo "nameserver 8.8.8.8" > /etc/resolv.conf

# 必要なPHP拡張をインストール
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql mbstring

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# アプリケーションファイルをコピー
COPY . /var/www

# 作業ディレクトリ
WORKDIR /var/www

# Composer依存関係をインストール（メモリ制限を解除）
RUN php -d memory_limit=-1 /usr/bin/composer install --no-dev --optimize-autoloader

# パーミッションを設定
RUN chown -R www-data:www-data /var/www

# ポートを公開
EXPOSE 8000

# アプリケーション起動
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=${PORT}"]
