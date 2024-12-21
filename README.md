# anas-task

**anas-task** is a Laravel-based application that demonstrates:

1. **Authentication & Authorization** using Laravel Breeze and Sanctum  
2. **Product Management** (CRUD operations)  
3. **Unit & Feature Testing** for product creation and authentication  
4. **Stripe Payment Integration** (test mode)  

---

## Features

- **User Authentication & Authorization**  
  - Uses [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze) for basic login/registration scaffolding.  
  - Uses [Laravel Sanctum](https://laravel.com/docs/sanctum) for issuing and revoking API tokens.

- **Products**  
  - A `Product` model with create, read, update, delete functionality.  
  - Routes protected by admin middleware (for admin-specific actions).

- **Stripe Payment Integration**  
  - Integrated [Stripe](https://stripe.com) for handling payments.  
  - When a user clicks **Checkout**, they are redirected to a secure payment form.  
  - Test card `4242 4242 4242 4242` can be used in test mode, with any future expiration date and 3-digit CVC.

- **Unit & Feature Tests**  
  - Unit tests for creating a new product (store method).  
  - Feature tests for testing user login (both valid and invalid credentials).  
  - Utilizes a separate test database to keep production data intact.

---

## Prerequisites

- **PHP >= 8.x**  
- **Composer**  
- **Node.js & npm** (for front-end assets if using Laravel Mix or Vite)  
- A **database** (MySQL, PostgreSQL, etc.)  
- **Stripe account** (test mode is sufficient)

---

## Installation

1. **Clone the Repository**  
   ```bash
   git clone https://github.com/yourusername/anas-task.git
   cd anas-task
   ```

2. **Install Dependencies**  
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Configure Environment**  
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Set your database credentials in `.env`:
     ```env
     DB_DATABASE=anas_task
     DB_USERNAME=root
     DB_PASSWORD=secret
     ```
   - Add your **Stripe keys**:
     ```env
     STRIPE_KEY=pk_test_XXXXXXXXXXXXXXXX
     STRIPE_SECRET=sk_test_XXXXXXXXXXXXXXXX
     ```
   - (Optional) Add a **webhook secret** if you’re testing Stripe webhooks:
     ```env
     STRIPE_WEBHOOK_SECRET=whsec_XXXXXXXXXXXXXXXX
     ```
     
4. **Generate App Key & Migrate**  
   ```bash
   php artisan key:generate
   php artisan migrate
   php artisan db:seed --class=ProductSeeder
   ```

5. **Serve the Application**  
   ```bash
   php artisan serve
   ```
   Access the app at [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## Usage

1. **Registration & Login**  
   - Go to `/register` to create a new account.  
   - Then login at `/login`.  
   - By default, users have a role of `user`. If you need an `admin` role, update the `role` field in the database.

2. **Product Management**  
   - An **admin** can view, create, or edit products in the admin panel.  
   - A regular user can only view products (depending on your role-based middleware setup).

3. **Checkout & Payment (Stripe)**  
   - When a user clicks **Checkout** (e.g., after selecting products), they’re redirected to a **payment form** powered by Stripe Elements.  
   - Use the **test card `4242 4242 4242 4242`** with any valid future date and a 3-digit CVC (e.g., 123).  
   - After a successful test payment, you’ll be shown a confirmation page, and payment details are saved in the DB.

---

## Testing

### 1. Configure a Test Database

- In your `.env.testing` file, specify a separate database for tests:
  ```env
  DB_CONNECTION=mysql
  DB_DATABASE=anas_task_test
  DB_USERNAME=root
  DB_PASSWORD=secret
  ```

### 2. Run Tests

To run **all** tests (unit and feature), simply execute:

```bash
php artisan test
```

#### **Unit Tests**

- **Product Creation Test**: Verifies the `store` method adds a product correctly to the test database.

#### **Feature Tests**

- **Authentication Tests**:
  - **Successful Login**: Checks that a user with valid credentials is authenticated and redirected properly.
  - **Unsuccessful Login**: Ensures a user with invalid credentials receives an error and remains unauthenticated.

Laravel will automatically use `.env.testing` for these tests, so your main database remains untouched.

---

## Stripe Webhooks (Optional)

To test webhook events (like `payment_intent.succeeded`), you can use the [Stripe CLI](https://stripe.com/docs/stripe-cli):

1. **Install & Login**:  
   ```bash
   stripe login
   ```
2. **Listen for Events**:  
   ```bash
   stripe listen --forward-to http://127.0.0.1:8000/stripe/webhook
   ```
3. **Trigger Test Events**:  
   ```bash
   stripe trigger payment_intent.succeeded
   ```
   The app will handle the event and update the DB accordingly (e.g., marking orders as paid).

---

## Additional Notes

- **Security**:  
  - Store sensitive keys like `STRIPE_SECRET` in `.env`, not in version control.  
  - Use **HTTPS** in production for secure Stripe transactions.  

- **Deployment**:  
  - Use a **production** environment with caching, queue workers (for webhooks), and SSL.  
  - Make sure to run `php artisan migrate --force` in production and set up your environment variables properly.

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

**Enjoy building your Laravel + Stripe application!** For further questions, consult the [Laravel documentation](https://laravel.com/docs), [Stripe documentation](https://stripe.com/docs), or open an issue in the repository.