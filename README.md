# Cloudboosta WordPress Docker Deployment

This project provides a containerized WordPress website deployment using Docker Compose for Cloudboosta, a professional cloud solutions company.

## 🚀 Project Overview

**Assignment Context**: Deploy Cloudboosta's complete WordPress business website using Docker Compose.

This Docker deployment includes:
- **WordPress with Custom Cloudboosta Theme**: Complete business website integrated into WordPress CMS
- **Apache Web Server**: Built into WordPress container for reliable hosting
- **MySQL Database**: Backend for WordPress content and configuration
- **phpMyAdmin**: Database management interface
- **Persistent Storage**: Data volumes for all components
- **Custom Network**: Isolated container communication

## 🎯 **WordPress Integration**

### **Cloudboosta Custom Theme**
- **Professional Business Design**: Cloud solutions company branding
- **WordPress CMS**: Full content management capabilities
- **Services Portfolio**: AWS, Docker, DevOps, Security services
- **Company Information**: About, contact, and business statistics
- **Responsive Design**: Mobile-optimized layout

### **WordPress Features**
- **Admin Panel**: http://localhost/wp-admin
- **Login**: admin / cloudboosta2024!
- **Custom Theme**: Cloudboosta business theme activated
- **Content**: Pre-loaded company information and services
- **Navigation**: Professional menu structure

## 🌩️ **Deployment Strategy: AWS EC2 with User Data** ⭐ **Recommended**

For Cloudboosta's business-critical website, we use **AWS EC2 with automated User Data setup**:
- **Pre-built website** ready for deployment (representing completed development)
- **Fully automated** EC2 instance configuration
- **Docker and Docker Compose** installed automatically
- **Security configured** (firewall, user permissions)
- **Website live** in 5-10 minutes after launch

## 📋 Prerequisites

- Docker Engine 20.10 or later
- Docker Compose 2.0 or later
- At least 2GB free disk space

## 🛠️ Quick Start

### **Step 1: Deploy WordPress**

```bash
# Clone repository
git clone https://github.com/YOUR_USERNAME/cloudboosta-wordpress.git
cd cloudboosta-wordpress

# Start services
docker-compose -f docker-compose-apache.yml up -d --build

# Wait for initialization (1-2 minutes)
# WordPress will auto-install with Cloudboosta content
```

### **Step 2: Access Your WordPress Site**

- **Cloudboosta Website**: http://localhost ⭐ **WordPress with Custom Theme**
- **WordPress Admin**: http://localhost/wp-admin
  - **Username**: admin
  - **Password**: cloudboosta2024!
- **Database Admin**: http://localhost:8081 (phpMyAdmin)

### **Step 3: Verify WordPress Setup**

1. **Visit Homepage**: http://localhost
   - ✅ See Cloudboosta branded WordPress site
   - ✅ Professional cloud solutions content
   - ✅ Services, about, contact sections

2. **Check Admin Panel**: http://localhost/wp-admin
   - ✅ Login with admin/cloudboosta2024!
   - ✅ Cloudboosta theme activated
   - ✅ Content pages created
   - ✅ Navigation menu configured

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

## 🔍 Monitoring and Troubleshooting

### Health Checks
```bash
# Check container status
docker-compose ps

# Monitor resource usage
docker stats

# Check container logs
docker-compose logs [service-name]
```

### Common Issues

**Issue**: WordPress database connection error
```bash
# Solution: Ensure database is ready
docker-compose restart wordpress
```

**Issue**: Permission denied errors
```bash
# Solution: Fix WordPress permissions
docker-compose exec wordpress chown -R www-data:www-data /var/www/html
```

## 🚀 Production Considerations

### Security Enhancements
1. **Strong Passwords**: Use complex, unique passwords
2. **SSL/TLS**: Implement HTTPS with reverse proxy (nginx/Traefik)
3. **Firewall**: Restrict port access
4. **Updates**: Regular security updates

### Performance Optimization
1. **Caching**: Add Redis or Memcached
2. **CDN**: Implement content delivery network
3. **Database**: Optimize MySQL configuration
4. **Monitoring**: Add Prometheus/Grafana stack

### Backup Strategy
1. **Database**: Automated MySQL dumps
2. **Files**: WordPress uploads backup
3. **Configuration**: Version control for compose files

## 👥 Development Workflow

### For Team Collaboration
1. Each developer runs `docker-compose up -d`
2. Identical environment across all machines
3. No OS compatibility concerns
4. Shared configuration via version control

### Making Changes
1. Update `docker-compose.yml` for infrastructure changes
2. Modify `.env` for configuration updates
3. Use volumes for persistent development data
4. Test changes in isolated container environment

## 📞 Support

For technical issues or questions:
1. Check container logs: `docker-compose logs`
2. Verify service status: `docker-compose ps`
3. Review documentation above
4. Contact DevOps team for advanced troubleshooting

---

**Note**: This deployment is optimized for development and testing. For production use, implement additional security measures, monitoring, and backup strategies as outlined in the production considerations section.