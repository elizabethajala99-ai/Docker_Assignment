# 🚀 **STEP-BY-STEP EC2 DEPLOYMENT** 

## 📋 **Prerequisites Checklist**
- [ ] AWS Account (free tier eligible)
- [ ] GitHub account 
- [ ] Code ready to push (✅ Done!)

---

## **STEP 1: GitHub Repository Setup** 🔄 *IN PROGRESS*

### **1.1 Create GitHub Repository**
1. Go to **github.com** → Click **"New"** (green button)
2. **Repository name**: `cloudboosta-wordpress` 
3. **Description**: `Professional WordPress deployment with Docker Compose for Cloudboosta cloud solutions company`
4. **Visibility**: Public ✅
5. **Don't** initialize with README (we have files ready)
6. Click **"Create repository"**

### **1.2 Push Your Code**
```bash
# Navigate to your submission folder
cd /home/elizabeth/Docker_assignment/submission

# Initialize Git repository
git init

# Add all files
git add .

# Commit with descriptive message
git commit -m "Complete Cloudboosta WordPress Docker deployment with custom theme"

# Add GitHub remote (REPLACE 'YOUR_USERNAME' with your actual GitHub username!)
git remote add origin https://github.com/YOUR_USERNAME/cloudboosta-wordpress.git

# Push to GitHub
git branch -M main
git push -u origin main
```

**✅ Result**: Your code is now on GitHub and ready for EC2 deployment!

---

## **STEP 2: AWS EC2 Instance Creation** ⏳ *WAITING*

### **2.1 Access AWS Console**
1. Go to **aws.amazon.com** → Sign in to Console
2. Search **"EC2"** → Click **"EC2"**
3. Click **"Launch Instance"** (orange button)

### **2.2 Configure Instance**

#### **Name and Tags**
- **Name**: `Cloudboosta-WordPress-Server`

#### **Application and OS Images (Amazon Machine Image)**
- **Select**: Ubuntu Server 22.04 LTS (HVM)
- **Architecture**: 64-bit (x86)
- **Note**: This is free tier eligible ✅

#### **Instance Type**
- **Select**: t2.micro (Free tier eligible) ✅
- **vCPUs**: 1, **Memory**: 1 GiB
- **For better performance**: t3.small (extra cost ~$15/month)

#### **Key Pair (login)**
- **If you have a key**: Select existing
- **If new**: Create key pair
  - **Name**: `cloudboosta-key`
  - **Type**: RSA
  - **Format**: .pem
  - **Download and save** the .pem file securely!

#### **Network Settings** ⚠️ **CRITICAL**
- **Create security group** ✅
- **Security group name**: `cloudboosta-wordpress-sg`
- **Allow SSH traffic from**: My IP (safer) or Anywhere (0.0.0.0/0)
- **Allow HTTPS traffic from internet** ✅
- **Allow HTTP traffic from internet** ✅

### **2.3 Advanced Details - User Data** 🔑 **KEY STEP**

**Expand "Advanced Details"** → Scroll to **"User Data"**

Copy and paste this script (REPLACE `YOUR_USERNAME`):

