#!/bin/bash

echo "🚀 Testing Cloudboosta WordPress Deployment..."

# Start the services
echo "📦 Starting Docker services..."
docker-compose -f docker-compose-apache.yml up -d --build

echo "⏳ Waiting for services to initialize (60 seconds)..."
sleep 60

# Test WordPress
echo "🔍 Testing WordPress..."
if curl -f http://localhost >/dev/null 2>&1; then
    echo "✅ WordPress is running at http://localhost"
else
    echo "❌ WordPress not accessible"
fi

# Test phpMyAdmin
echo "🔍 Testing phpMyAdmin..."
if curl -f http://localhost:8081 >/dev/null 2>&1; then
    echo "✅ phpMyAdmin is running at http://localhost:8081"
else
    echo "❌ phpMyAdmin not accessible"
fi

# Check container status
echo "📊 Container Status:"
docker-compose -f docker-compose-apache.yml ps

echo ""
echo "🎉 Deployment Complete!"
echo "🌐 WordPress Site: http://localhost"
echo "👤 Admin Login: http://localhost/wp-admin (admin / cloudboosta2024!)"
echo "🗄️ Database Admin: http://localhost:8081"
echo ""
echo "🛑 To stop: docker-compose -f docker-compose-apache.yml down"