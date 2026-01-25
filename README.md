# Rabbit-MQ with Laravel and MySQL

This project sets up a Dockerized Laravel application with Nginx, PHP-FPM, MySQL, and RabbitMQ, including its management UI.

## How to Run the Project

This project uses Docker Compose to manage its services.

### Prerequisites

*   Docker Desktop or Docker Engine installed on your system.

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
    *   Build the PHP image, ensuring all Laravel dependencies are met.
    *   Start Nginx, configured to serve the Laravel application.
    *   Start the PHP-FPM service.
    *   Start the MySQL database.
    *   Start the RabbitMQ server with the management plugin enabled.

3.  **Run Laravel Migrations:**
    Once all services are up and running, execute Laravel migrations to set up your database schema:
    ```bash
    docker-compose run --rm php php artisan migrate --force
    ```

### Accessing the Applications

*   **Laravel Application:**
    Open your web browser and visit: [http://localhost:8080](http://localhost:8080)
    You should see the default Laravel welcome page.

*   **RabbitMQ Management UI:**
    Open your web browser and visit: [http://localhost:15672](http://localhost:15672)
    *   **Default Username:** `guest`
    *   **Default Password:** `guest`

*   **MySQL Database (from your host machine):**
    You can connect to the MySQL database on `localhost` via port `3307`.
    *   **Host:** `localhost`
    *   **Port:** `3307`
    *   **Username:** `laravel_user`
    *   **Password:** `laravel_password`
    *   **Database:** `laravel_db`
    (Note: The Laravel application connects to MySQL internally using the service name `mysql` and its default port `3306`).

### Stopping the Services

To stop all running containers and remove the Docker network associated with this project, run:
```bash
docker-compose down
```
