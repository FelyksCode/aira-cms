# AIRA Content Management System

Web-based Content Management System for AIRA.

Using Laravel 12 and Filament v.4

## Installation

App Requirements

-   PHP ≥ 8.1
-   [Composer](https://getcomposer.org)
-   Database (MySQL/MariaDB, PostgreSQL, SQLite)
-   Node.js + NPM/Yarn
-   Laravel ≥ 10

### Steps For Setting Up the Project

&nbsp;1. Cloning the project into local directory

```
    git clone https://github.com/FelyksCode/aira-cms.git

    cd aira-cms
```

&nbsp;2. Install the project dependencies

```
    composer install
    npm install
```

&nbsp;3. Setup the project environment configuration

```
    cp .env.example .env
    php artisan key:generate
    php artisan storage:link
```

### For Local Development

&nbsp;4. Environment Configuration

In `.env` file add

```
    USER_NAME=demo              # Change Name, Email and Password
    USER_EMAIL=demo@demo.com    #
    USER_PASSWORD=123           #
```

&nbsp;5. Run the migrations

Before running the migrations make sure the database config inside the `.env` file is correct

```
    php artisan migrate
```

&nbsp;6. Seed the database

```
    php artisan db:seed
```

&nbsp;7. Run the project

```
    composer dev
```

&nbsp; or

```
Terminal 1:
    php artisan serve

Terminal 2:
    npm run dev
```

### For Production

Run the build script

```
    npm run build
```
