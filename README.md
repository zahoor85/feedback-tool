# Rest API Backend

Rest API backend built with Laravel

## How to run it
```bash

# install dependencies
composer install

# make changes in the .env with respect to your DB setting ets

# Migrage the Tables
php artisan migrate

# run migrations with seeder
php migrate --seed

# start dev server
php artisan serve
```


===========

# Vue 3 + Vite

Frontent code has been shift here & built with vuejs

## How to run it
```
1st Configure the rest-api and up with the php artisan command and copy the URL and past in the .evn file also, past the same Url in in the main.js file as axios.defaults.baseURL="{{REST_API_URL}}"

# copy .env
cp .env .env.example

# install dependencies
npm install

# install tailwind:
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

# install toast notification
npm i vue-toastification@next

# install some extra packages 
npm install quill quill-mention
npm install quill-syntax
npm install highlight.js

# serve project to run the vite local server
npm run serve
```

