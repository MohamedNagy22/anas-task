# anas-task

**anas-task** is a Laravel-based application that demonstrates user authentication, authorization, and token-based API authentication using Laravel Sanctum. Additionally, it uses Laravel Breeze for scaffolding the initial authentication flow and blade templates. The project includes a `Product` model with dummy data (seeded), and routes that allow authenticated users to access and manage products. A Postman environment and request collection have been provided for easy testing.

## Features

- **Authentication & Authorization**
  - Uses [Laravel Breeze](https://laravel.com/docs/master/starter-kits#laravel-breeze) to provide a clean, minimal starting point with basic authentication (login, registration, password reset).
  - Integrates roles (admin/user) for authorization logic (e.g., protecting certain routes for admins only).

- **API Token-Based Authentication**
  - Uses [Laravel Sanctum](https://laravel.com/docs/master/sanctum) to issue API tokens.
  - Tokens are created on login and revoked on logout, ensuring tokens are only valid until the user explicitly logs out.

- **Products Management**
  - Includes a `Product` model.
  - Database seeding to create dummy product data.
  - Routes to show all products (admin-only) and to create new products.
  
- **Testing**
  - Includes a Postman collection and environment export for quick testing of the API endpoints.
  - A `.sql` file is provided with dummy data for direct import if needed.
  
## Prerequisites

- PHP >= 8.x
- Composer
- MySQL or another supported database
- Node.js & npm (for front-end assets compilation)

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/MohamedNagy22/anas-task.git
   cd anas-task
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**:
   - Copy `.env.example` to `.env`
   - Configure your database credentials in `.env`:
     ```env
     DB_DATABASE=anas_task
     DB_USERNAME=root
     DB_PASSWORD=secret
     ```
   - Set your application URL and other necessary environment variables as needed.

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

6. **Run Seeders**:
   To seed the products table with dummy data:
   ```bash
   php artisan db:seed --class=ProductSeeder
   ```

7. **Install Laravel Breeze** (if not already done):
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install
   npm run dev
   ```

8. **Install and Configure Sanctum** (if not already done):
   ```bash
   composer require laravel/sanctum
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   php artisan migrate
   ```

## Running the Application

You can start the Laravel development server:

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser to see the application.

## Authentication Flow

- **Registration**: Register a new user through the Breeze scaffolding (`/register`).
- **Login**: After registration, log in with the same credentials (`/login`).
- **API Token Generation**: Upon successful login, a Sanctum token will be created.
- **Logout**: When you log out, the previously issued token is revoked, making it invalid for subsequent requests.

## Using the Postman Collection

A Postman collection and environment file have been exported and included in the repository:

1. Import the Postman environment file (`anas-task.postman_environment.json`) into Postman.
2. Import the Postman collection file (`anas-task.postman_collection.json`) into Postman.
3. Select the imported environment in Postman.
4. Update environment variables (e.g., `base_url`) as needed.
5. Test endpoints:
   - **Login** to retrieve a token.
   - **Use the token** (set in Authorization header as `Bearer {token}`) to access protected routes (e.g., managing products).

## Database Import

If you prefer to import the data directly:
- Import the provided `anas-task.sql` into your MySQL database (matching the credentials in your `.env` file). This should create the necessary tables and insert dummy data.

## Notes

- This project currently focuses on authentication (Breeze & Sanctum) and basic product management.
- The `.sql` file is provided for convenience. You can rely on Laravel’s migrations and seeders instead if you prefer.
- The Postman files demonstrate how to interact with the API endpoints, including login, viewing products, and creating products.

