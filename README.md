# Project Setup and Collaboration Guide

Follow this guide to set up the development environment and learn the workflow for contributing to this project.

---

## 1. Prerequisites

Before starting, ensure you have the following installed:

- **Laravel Herd**: This provides PHP and Composer.
- **Node.js & NPM**: Required for compiling styles and scripts.
- **Git**: To manage code versions.

**Important**: In Herd Settings, go to the "General" tab and click **"Add to Path"**. Afterward, close and restart your terminal to ensure the commands are recognized.

---

## 2. Initial Installation

Run these commands in your terminal to get the project files ready:

```bash
# Clone the project
git clone https://github.com/medu-x/cabinet-medical-web-app .

# Install PHP dependencies
composer install

# Install Frontend dependencies
npm install
```

---

## 3. Environment and Database Setup

We are using SQLite for simplicity. Follow these steps to configure your local environment:

1. **Create the SQLite file:**
   - Windows (PowerShell): `type nul > database/database.sqlite`
   - Mac/Linux: `touch database/database.sqlite`

2. **Setup the `.env` file:**
   - Copy the template: `cp .env.example .env`
   - Open the `.env` file and change the database settings to:

```env
DB_CONNECTION=sqlite
# You can comment out or delete DB_HOST, DB_PORT, DB_DATABASE, etc.
```

3. **Initialize the application:**

```bash
php artisan key:generate
php artisan migrate
```

---

## 4. Running the Project

To see the website in your browser, follow these two steps:

1. **Link the site to Herd:**



```bash
herd link
```

You can now access the site at: `http://<your-folder-name>.test`

-Manual Setup

or manually open the herd application -> choose sites -> link to un existing folder  -> chose folder where you cloned the project then -> open in the browser.

2. **Compile Assets (Tailwind CSS):** Keep this command running in a separate terminal window while you work:

```bash
npm run dev
```

---

## 5. Collaboration Workflow

To keep the main code stable, direct pushes to the `main` branch are restricted. Please use the following workflow:

1. **Pull Latest Changes:** Always start your day with:
   ```bash
   git pull origin main
   ```

2. **Create a Feature Branch:**
   ```bash
   git checkout -b feature-your-task-name
   ```

3. **Work and Commit:** Save your progress with:
   ```bash
   git add .
   git commit -m "Description of change"
   ```

4. **Push your Branch:**
   ```bash
   git push origin feature-your-task-name
   ```

5. **Open a Pull Request:** Go to the GitHub repository online and click **"Compare & pull request."**

> **Note:** I will review your Pull Request and merge it into the `main` branch once it is approved.
