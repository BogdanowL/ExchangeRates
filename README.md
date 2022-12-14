##  Laravel 9 and Vue.Js
### Виджет обновления курсов валют в реальном времени
#### Для запуска приложения выполните команды:
```DB : MySql```
```shell
    composer install
    npm install
    npm run build
    php artisan migrate
    php artisan serve
```

```html
Необходимо включить очереди.
.env
QUEUE_CONNECTION=database
```
```shell
php artisan queue:work --queue=high,default
```
Команды:
```shell
Посев данных за {int} прошедших дней: 
shell seed:rates

Обновление курсов валют за сегодня:
shell cron:update

Запуск cron для фонового обновления скрипта:
php artisan schedule:work
```

[![currency-Rate.png](https://i.postimg.cc/B6QkYTgp/currency-Rate.png)](https://postimg.cc/VSpK5b20)


