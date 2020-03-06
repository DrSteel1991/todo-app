## Clone this repo

```bash
git clone git@github.com:DrSteel1991/todo-app.git
cd docker-lumen/images/php
```

### Build & Run

```bash
docker-compose up --build -d
```

Navigate to [http://localhost:80](http://localhost:80) and you should see something like this
![image](Lumen_browser.png)


### Stop Everything

```bash
docker-compose down
```

## Documentation
This is only simple todo list REST api

User only able to access their own ToDo list.

## Endpoint

Before using the api, run this command to create the tables and seed some data.

```bash
php artisan migrate
php artisan db:seed
```

# Header
- Content-Type: application/json
- Accept: application/json

http://localhost/api/register
- firstName
- lastName
- email
- password
- mobile
- gender
- dateOfBirth

# Users endpoint
http://localhost/api/login
- email
- password

# ToDo endpoint

## List all available todo (method:GET)
http://your-domain-host/api/todo/

has parameter of
 - order_by=column_name
 - direction=<ASC or DESC>

 example http://localhost/api/todo/?order_by=priority&direction=DESC

## Display todo by status (method:GET)
- status=<completed or snozzed or overdue>
example http://localhost/api/todo/?status=completed


