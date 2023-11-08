### Как поднять проект  
docker-composer up -d  
composer install  
cp .env.example .env  
php artisan migrate  
php artisan db:seed  
php artisan queue:work  
php artisan schedule:work  
php artisan user:check_expiration  
php artisan user:member  
php artisan schedule:work  
# Задача:  
Предоставить git репозиторий на Laravel с функционалом:  
## Миграции:  
 - users  
    - id - автоинкремент  
    - name  
    - email  
    - active по-умолчанию true  
    - приветствуется наличие правильных ключей  
- groups  
    - id - автоинкремент  
    - name  
    - expire_hours с комментарием «через какое количество часов пользователь после добавления в группу должен быть исключен из группы»  
    - приветствуется наличие правильных ключей  
- group_user  
    - user_id – внешний ключ на пользователя  
    - group_id – внешний ключ на группу  
    - expired_at – datetime  
    - приветствуется наличие правильных обоснованных ключей  
    - обеспечить уникальность пары user_id <-> group_id  
## Сидеры  
- groups  
    - [name: Группа1, expire_hours: 1]  
    - [name: Группа2, expire_hours: 2]  
- users  
    - [name: Иванов, email: info@datainlife.ru]  
    - [name: Петров, email: job@datainlife.ru]  
## Модели с реляциями:  
- User  
    - Реляция, в каких группах состоит  
- Group  
    - Реляция, какие пользователи состоят в группе  
## Обсервер:  
При добавлении пользователя в группу автоматически заполнить поле expired_at, равным количеству часов, указанному в expire_hours у группы, в которую добавляется пользователь  
### Написать консольные команды:  
- php artisan user:member  
    - запросить user_id пользователя  
    - запросить group_id группы  
    - добавить пользователя user_id в группу group_id, если пользователь не активен (active == false), активировать его (active = true)  
- php artisan user:check_expiration  
    - всех пользователей исключить из групп, у которых expired_at меньше текущего момента времени  
    - приветствуется – по факту исключения пользователя из группы отослать email пользователю: Здравствуйте name! Истекло время вашего участия в группе name.(есть)  
    - приветствуется – по факту исключения пользователя из группы поставить в очередь задачу: если пользователь не входит ни в одну группу, деактивировать его (установить у пользователя active = false).(есть)  
### Добавить команду user:check_expiration в расписание на выполнение раз в 10 минут  

