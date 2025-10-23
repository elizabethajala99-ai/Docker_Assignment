# 🚀 AWS EC2 Deployment Guide for Cloudboosta WordPress

## 🎯 **EC2 vs Localhost Explained**

### **Localhost (Your Computer)**
- **URL**: http://localhost or http://127.0.0.1
- **Access**: Only you can see it
- **Purpose**: Development and testing
- **Cost**: Free (but requires Docker installed)

### **AWS EC2 (Cloud Server)**  
- **URL**: http://your-ec2-public-ip (e.g., http://54.123.45.67)
- **Access**: Anyone on internet can visit
- **Purpose**: Production deployment, assignment submission
- **Cost**: ~$0.10-0.50/day for testing

## 🛠️ **Step-by-Step EC2 Deployment**

### **Step 1: Create EC2 Instance**

1. **AWS Console** → EC2 → "Launch Instance"
2. **Name**: `Cloudboosta-WordPress-Server`
3. **AMI**: Ubuntu Server 22.04 LTS (Free tier eligible)
4. **Instance Type**: t2.micro or t3.small
5. **Key Pair**: Create new or select existing SSH key
6. **Security Group**: 
   - SSH (22) - Your IP only
   - HTTP (80) - Anywhere (0.0.0.0/0)
   - HTTPS (443) - Anywhere (0.0.0.0/0)

### **Step 2: User Data Script (Auto-Install)**

In **Advanced Details** → **User Data**, paste:

```bash
#!/bin/bash

# Update system
apt-get update -y

# Install Docker
apt-get install -y docker.io docker-compose-plugin

# Start Docker service
systemctl start docker
systemctl enable docker

# Add ubuntu user to docker group
usermod -aG docker ubuntu

# Install Git
apt-get install -y git

# Clone your WordPress repository
cd /home/ubuntu
git clone https://github.com/YOUR_USERNAME/cloudboosta-wordpress.git
chown -R ubuntu:ubuntu cloudboosta-wordpress

# Start WordPress deployment
cd cloudboosta-wordpress
docker compose -f docker-compose-apache.yml up -d --build

# Create startup script for easy management
cat > /home/ubuntu/start-cloudboosta.sh << 'EOF'
#!/bin/bash
cd /home/ubuntu/cloudboosta-wordpress
docker compose -f docker-compose-apache.yml up -d
echo "✅ Cloudboosta WordPress is running!"
echo "🌐 Visit: http://$(curl -s ifconfig.me)"
echo "👤 Admin: http://$(curl -s ifconfig.me)/wp-admin"
EOF

chmod +x /home/ubuntu/start-cloudboosta.sh
chown ubuntu:ubuntu /home/ubuntu/start-cloudboosta.sh

# Log completion
echo "✅ Cloudboosta WordPress deployment complete!" > /home/ubuntu/setup-complete.txt
echo "🌐 Public URL: http://$(curl -s ifconfig.me)" >> /home/ubuntu/setup-complete.txt
echo "👤 WordPress Admin: http://$(curl -s ifconfig.me)/wp-admin" >> /home/ubuntu/setup-complete.txt
echo "🔑 Login: admin / cloudboosta2024!" >> /home/ubuntu/setup-complete.txt
```

**⚠️ Replace `YOUR_USERNAME` with your actual GitHub username!**

### **Step 3: Launch and Wait**

1. **Click "Launch Instance"**
2. **Wait 5-10 minutes** for auto-setup to complete
3. **Get Public IP** from EC2 dashboard

### **Step 4: Access Your Live Site**

```bash
# Your WordPress site will be at:
http://YOUR-EC2-PUBLIC-IP

# WordPress admin panel:
http://YOUR-EC2-PUBLIC-IP/wp-admin
# Login: admin / cloudboosta2024!
```

## 🔍 **How to Find Your EC2 Public IP**

1. **AWS Console** → EC2 → Instances
2. **Select your instance**
3. **Copy "Public IPv4 address"** (e.g., 54.123.45.67)
4. **Visit**: http://54.123.45.67

## 🛠️ **SSH Access (Optional)**

```bash
# Connect to your server
ssh -i your-key.pem ubuntu@your-ec2-public-ip

# Check deployment status
cat setup-complete.txt

# Restart if needed
./start-cloudboosta.sh

# View logs
cd cloudboosta-wordpress
docker compose -f docker-compose-apache.yml logs -f
```

## 💰 **Cost Estimate**

### **t2.micro (Free Tier)**
- **First 750 hours/month**: FREE
- **After free tier**: ~$8.50/month
- **Testing period**: ~$0.10-0.30/day

### **t3.small (Better Performance)**
- **Cost**: ~$15/month
- **Testing period**: ~$0.50/day

**💡 Tip**: Stop instance when not in use to save money!

## 🎯 **What Your Instructor Will See**

1. **Visit your public URL**: http://your-ec2-public-ip
2. **See professional Cloudboosta WordPress site**
3. **Access admin panel**: /wp-admin with provided credentials
4. **Verify Docker deployment** working in cloud environment

## 🚀 **Assignment Submission**

### **Include in Your Report:**
- **GitHub Repository**: https://github.com/YOUR_USERNAME/cloudboosta-wordpress
- **Live Demo URL**: http://your-ec2-public-ip
- **Admin Access**: http://your-ec2-public-ip/wp-admin (admin/cloudboosta2024!)
- **Deployment Method**: AWS EC2 with Docker Compose

## 🛑 **Don't Forget to Stop EC2**

When done with assignment:
```bash
# AWS Console → EC2 → Select Instance → Instance State → Stop
```
**This prevents ongoing charges!**

---

## 🎯 **Quick Summary**

**For Assignment Success:**
1. ✅ **Push code to GitHub** (already done)
2. ✅ **Deploy on EC2** (follow guide above)
3. ✅ **Submit public URL** to instructor
4. ✅ **Demonstrate WordPress functionality**

**Your instructor needs to see a LIVE, publicly accessible WordPress site - not localhost!** 🌐