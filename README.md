# User Registration System

A simple user registration and authentication system built using PHP, based on the MVC architecture.

## Project Overview:

### Features:

1. User Registration
2. User Login
3. View Profile
4. Enhanced security with password hashing
5. User roles and permissions (advanced)
6. Image upload for profiles (advanced)
7. Daily subscription checks (advanced)

## Project Structure:

1. `index.php`: Main entry point with options for registration, login, and profile viewing.
2. `register.php`: Handles user registration.
3. `login.php`: Manages user login.
4. `profile.php`: Displays user profile after successful login.
5. `db.php`: Manages database connections and CRUD operations.
6. `UserController.php`: A controller that contains the logic related to user operations.

## Getting Started:

### Prerequisites:

- PHP (version 7.4 or newer recommended)
- MySQL (or a similar database system)

### Setting Up:

1. Clone this repository:
   ```bash
        git clone https://github.com/your-username/user-registration-system.git
    ```
2. Navigate to the project's root directory:
    ```bash
    cd user-registration-system
    ```
3. Set up your database and update the database configuration in `db.php`.
4. Run the project using PHP's built-in server:
    ```bash
    php -S localhost:8000
    ```
5. Visit `http://localhost:8000/index.php` in your browser.

### Testing:
1. Register a new user using the "Register" link on the main page.
2. Log in using the "Login" link with the credentials you provided during registration.
3. View your profile using the "Profile" link after logging in.


### Advanced Features:
1. Password Hashing: Passwords are hashed using PHP's password_hash and verified using password_verify.
2. User Roles: The system can be extended to have user roles like "admin" and "user".
3. Image Upload: Users can upload and set an avatar for their profile.
4. Subscription Check: Daily checks for subscription status, restricting features if a subscription has expired.

