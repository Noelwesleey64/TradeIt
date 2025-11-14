# FrankenPHP and Laravel Octane with Docker + Laravel 11 & Laravel 12

This repo is a docker boilerplate to use for Laravel projects. Containers included in this docker:

1. [Laravel 11 & 12](https://laravel.com/docs/)
2. [FrankenPHP](https://frankenphp.dev/docs/docker/)
3. PostgreSQL
4. Redis
5. Supervisor
6. [Octane](https://laravel.com/docs/octane)
7. Minio for S3
8. MailPit

The purpose of this repo is to run [Laravel 11 & Laravel 12](https://laravel.com/docs/) in a Docker container using [Octane](https://laravel.com/docs/octane) and [FrankenPHP](https://frankenphp.dev/docs/docker/).

## Installation

Use the package manager [git](https://git-scm.com/downloads) to install Docker boilerplate.

```bash
# setup project locally
$ git clone https://github.com/jaygaha/laravel-11-frankenphp-docker.git
# Navigate to project directory:
$ cd laravel-11-frankenphp-docker
```

## Application Setup

Copy the .env.example file to .env:

```bash
# Linux
$ cp .env.example .env
# OR
# Windows
$ copy .env.example .env
```

Edit the `.env` file to configure your application settings. At a minimum, you should set the following variables:

- `APP_NAME`: The name of your application.
- `APP_ENV`: The environment your application is running in (e.g., local, production).
- `APP_KEY`: The application key (will be generated in the next step).
- `APP_DEBUG`: Set to `true` for debugging.
- `APP_URL`: The URL of your application.
- `DB_CONNECTION`: The database connection (e.g., pgsql).
- `DB_HOST`: The database host.
- `DB_PORT`: The database port.
- `DB_DATABASE`: The database name.
- `DB_USERNAME`: The database username.
- `DB_PASSWORD`: The database password.

**Edit docker related setting according to your preferences.**

Run composer to install the required packages:

```bash
# install required packages
$ composer install
```

Generate a new application key:

```bash
# app key setup
$ php artisan key:generate
```

## Usage

Build the Docker images:

```bash
# build docker images
$ docker compose build
```

Run the containers:

```bash
# Run containers
$ docker compose up -d
```

To stop the containers, run:

```bash
# Stop containers
$ docker compose down
```

To view the logs of a specific container, run:
MailPit (local SMTP testing)

This repo includes MailPit as a local SMTP sink for development. By default the Mailpit container listens on port 1025 (SMTP) and exposes a web dashboard on port 8025.

- For containers on the same Docker network (recommended), use the service name as the SMTP host in your `.env`:

	MAIL_MAILER=smtp
	MAIL_HOST=mailpit
	MAIL_PORT=1025

- If you're accessing Mailpit from the host machine, use the forwarded ports configured in `.env`:

	SMTP: localhost:${FORWARD_MAILPIT_PORT}
	Dashboard: http://localhost:${FORWARD_MAILPIT_DASHBOARD_PORT}

Quick test (inside the web container):

```bash
docker compose exec tradeit.user_service.web bash
# from inside container
php artisan tinker
Mail::raw('Hello from docker', function ($m) {
		$m->to('test@example.com');
		$m->subject('SMTP test');
});
```

Then open Dashboard at http://localhost:${FORWARD_MAILPIT_DASHBOARD_PORT} to view captured messages.

Horizon (Queue monitoring)

This project uses Laravel Horizon to manage Redis-backed queues. A dedicated `horizon` container has been added to `docker-compose.yml` to run the Horizon process automatically.

- Start Horizon with the rest of your stack:
	```bash
	docker compose up -d
	```

- The Horizon process is started inside the container by running `php artisan horizon` and will restart automatically if it crashes.

- Horizon dashboard is available via the web application, typically at `/horizon` (e.g., http://localhost:${APP_PORT:-8000}/horizon). Be sure to secure it in production — the dashboard should only be accessed by authorized users.

To view Horizon logs:

```bash
docker compose logs -f tradeit.user_service.horizon
```

```bash
# View logs
$ docker compose logs <container_name>
```

**If you are using podman replace `docker` with `podman`**

To access the application, open your browser and navigate to the URL specified in the `APP_URL` variable in your `.env` file.


## Upgrading

Upgrading To 12.0 From 11.x

```bash
$ composer update
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

FREE TO USE

### Happy Coding :)
