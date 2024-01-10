### 1. install composer
```sh
composer install
```

### 2. Ganti .env.example jadi .env
```sh
cp .env.example .env
```

### 3. install npm
```sh
npm i
```

### 4. migrate database
```sh
php artisan migrate
```

### 5. menyambungkan image
```sh
php artisan storage:link
```

### 6. generate key
```sh
php artisan key:generate
```

### 7. run npm
```sh
npm run dev
```

## 8. jalankan laravel
```sh
php artisan serve
```

### Note
Kalau gambar tidak muncul
```sh
rm public/storage
php artisan storage:link
```

Jika yang diatas gagal
```sh
rm -rf public/storage
php artisan storage:link
```

### Untuk Penggunaan Tailwindcss
```sh
npx tailwindcss -i ./public/css/input.css -o ./public/css/output.css --watch
```