```bash
#!/bin/bash

# Log all output for debugging
exec > >(tee /var/log/user-data.log) 2>&1

echo "🚀 Starting Cloudboosta WordPress deployment setup..."

# Update system packages
apt-get update -y

# Install Docker and Docker Compose
apt-get install -y docker.io docker-compose-plugin git curl

# Start and enable Docker
systemctl start docker
systemctl enable docker

# Add ubuntu user to docker group
usermod -aG docker ubuntu

# Wait for Docker to be fully ready
sleep 10

# Create deployment directory
cd /home/ubuntu

# Clone your WordPress repository (REPLACE YOUR_USERNAME!)
echo "📦 Cloning Cloudboosta WordPress repository..."
git clone https://github.com/YOUR_USERNAME/cloudboosta-wordpress.git

# Set proper ownership
chown -R ubuntu:ubuntu cloudboosta-wordpress

# Navigate to project directory
cd cloudboosta-wordpress

# Start WordPress deployment
echo "🐳 Starting Docker containers..."
docker compose -f docker-compose-apache.yml up -d --build

# Wait for services to initialize
echo "⏳ Waiting for WordPress initialization..."
sleep 60

# Get public IP for easy access
PUBLIC_IP=$(curl -s ifconfig.me)

# Create management scripts
cat > /home/ubuntu/start-cloudboosta.sh << 'EOF'
#!/bin/bash
cd /home/ubuntu/cloudboosta-wordpress
docker compose -f docker-compose-apache.yml up -d
echo "✅ Cloudboosta WordPress is running!"
echo "🌐 Website: http://$(curl -s ifconfig.me)"
echo "👤 Admin: http://$(curl -s ifconfig.me)/wp-admin"
echo "🔑 Login: admin / cloudboosta2024!"
EOF

cat > /home/ubuntu/stop-cloudboosta.sh << 'EOF'
#!/bin/bash
cd /home/ubuntu/cloudboosta-wordpress
docker compose -f docker-compose-apache.yml down
echo "🛑 Cloudboosta WordPress stopped"
EOF

cat > /home/ubuntu/status-cloudboosta.sh << 'EOF'
#!/bin/bash
cd /home/ubuntu/cloudboosta-wordpress
echo "📊 Container Status:"
docker compose -f docker-compose-apache.yml ps
echo ""
echo "🌐 Access URLs:"
echo "Website: http://$(curl -s ifconfig.me)"
echo "Admin: http://$(curl -s ifconfig.me)/wp-admin"
echo "Database: http://$(curl -s ifconfig.me):8081"
EOF

# Make scripts executable
chmod +x /home/ubuntu/*.sh
chown ubuntu:ubuntu /home/ubuntu/*.sh

# Create deployment summary
cat > /home/ubuntu/deployment-info.txt << EOF
🎉 CLOUDBOOSTA WORDPRESS DEPLOYMENT COMPLETE!

🌐 PUBLIC URLS:
- Website: http://$PUBLIC_IP
- WordPress Admin: http://$PUBLIC_IP/wp-admin
- Database Admin: http://$PUBLIC_IP:8081

🔑 LOGIN CREDENTIALS:
- WordPress Admin: admin / cloudboosta2024!
- Database: root / (check .env file)

📁 PROJECT LOCATION: /home/ubuntu/cloudboosta-wordpress

🛠️ MANAGEMENT COMMANDS:
- ./start-cloudboosta.sh   (start services)
- ./stop-cloudboosta.sh    (stop services)  
- ./status-cloudboosta.sh  (check status)

📋 ASSIGNMENT SUBMISSION:
- GitHub: https://github.com/YOUR_USERNAME/cloudboosta-wordpress
- Live Demo: http://$PUBLIC_IP
- Admin Panel: http://$PUBLIC_IP/wp-admin

✅ Ready for instructor evaluation!
EOF

chown ubuntu:ubuntu /home/ubuntu/deployment-info.txt

echo "✅ Cloudboosta WordPress deployment setup complete!"
echo "🌐 Visit: http://$PUBLIC_IP"
```

**⚠️ IMPORTANT**: Replace `YOUR_USERNAME` with your actual GitHub username!

### **2.4 Launch Instance**
1. **Review** all settings
2. Click **"Launch Instance"** 
3. **Wait 5-10 minutes** for complete setup

---

## **STEP 3: Access Your Live WordPress Site** ⏳ *WAITING*

### **3.1 Get Public IP Address**
1. **EC2 Console** → **Instances** 
2. **Select your instance**
3. **Copy "Public IPv4 address"** (e.g., 54.123.45.67)

### **3.2 Test Access**
- **WordPress Site**: `http://YOUR-PUBLIC-IP`
- **Admin Panel**: `http://YOUR-PUBLIC-IP/wp-admin`
- **Login**: admin / cloudboosta2024!

### **3.3 SSH Access (Optional)**
```bash
# Connect to your server
ssh -i your-key.pem ubuntu@YOUR-PUBLIC-IP

# Check deployment status
cat deployment-info.txt

# View management commands
ls -la *.sh
```

---

## **STEP 4: Assignment Submission** ⏳ *WAITING*

### **4.1 Document Your Deployment**
- **GitHub Repository**: https://github.com/YOUR_USERNAME/cloudboosta-wordpress
- **Live WordPress Site**: http://YOUR-PUBLIC-IP
- **Admin Access**: http://YOUR-PUBLIC-IP/wp-admin (admin/cloudboosta2024!)
- **Deployment Method**: AWS EC2 with Docker Compose

### **4.2 What Your Instructor Will See**
1. **Professional WordPress site** with Cloudboosta branding
2. **Custom theme** with business content
3. **Working admin panel** with full CMS functionality  
4. **Docker deployment** running on cloud infrastructure

---

## **💰 Cost Management**

### **Minimize AWS Charges**
- **Use t2.micro** (free tier: first 750 hours free)
- **Stop instance** when not needed: EC2 Console → Stop Instance
- **Expected cost**: $0.10-0.50/day for testing

### **Free Tier Benefits**
- **750 hours/month** of t2.micro instance time
- **30 GB** of EBS storage  
- **15 GB** of bandwidth

---

## **🆘 Troubleshooting**

### **If WordPress Doesn't Load**
```bash
# SSH into server
ssh -i your-key.pem ubuntu@YOUR-PUBLIC-IP

# Check setup logs
sudo tail -f /var/log/user-data.log

# Check container status
./status-cloudboosta.sh

# Restart if needed
./stop-cloudboosta.sh
./start-cloudboosta.sh
```

### **Security Group Issues**
- **Verify ports**: 22 (SSH), 80 (HTTP), 443 (HTTPS) are open
- **Source**: 0.0.0.0/0 for HTTP/HTTPS access

---

## **🎯 SUCCESS CRITERIA**

**✅ Deployment is successful when:**
1. Public IP loads Cloudboosta WordPress site
2. Admin panel accessible with provided credentials
3. Site shows professional business content
4. All Docker containers running properly
5. Site accessible from any internet connection

**🎉 Ready for assignment submission!**