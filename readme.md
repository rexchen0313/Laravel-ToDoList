# Laravel To-Do List
本專案目的: 以 To-Do List 為題目，練習 Laravel 框架的使用與基本的 restful API 的開發

## restful API
```
GET     loalhost/todo
GET     loalhost/todo/{id}
POST    loalhost/todo
PATCH   loalhost/todo/{id}
DELETE  loalhost/todo/{id}
```
## 建立資料表
```
php artisan migrate --path=/database/migrations/todolist
```
## 產生假資料(中文)
透過 Laravel 套件 Faker、Factory 、Seeder 的搭配來產生
```
php artisan db:seed --class=TodolistTableSeeder
```
