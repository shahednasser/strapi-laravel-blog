# Strapi + Laravel Tutorial

Code for tutorial for Laravel blog with Strapi v4.

## Prerequisites

1. Node v12 or v14. v14 is recommended
2. PHP >= 7.3
3. Composer

## Installation

Change to the `strapi` directory and run the following:

```bash
npm install
```

Then, change to the `blog` directory and run the following:

```bash
composer install
```

You also need to copy and rename `.env.example` to `.env`:

```bash
cp .env.example .env
```

Then, add the following environment variables at the end of `.env`:

```
STRAPI_URL=
STRAPI_API_TOKEN=
```

`STRAPI_URL` is the URL to your Strapi installation. If you're running it local, it should be `http://localhost:1337`.

`STRAPI_API_TOKEN` is the API Token you create in Strapi Admin. You can check the tutorial to learn how to do that.

## Run the Servers

Change to the `strapi` directory and run the following command:

```bash
npm run develop
```

This will start Strapi's server at `http://localhost:1337`.

You'll need to add the content types and entries using the admin. You can follow along in the tutorial to learn how to do that.

Then, go to the `blog` directory using another terminal and run the following command:

```bash
php artisan serve
```

This will start the Laravel server at `http://localhost:8000`.
