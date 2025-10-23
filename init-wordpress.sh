#!/bin/bash

# WordPress initialization script for Cloudboosta
echo "🚀 Setting up Cloudboosta WordPress site..."

# Wait for MySQL to be ready
echo "⏳ Waiting for MySQL to be ready..."
while ! mysqladmin ping -h mysql -u root -p"$MYSQL_ROOT_PASSWORD" --silent; do
    sleep 2
done

# Wait for WordPress to be available
echo "⏳ Waiting for WordPress to be ready..."
while ! curl -f http://localhost/wp-admin/install.php >/dev/null 2>&1; do
    sleep 2
done

# Install WordPress if not already installed
if ! wp core is-installed --allow-root --path=/var/www/html; then
    echo "📦 Installing WordPress..."
    
    wp core install \
        --url="http://localhost" \
        --title="Cloudboosta" \
        --admin_user="admin" \
        --admin_password="cloudboosta2024!" \
        --admin_email="admin@cloudboosta.com" \
        --allow-root \
        --path=/var/www/html
        
    echo "✅ WordPress installed successfully!"
    
    # Activate the Cloudboosta theme
    echo "🎨 Activating Cloudboosta theme..."
    wp theme activate cloudboosta --allow-root --path=/var/www/html
    
    # Create navigation menu
    echo "📋 Setting up navigation menu..."
    wp menu create "Primary Menu" --allow-root --path=/var/www/html
    
    # Create menu items
    wp menu item add-custom primary-menu "Home" "http://localhost" --allow-root --path=/var/www/html
    wp menu item add-custom primary-menu "Services" "#services" --allow-root --path=/var/www/html
    wp menu item add-custom primary-menu "About" "#about" --allow-root --path=/var/www/html
    wp menu item add-custom primary-menu "Contact" "#contact" --allow-root --path=/var/www/html
    
    # Assign menu to theme location
    wp menu location assign primary-menu primary --allow-root --path=/var/www/html
    
    echo "🎉 Cloudboosta WordPress site is ready!"
    echo "👤 Admin login: admin / cloudboosta2024!"
    echo "🌐 Visit: http://localhost"
    
else
    echo "✅ WordPress already installed!"
fi