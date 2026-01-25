# Rabbit-MQ with Laravel, MySQL, and phpMyAdmin

This project sets up a Dockerized Laravel application with Nginx, PHP-FPM, MySQL, phpMyAdmin, and RabbitMQ (including its management UI).

## How to Run the Project

This project uses Docker Compose to manage its services.

### Prerequisites

- Docker Desktop or Docker Engine installed on your system.

### Steps to Get Started

1.  **Navigate to the project directory:**

    ```bash
    cd /path/to/your/rabbit_mq
    ```

2.  **Start the services:**
    Build the necessary images and start all containers in detached mode:

    ```bash
    docker-compose up -d --build
    ```

    This command will:
    - Build the PHP image, ensuring all Laravel dependencies are met.
    - Start Nginx, configured to serve the Laravel application.
    - Start the PHP-FPM service.
    - Start the MySQL database.
    - Start the phpMyAdmin web interface for MySQL.
    - Start the RabbitMQ server with the management plugin enabled.

3.  **Run Laravel Migrations:**
    Once all services are up and running, execute Laravel migrations to set up your database schema:
    ```bash
    docker-compose run --rm php php artisan migrate --force
    ```

### Accessing the Applications

- **Laravel Application:**
  Open your web browser and visit: [http://localhost:8080](http://localhost:8080)
  You should see the default Laravel welcome page.

- **phpMyAdmin Interface:**
  Open your web browser and visit: [http://localhost:8081](http://localhost:8081)
  - **Username:** `laravel_user` (or `root`)
  - **Password:** `laravel_password` (or `root_password`)
  - **Server:** `mysql` (This is the name of the MySQL service in your `docker-compose.yml` file)

- **RabbitMQ Management UI:**
  Open your web browser and visit: [http://localhost:15672](http://localhost:15672)
  - **Default Username:** `guest`
  - **Default Password:** `guest`

- **MySQL Database (from your host machine):**
  You can connect to the MySQL database on `localhost` via port `3307`.
  - **Host:** `localhost`
  - **Port:** `3307`
  - **Username:** `laravel_user`
  - **Password:** `laravel_password`
  - **Database:** `laravel_db`
    (Note: The Laravel application connects to MySQL internally using the service name `mysql` and its default port `3306`).

### Running Composer Commands

To run Composer commands, you should execute them directly within your `php` service container:

```bash
docker-compose exec php composer install
# or
docker-compose exec php composer update
```

To get a shell inside the `php` container to run multiple commands or inspect the environment:

```bash
docker-compose exec php sh
```

### Stopping the Services

To stop all running containers and remove the Docker network associated with this project, run:

```bash
docker-compose down
```

**To access the phpMyAdmin interface:**

1.  Open your web browser and go to: **[http://localhost:8081](http://localhost:8081)**
    - **Username:** `laravel_user` (or `root`)
    - **Password:** `laravel_password` (or `root_password`)
    - **Server:** `mysql` (This is the name of the MySQL service in your `docker-compose.yml` file)

**To access the RabbitMQ Management UI:**

1.  Open your web browser and go to: **[http://localhost:15672](http://localhost:15672)**
    - **Default Username:** `guest`
    - **Default Password:** `guest`

**To access the MySQL Database (from your host machine, e.g., using a client like MySQL Workbench or the `mysql` command-line tool):**

1.  Connect to `localhost` on port `3307`.
    - **Username:** `laravel_user`
    - **Password:** `laravel_password`
    - **Database:** `laravel_db`
