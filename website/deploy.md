# Deployment Instructions for VPS (145.223.22.9)

## Prerequisites
- Docker and Docker Compose installed on VPS
- SSH keys already exchanged
- Port 3000 open on VPS firewall

## Deployment Steps

### 1. Connect to VPS
```bash
ssh user@145.223.22.9
```

### 2. Clone or Update Repository
```bash
# If first deployment
git clone <repository-url> /opt/protect-children-website
cd /opt/protect-children-website

# If updating
cd /opt/protect-children-website
git pull origin master
```

### 3. Build and Deploy with Docker
```bash
# Build and start the container
docker-compose up -d --build

# Check container status
docker-compose ps

# View logs
docker-compose logs -f website
```

### 4. Verify Deployment
- Visit: http://145.223.22.9:3000
- Check all pages: /, /about, /resources, /contact, /donate
- Test theme toggle functionality
- Verify responsive design on mobile

### 5. Optional: Set up Nginx Reverse Proxy
```bash
# Install nginx if not already installed
sudo apt update && sudo apt install nginx

# Create nginx config
sudo nano /etc/nginx/sites-available/protect-children
```

Add this configuration:
```nginx
server {
    listen 80;
    server_name 145.223.22.9 your-domain.com;

    location / {
        proxy_pass http://localhost:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_cache_bypass $http_upgrade;
    }
}
```

Enable the site:
```bash
sudo ln -s /etc/nginx/sites-available/protect-children /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

## Maintenance Commands

### Update deployment
```bash
cd /opt/protect-children-website
git pull origin master
docker-compose up -d --build
```

### View logs
```bash
docker-compose logs -f website
```

### Restart service
```bash
docker-compose restart website
```

### Stop service
```bash
docker-compose down
```

## SSL Certificate (Optional)
For production with a domain name, use Let's Encrypt:
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d your-domain.com
```

## Monitoring
- Check container health: `docker-compose ps`
- Monitor logs: `docker-compose logs website`
- Check system resources: `htop` or `docker stats`