# Basic HRM System

A simple Human Resource Management (HRM) system built with Laravel. This application allows you to manage departments, skills, and employees in your organization.

## Features

- **Department Management**: Create, view, and delete departments
- **Skill Management**: Create, view, and delete skills
- **Employee Management**: Manage employee information and their associated skills
- **User Authentication**: Secure login and registration system
- **Dashboard**: Overview of your HRM data

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js and npm (for frontend assets)
- MySQL or another supported database

## Installation

1. **Clone the repository** (if applicable) or ensure you have the project files in your web directory.

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**:
   ```bash
   npm install
   ```

4. **Environment Configuration**:
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials and other settings.

5. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

6. **Run Database Migrations**:
   ```bash
   php artisan migrate
   ```

7. **Seed the Database** (optional, for sample data):
   ```bash
   php artisan db:seed
   ```

8. **Build Frontend Assets**:
   ```bash
   npm run build
   ```

## Running the Application

### Using Laravel's Built-in Server
```bash
php artisan serve
```
The application will be available at `http://localhost:8000`

### Using Laragon (Recommended for Windows)
If you're using Laragon, simply start your Apache and MySQL services, and access the application through your configured domain (e.g., `http://basic_hrm.test`).

## Usage

1. **Register/Login**: Create an account or log in to access the system.
2. **Dashboard**: View an overview of departments, skills, and employees.
3. **Manage Departments**: Add, view, and delete departments.
4. **Manage Skills**: Add, view, and delete skills.
5. **Manage Employees**: Create employee profiles and assign skills.

## Database Structure

- **Users**: Authentication and user management
- **Departments**: Organizational departments
- **Skills**: Employee skills/competencies
- **Employees**: Employee information
- **Employee Skills**: Many-to-many relationship between employees and skills

## Technologies Used

- **Laravel**: PHP framework for backend
- **Tailwind CSS**: Utility-first CSS framework for styling
- **Blade Templates**: Laravel's templating engine
- **MySQL**: Database management system

## Contributing

Feel free to fork this project and submit pull requests for improvements.

