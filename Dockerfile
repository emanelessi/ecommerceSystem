# استخدم صورة رسمية لـ PHP
FROM php:8.2-fpm

# تثبيت الحزم المطلوبة
RUN apt-get update && apt-get install -y unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# تعيين دليل العمل داخل الحاوية
WORKDIR /var/www/html

# نسخ جميع الملفات
COPY . .

# تثبيت الاعتمادات باستخدام Composer
RUN composer install --no-dev --optimize-autoloader

# تعيين الأذونات المناسبة
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تحديد المنفذ
EXPOSE 8000

# تشغيل Laravel
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
