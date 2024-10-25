# ベースイメージ
FROM php:8.2-fpm

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# アプリケーションディレクトリをコピー
COPY . /var/www

# Composerの依存関係をインストール
WORKDIR /var/www
RUN composer install --no-dev --optimize-autoloader

# 権限を設定
RUN chown -R www-data:www-data /var/www

# Laravelのポートを公開
EXPOSE 8000

# アプリケーションの起動コマンド
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
