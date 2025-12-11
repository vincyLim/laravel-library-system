# 📚 Simple Laravel Library Management System

A web-based library management system developed with the Laravel framework. This project was created as an academic assignment and serves as a comprehensive demonstration of full-stack Laravel development, focusing on robust data management and access control.

## ✨ Features

This system provides the following features:

* **Book Management:** Complete CRUD (Create, Read, Update, Delete) operations for book inventory with categorization.
* **Author Management:** Maintain profiles and relationship tracking for all book authors.
* **Category Management:** Flexible organization system allowing books to be grouped under multiple categories.
* **Borrow Records:** Detailed tracking of book borrowing activities, including history and current status.
* **Penalty System:** Automated and manual management of overdue penalties for borrowed books.
* **User Roles & Permissions:** Multi-level access control with predefined roles (Admin, Staff, and regular User).
* **Authentication:** Secure user login and registration powered by **Laravel Breeze**.

## 🛠️ Tech Stack

The project is built using the following core technologies and tools:

| Category | Technology | Purpose |
| :--- | :--- | :--- |
| **Backend** | **Laravel (PHP)** | The core MVC framework for application logic and API handling. |
| **Database** | **MySQL** | Data persistence layer
| **Frontend** | **Blade & Tailwind CSS & Bootstrap** | Templating engine for clean views, styled with a modern utility-first CSS framework. |
| **Tools** | **Composer & Artisan CLI** | PHP dependency management and Laravel's command-line interface for tasks like migration, seeding, and serving. |

## 🚀 Getting Started

Follow these steps to get your local development environment up and running.

### Prerequisites

* **PHP** (8.2+)
* **Composer**
* **Node.js & npm** (for frontend asset compilation)
* **MySQL** or another compatible SQL database

### Installation & Set Up
0.  **Requirement**
    Ensure you are using **PHP8.2** and have **Composer** installed.

1.  **Clone the Repository:**
    Navigate to your desired directory and clone the project:
    ```bash
    git clone [Your Repository URL Here]
    cd laravel-library-system
    ```

2.  **Install PHP Dependencies:**
    Install all required backend packages using Composer:
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies & Compile Assets:**
    Install Node dependencies and compile the frontend assets:
    ```bash
    npm install
    # Run the compilation command:
    npm run dev
    ```

4.  **Setup Environment File:**
    Duplicate the example file and generate your application key:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Configure Database:**
    Open the `.env` file and set the credentials for your database connection:
    * `DB_CONNECTION=mysql`
    * `DB_HOST=127.0.0.1`
    * `DB_DATABASE=`
    * `DB_USERNAME=`
    * `DB_PASSWORD=`

6.  **Run Migrations and Seeder:**
    * **⚠️ Important:** Ensure your **MySQL database server is running** before executing this command.
    
    Apply the database schema and populate it with initial data:
    ```bash
    php artisan migrate --seed
    ```

7.  **Create Storage Link:**
    This command ensures that user-uploaded files (like book covers) stored in `storage/app/public` are correctly linked and accessible via the public web directory:
    ```bash
    php artisan storage:link
    ```

8.  **Start the Development Server:**
    Start the local server to access the application in your browser:
    ```bash
    php artisan serve
    ```
    The application will be accessible at `http://127.0.0.1:8000`.

## 🔒 User Credentials (After Seeding)

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@email.com` | `password` |
| **Librarian** | `librarian@email.com` | `password` |
| **Student** | `student@email.com` | `password` |

*(Note: These credentials are used only for the seeded development database.)*

## ✍️ Contribution

This project was developed as a collaborative academic effort by my team members:

* **Liau Wei Sheng** – *Team Lead*
* **Vincy Lim Wei Jun** (me)
* **Eng Zi Jun**
* **Liew Ke Ying** 

## 📄 License

This project is licensed under the MIT License.
