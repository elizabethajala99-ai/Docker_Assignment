#!/bin/bash

echo "🚀 Cloudboosta WordPress - GitHub Push Script"
echo "============================================="

# Check if we're in the right directory
if [ ! -f "docker-compose-apache.yml" ]; then
    echo "❌ Error: Run this script from the submission folder"
    echo "Usage: cd /home/elizabeth/Docker_assignment/submission && ./push-to-github.sh"
    exit 1
fi

# Get GitHub username
echo "📝 Enter your GitHub username:"
read GITHUB_USERNAME

if [ -z "$GITHUB_USERNAME" ]; then
    echo "❌ GitHub username is required!"
    exit 1
fi

echo "📦 Initializing Git repository..."
git init

echo "📁 Adding all files..."
git add .

echo "💾 Committing changes..."
git commit -m "Complete Cloudboosta WordPress Docker deployment with custom theme

Features:
- WordPress with custom Cloudboosta business theme
- Docker Compose deployment with Apache
- MySQL database with phpMyAdmin
- Professional cloud solutions website
- Auto-initialization scripts
- EC2 deployment ready

Components:
- Custom WordPress theme with Cloudboosta branding  
- Services: AWS, Docker, DevOps, Security, Kubernetes, Monitoring
- Company information and contact details
- Responsive design and professional layout
- Admin panel: admin/cloudboosta2024!
"

echo "🔗 Adding GitHub remote..."
git remote add origin https://github.com/$GITHUB_USERNAME/docker-assignment.git

echo "🚀 Pushing to GitHub..."
git branch -M main
git push -u origin main

if [ $? -eq 0 ]; then
    echo ""
    echo "✅ SUCCESS! Code pushed to GitHub"
    echo "📋 Repository: https://github.com/$GITHUB_USERNAME/docker-assignment"
    echo ""
    echo "🎯 Next Steps:"
    echo "1. 🌐 Go to AWS Console → EC2 → Launch Instance"
    echo "2. 📋 Use the User Data script from STEP-BY-STEP-EC2-GUIDE.md"
    echo "3. 🔄 Replace YOUR_USERNAME with: $GITHUB_USERNAME"
    echo "4. 🚀 Launch and wait 5-10 minutes"
    echo "5. 🌍 Access your live WordPress site!"
    echo ""
    echo "📖 Full guide: ./STEP-BY-STEP-EC2-GUIDE.md"
else
    echo "❌ Push failed! Check your GitHub username and repository creation."
    echo "💡 Make sure you've created the repository on GitHub first:"
    echo "   → Go to github.com → New Repository → Name: Docker_Assignment"
fi