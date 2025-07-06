# Gunakan image PHP + Apache
FROM php:8.1-apache

# Install ekstensi mysqli
RUN docker-php-ext-install mysqli

# Aktifkan mod_rewrite (penting untuk REST API / Laravel)
RUN a2enmod rewrite

# Salin semua file ke dalam container
COPY . /var/www/html/

# Ubah permission agar Apache bisa akses
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# (Opsional) Set DocumentRoot jika pakai subfolder
# RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf
