# 0Auth API boilerplate for laravel

This API provides robust and secure authentication using OAuth, built on Laravel. It supports user registration, login, and token-based authentication, making it ideal for integrating with web and mobile applications.

## Features

- User registration and login.
- OAuth 2.0 token-based authentication.
- Secure access to API routes with middleware.
- Easily extendable for additional scopes and endpoints.

## Installation

1. Clone the repository:
    ```
    git clone https://github.com/diegohpezet/0Auth-Laravel11-API-Boilerplate.git
    ```

2. Install dependencies
    ```
    composer install
    ```

3. Create a file for environment variables
    ```
    cp .env.example .env
    ```
  
4. Configure the environment variables. You should change database settings, mail settings and provider settings to use your own credentials

5. Generate application key
    ```
    php artisan key:generate
    ```

6. Run database migrations
    ```
    php artisan migrate
    ```

## Usage

The API provides several endpoints for user authentication and email recovery

Some of them are listed below

- **Register**

    Endpoint: `POST /api/register`

    Requires token: No

    Payload:
    ```json
    {
      "name": "Jhon Doe",
      "email": "jhondoe@gmail.com",
      "password": "password",
      "password_confirmation": "password"
    }
    ```

- **Login**

    Endpoint: `POST /api/login`

    Requires token: No

    Payload:
    ```json
    {
      "email": "jhondoe@gmail.com",
      "password": "password"
    }
    ```

- **Logout**

    Endpoint: `POST /api/logout`

    Requires token: Yes

- **Login using provider**

    Endpoint: `GET /api/auth/{provider}`

    Requires token: No

- etc

## LICENSE

This project is licensed under the MIT license. See the LICENSE file for details.
