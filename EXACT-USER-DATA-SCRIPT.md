# 📋 **COPY THIS EXACT USER DATA SCRIPT**

## 🎯 **Where to Add This in AWS:**

1. **AWS Console** → **EC2** → **Launch Instance**
2. Scroll down to **"Advanced Details"**
3. Find **"User data"** section
4. **Copy and paste** the script below

---

## 🚀 **USER DATA SCRIPT (Copy Everything Below):**

```bash
#!/bin/bash

# Log all output for debugging
exec > >(tee /var/log/user-data.log) 2>&1

echo "🚀 Starting Docker Assignment WordPress deployment setup..."

# Update system packages
apt-get update -y

# Install prerequisites for Docker
apt-get install -y ca-certificates curl gnupg lsb-release git

# Add Docker's official GPG key
mkdir -p /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --dearmor -o /etc/apt/keyrings/docker.gpg

# Set up Docker repository
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null

# Update package index with Docker repo
apt-get update -y

# Install Docker Engine and Compose
apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Start and enable Docker
systemctl start docker
systemctl enable docker

# Add ubuntu user to docker group
usermod -aG docker ubuntu

# Wait for Docker to be fully ready
sleep 15

# Create deployment directory
cd /home/ubuntu

# Clone your WordPress repository
echo "📦 Cloning Docker Assignment repository..."
git clone https://github.com/elizabethajala99-ai/Docker_Assignment.git

# Set proper ownership
chown -R ubuntu:ubuntu Docker_Assignment

# Navigate to project directory
cd Docker_Assignment

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
cd /home/ubuntu/Docker_Assignment
docker compose -f docker-compose-apache.yml up -d
echo "✅ Cloudboosta WordPress is running!"
echo "🌐 Website: http://$(curl -s ifconfig.me)"
echo "👤 Admin: http://$(curl -s ifconfig.me)/wp-admin"
echo "🔑 Login: admin / cloudboosta2024!"
EOF

cat > /home/ubuntu/stop-cloudboosta.sh << 'EOF'
#!/bin/bash
cd /home/ubuntu/Docker_Assignment
docker compose -f docker-compose-apache.yml down
echo "🛑 Cloudboosta WordPress stopped"
EOF

cat > /home/ubuntu/status-cloudboosta.sh << 'EOF'
#!/bin/bash
cd /home/ubuntu/Docker_Assignment
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

📁 PROJECT LOCATION: /home/ubuntu/Docker_Assignment

🛠️ MANAGEMENT COMMANDS:
- ./start-cloudboosta.sh   (start services)
- ./stop-cloudboosta.sh    (stop services)  
- ./status-cloudboosta.sh  (check status)

📋 ASSIGNMENT SUBMISSION:
- GitHub: https://github.com/elizabethajala99-ai/Docker_Assignment
- Live Demo: http://$PUBLIC_IP
- Admin Panel: http://$PUBLIC_IP/wp-admin

✅ Ready for instructor evaluation!
EOF

chown ubuntu:ubuntu /home/ubuntu/deployment-info.txt

echo "✅ Cloudboosta WordPress deployment setup complete!"
echo "🌐 Visit: http://$PUBLIC_IP"
```

---

## 🎯 **IMPORTANT: This Script Does Everything Automatically!**

### **What This Script Does:**
1. ✅ **Installs Docker** and Docker Compose
2. ✅ **Clones your GitHub repository** (Docker_Assignment)
3. ✅ **Starts WordPress deployment** automatically
4. ✅ **Creates management scripts** for easy control
5. ✅ **Shows you the URLs** to access your site

### **After 5-10 Minutes You'll Have:**
- 🌐 **WordPress Site**: `http://YOUR-EC2-PUBLIC-IP`
- 👤 **Admin Panel**: `http://YOUR-EC2-PUBLIC-IP/wp-admin`
- 🔑 **Login**: admin / cloudboosta2024!

---

## 📋 **Step-by-Step EC2 Setup:**

### **1. Launch Instance:**
- **Name**: Docker-Assignment-WordPress
- **AMI**: Ubuntu Server 22.04 LTS
- **Instance**: t2.micro (free tier)

### **2. Security Group:**
- **SSH (22)**: Your IP
- **HTTP (80)**: 0.0.0.0/0 ✅
- **HTTPS (443)**: 0.0.0.0/0 ✅

### **3. Advanced Details:**
- **User Data**: ✅ **Paste the script above**

### **4. Launch & Wait:**
- ⏳ **Wait 5-10 minutes** for auto-setup
- 🎯 **Get Public IP** from EC2 console
- 🌐 **Visit**: http://your-public-ip

---

## 🎉 **That's It!**

**The script handles everything automatically. Just paste it into User Data and launch your EC2 instance!**

**Your WordPress site will be live and ready for assignment submission!** 🚀