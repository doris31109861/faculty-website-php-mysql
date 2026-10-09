# PHP 8.2 + Apache，安裝 mysqli 擴充套件
FROM php:8.2-apache
RUN docker-php-ext-install mysqli
# 與 XAMPP 預設相同，開啟輸出緩衝（頁面先輸出再 header 轉址也能運作）
RUN echo "output_buffering=4096" > /usr/local/etc/php/conf.d/output-buffering.ini
COPY . /var/www/html/
# 容器內使用讀取環境變數的設定檔
COPY docker/config.docker.php /var/www/html/config.php
