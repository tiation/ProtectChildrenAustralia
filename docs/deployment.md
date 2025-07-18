# Deployment Guide

This guide details how to deploy the Protect Children Australia website on a production server.

## Prerequisites

1. **Server Setup**: Any cloud or on-premise Linux server.
2. **Software**:
   - Apache/Nginx installed.
   - PHP 7.4+ with required extensions.
   - MySQL 5.7+ database.

## Steps

1. **Clone Repository**:
   ```bash
   git clone https://github.com/yourusername/protectchildren.git
   ```

2. **Web Server Configuration**:
   - Configure server to point to `public` directory.
   - Ensure PHP is properly configured.

3. **Environment Setup**:
   - Copy `config.example.php` to `config.php`.
   - Update database credentials and site URL.

4. **Database Initialization**:
   - Import schema from `db/database_init.sql`.

5. **Testing**:
   - Ensure all functionalities work as expected.

6. **Go Live**:
   - Monitor logs and performance metrics.

For detailed information, consult the [Admin Guide](./admin-guide.md).
