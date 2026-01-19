<h1 align="center">🔐 Password Manager</h1>

<p align="center">
  A Laravel password manager with <b>2‑Factor Authentication (TOTP)</b> using Google Authenticator or Microsoft Authenticator.
</p>

<p align="center">
  <img alt="Laravel" src="https://img.shields.io/badge/Laravel-Framework-FF2D20?logo=laravel&logoColor=white">
  <img alt="PHP" src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white">
  <img alt="2FA" src="https://img.shields.io/badge/2FA-TOTP-0EA5E9">
  <img alt="Status" src="https://img.shields.io/badge/Status-Active-22C55E">
  <img alt="License" src="https://img.shields.io/badge/License-Private-64748B">
</p>

---

## ✨ Features
- 🔐 User authentication
- 📲 2FA (TOTP) with **Google Authenticator** or **Microsoft Authenticator**
- 🧾 Dashboard after successful login + OTP verification
- 🗝️ Save and manage passwords/credentials

---

## 🧭 Table of Contents
- [How it Works](#-how-it-works)
- [Tech Stack](#-tech-stack)
- [Requirements](#-requirements)
- [Getting Started](#-getting-started)
- [2FA Setup & Login Flow](#-2fa-setup--login-flow)
- [Deployment](#-deployment)
- [Security Notes](#-security-notes)
- [Disclaimer](#-disclaimer)

---

## 🔄 How it Works
1. User logs in with username/password  
2. App shows a QR code for TOTP (first-time setup)  
3. User scans the QR code using Google Authenticator / Microsoft Authenticator  
4. User enters the 6‑digit code from the app  
5. On success → user is redirected to the Dashboard  
6. User can start saving passwords

---

## 🧰 Tech Stack
- Laravel
- PHP / Composer
- Node.js / NPM (Vite)
- MySQL/MariaDB (or PostgreSQL)

> If this project uses a specific 2FA package, add it here (name + link) and document any extra config steps.

---

## 📦 Requirements
- PHP 8.2+ (recommended)
- Composer
- Node.js + NPM
- Database: MySQL/MariaDB (or PostgreSQL)
- Web server: NGINX or Apache
- Git

---

## 🚀 Getting Started

### 1) Clone the repository
```bash
git clone git@github.com:ryanboc/<YOUR-REPO>.git
cd <YOUR-PROJECT-FOLDER>
```

### 2) Install dependencies
```bash
composer install
npm install
```

### 3) Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` (DB, APP_URL, etc). Example:
```env
APP_NAME="Password Manager"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://password-manager.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=password_manager
DB_USERNAME=root
DB_PASSWORD=secret
```

### 4) Permissions
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### 5) Database
```bash
php artisan migrate
```

(Optional) Seeders (only if included):
```bash
php artisan db:seed
```

### 6) Frontend assets
Development:
```bash
npm run dev
```

Production:
```bash
npm run build
```

---

## 📲 2FA Setup & Login Flow

### First time setup
1. Log in with your account
2. The app will display a **QR code**
3. Open **Google Authenticator** or **Microsoft Authenticator**
4. Add account → **Scan a QR code**
5. Enter the 6‑digit code shown in your Authenticator app
6. After verification, you’ll be redirected to the **Dashboard**

### Future logins
1. Log in with username/password
2. Enter the current 6‑digit OTP code from your Authenticator app
3. Access Dashboard → manage your saved passwords

---

## 🌐 Deployment
> Replace paths, domain, and PHP-FPM version to match your environment.

### NGINX (recommended)
```nginx
server {
    listen 80;
    server_name password-manager.yourdomain.com;

    root /var/www/password-manager/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock; # adjust version/path
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    client_max_body_size 20M;
}
```

Enable and reload:
```bash
sudo ln -s /etc/nginx/sites-available/password-manager /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### Apache (with rewrite)
```apache
<VirtualHost *:80>
    ServerName password-manager.yourdomain.com
    DocumentRoot /var/www/password-manager/public

    <Directory /var/www/password-manager/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/password-manager-error.log
    CustomLog ${APACHE_LOG_DIR}/password-manager-access.log combined
</VirtualHost>
```

Enable and reload:
```bash
sudo a2enmod rewrite
sudo a2ensite password-manager.conf
sudo apache2ctl configtest
sudo systemctl reload apache2
```

---

## 🛡️ Security Notes
- Use HTTPS in production.
- Use strong passwords and enable 2FA.
- Treat this as a personal tool unless you have completed a proper security review.
- Do not store sensitive secrets on shared or untrusted servers.

---

## ⚠️ Disclaimer
This project is provided **for personal use** and is offered **“as is”** without warranties of any kind.

- **The application and its developer are not responsible** for exposed passwords, leaks, unauthorized access, or any loss/damage resulting from the use of this software.
- **You (the user) are responsible** for securing your environment (server, database, backups, access controls) and for any risks associated with storing credentials.

> Not legal advice. If you plan to use this beyond personal use, consult a professional and conduct a security audit.

---

## 📄 License
Private / Internal project (update as needed).