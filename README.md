# Docker Assignment - WordPress Deployment

A Docker Compose solution for deploying WordPress with a custom business theme for Cloudboosta, a cloud solutions company.

## 🚀 Quick Start

```bash
# Clone the repository
git clone https://github.com/elizabethajala99-ai/Docker_Assignment.git
cd Docker_Assignment

# Start the deployment
docker compose up -d

# Access the website
# WordPress Site: http://localhost
# Admin Panel: http://localhost/wp-admin (admin / cloudboosta2024!)
```

## 📋 Services

- **WordPress**: Content Management System with custom Cloudboosta theme
- **MySQL**: Database backend for WordPress
- **phpMyAdmin**: Database administration interface (port 8081)

## 🎯 Features

- Custom WordPress theme with professional business design
- Pre-configured Cloudboosta company content
- Responsive layout optimized for cloud services business
- Admin access for content management
- Persistent data storage

## 📋 Prerequisites

- Docker Engine 20.10+
- Docker Compose 2.0+
- 2GB+ available disk space

## � Configuration

### Environment Variables
Configuration is managed through `.env` file:
- Database credentials
- WordPress settings
- Security configurations

### Custom Theme
The `wordpress-content/` directory contains:
- Custom Cloudboosta business theme
- Professional styling and layout
- Pre-configured company content

## 🔧 Configuration Details

### Services Configuration

#### WordPress Service
- **Port**: 8080 → 80
- **Data Persistence**: `/var/www/html` mounted to named volume
- **PHP Settings**: Custom upload limits via `uploads.ini`

#### MySQL Database
- **Version**: MySQL 8.0
- **Authentication**: Native password plugin
- **Data Persistence**: `/var/lib/mysql` mounted to named volume

#### phpMyAdmin
- **Port**: 8081 → 80
- **Purpose**: Database administration interface

### Security Features
- Environment variables for sensitive data
- Isolated Docker network
- No hardcoded passwords in compose file
- Restart policies for high availability

## 📁 Project Structure
```
cloudboosta-wordpress/
├── docker-compose-apache.yml    # Main WordPress deployment ⭐
├── Dockerfile.wordpress         # Custom WordPress build
├── wordpress-content/           # WordPress customizations
│   └── themes/cloudboosta/      # Custom Cloudboosta theme
│       ├── style.css           # Theme styles
│       ├── index.php           # Theme template
│       └── functions.php       # Theme functionality
├── init-wordpress.sh           # WordPress auto-setup script
├── .env                        # Environment variables
├── uploads.ini                 # PHP configuration
├── apache/httpd.conf          # Apache configuration (backup)
└── README.md                  # This documentation
```

## 🔨 Management Commands

### **Apache-Based Website Management**
```bash
# Start Cloudboosta services
./start-cloudboosta.sh

# Check service status
cd cloudboosta-wordpress && docker-compose -f docker-compose-apache.yml ps

# View logs
cd cloudboosta-wordpress && docker-compose -f docker-compose-apache.yml logs -f

# Manual GitHub sync
cd cloudboosta-wordpress && git pull origin main

# Stop services
cd cloudboosta-wordpress && docker-compose -f docker-compose-apache.yml down
```

### Local Development (Optional)
```bash
# Start locally for testing
docker-compose up -d

# Access at http://localhost:8080
```

## � Project Structure

```
Docker_Assignment/
├── docker-compose.yml          # Main Docker Compose configuration
├── docker-compose-apache.yml   # Alternative configuration file
├── .env                        # Environment variables
├── README.md                   # Project documentation
├── Dockerfile.wordpress        # Custom WordPress build
├── init-wordpress.sh          # WordPress initialization script
├── uploads.ini                # PHP upload configuration
├── apache/                    # Apache configuration files
└── wordpress-content/         # Custom WordPress theme and content
    └── themes/cloudboosta/    # Cloudboosta business theme
```

## 🛠️ Management

```bash
# Start services
docker compose up -d

# Stop services  
docker compose down

# View logs
docker compose logs -f

# Check status
docker compose ps
```

## 📋 Assignment Details

**Student**: Elizabeth Ajala  
**Repository**: https://github.com/elizabethajala99-ai/Docker_Assignment  
**Deployment**: WordPress with Docker Compose  
**Theme**: Custom Cloudboosta business website