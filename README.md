Employee Management System (EMS)

Employee Management System (EMS) is a lightweight web-based application built with PHP and MySQL to manage employee information in an organization.
It allows administrators to efficiently handle departments, designations, and employee records through a clean and user-friendly interface.

Features

Secure administrator login and logout

Department management (add/view)

Designation management (add/view)

Employee management (add/view/delete)

Full CRUD operations for main entities

Relational database design for data integrity

Technologies

Backend: PHP

Database: MySQL

Frontend: HTML, CSS (minimal styling)

SQL: CRUD queries for database operations

Database Structure

The application uses the following tables:

Table	Description
Users	Stores administrator login credentials
Departments	Stores department information
Designations	Stores job titles linked to departments
Employees	Stores employee records

Additional features like salaries, attendance, and leaves can be integrated in future versions.

Project Structure
employee-management-system/
│
├── project.php       # Main PHP file containing all functionality
├── database.sql      # SQL file to create tables and seed data
└── README.md         # Project documentation
Installation

Clone the repository

git clone https://github.com/yourusername/employee-management-system.git
cd employee-management-system

Set up the database

Open phpMyAdmin or MySQL CLI

Create a new database:

CREATE DATABASE ems_database;

Import database.sql into the newly created database

Configure project

Open project.php and ensure the database connection is correct:

$conn = mysqli_connect("localhost", "root", "", "ems_database");

Run the project

Place the project folder in your server root (xampp/htdocs or equivalent)

Start Apache and MySQL

Access the application via:

http://localhost/employee-management-system/project.php
Future Enhancements

Role-based access control (Admin, HR, Employee)

Password hashing for secure login

Employee attendance and leave management

Salary management and payslip generation

Analytical dashboard and reports

Author

Hassan Ali
Cybersecurity Student 
HITEC University Taxila
