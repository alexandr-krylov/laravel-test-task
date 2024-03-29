# Test task Laravel
## Task
Разработать функционал на Laravel c базой данных PostgreSQL.

Реализовать вывод списка продуктов, просмотр карточки продукта, добавление,  редактирование и удаление продукта.

Создать таблицу «products».  
| field | type | properties |
|-|-|-|
| ID | uinque, autoincrement | |
| ARTICLE | varchar(255), unique index | |
| NAME | varchar(255) | |
| STATUS | varchar(255) | "available" \| "unavailable" |
| DATA | jsonb | несколько разных полей (например, Color и Size) на своё усмотрение |
| | timestamps | |
| | soft deletes | |



Создать Eloquent-модель «Product», связанную с таблицей «products».
В модели реализовать Local Scope для получения только доступных продуктов (STATUS = “available”).

Сделать валидацию создания и редактирования:
NAME — обязательное поле, длиной не менее 10 символов;
ARTICLE — обязательное поле, только латинские символы и цифры, уникальное в таблице.

Создать роль администратора, который может редактировать артикул, остальным пользователям можно редактировать всё, кроме артикула.
Роль пользователя можно узнать из настроек (config(‘products.role’)).
Реализовать валидацию и проверку прав (контроллер, модель, отдельный сервис — на своё усмотрение).

Дополнительно:
При создании продукта реализовать отправку на заданный в конфигурации Email (config(‘products.email’)) уведомления (Notification) о том, что продукт создан.
Уведомление должно отправляться через задачу (Job) в очереди (Queue).
Готовое приложение упаковать в docker.
## how to install
### cloning repository
```
git clone https://github.com/alexandr-krylov/laravel-test-task.git
```
### install dependences
```

cd laravel-test-task
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

```
### setup .env
```
cp .env.example .env

DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laravel_test_task
DB_USERNAME=sail
DB_PASSWORD=password

QUEUE_CONNECTION=redis

REDIS_HOST=redis
```
### start containers
```
docker-compose up
```
### generate application key
```
docker exec -it laravel-test-task_laravel.test_1 ./artisan key:generate
```
### build frontend
```
docker exec -it laravel-test-task_laravel.test_1 npm run build
docker exec -it laravel-test-task_laravel.test_1 npm run dev
```
### migrate database
```
docker exec -it laravel-test-task_laravel.test_1 ./artisan migrate
```
### starting queue
```
docker exec -it laravel-test-task_laravel.test_1 ./artisan queue:work
```
## How to use

### create user
http://localhost/register

if username was mentioned in config/products this user can editing article

http://localhost/login
### operate products
http://localhost/product

After adding roduct you can see email in http://localhost:8025


