Employee Management System (EMS)

Employee Management System (EMS) is a lightweight web-based application built using PHP and MySQL.
It allows administrators to efficiently manage departments, designations, and employee records through a simple and user-friendly interface.

Features

Secure administrator login and logout

Department management (add/view)

Designation management (add/view)

Employee management (add/view/delete)

Full CRUD operations for main entities

Relational database design for data integrity

Technologies Used

Backend: PHP

Database: MySQL

Frontend: HTML, CSS (basic styling)

SQL: Structured queries for CRUD operations

Database Structure

The application uses the following tables:

Table	Description
Users	Stores administrator login credentials
Departments	Stores department information
Designations	Stores job titles linked to departments
Employees	Stores employee records

Additional modules such as salaries, attendance, and leaves can be integrated in future versions.

Project Structure
employee-management-system/
│
├── project.php       # Main PHP file containing all functionality
├── database.sql      # SQL file to create tables and initial data
└── README.md         # Project documentation
Installation

Clone the repository

git clone https://github.com/yourusername/employee-management-system.git
cd employee-management-system

Setup the database

Open phpMyAdmin or MySQL CLI

Create a new database:

CREATE DATABASE ems_database;

Import the database.sql file into your database

Configure the project

Open project.php and update the database connection if needed:

$conn = mysqli_connect("localhost", "root", "", "ems_database");

Run the application

Place the project folder in your server root (xampp/htdocs or equivalent)

Start Apache and MySQL

Open your browser and navigate to:

http://localhost/employee-management-system/project.php
Future Enhancements

Role-based access control (Admin, HR, Employee)

Password hashing for secure login

Employee attendance and leave management

Salary management and payslip generation

Analytics dashboard and reporting

Author

Hassan Ali
Cybersecurity Student
HITEC University Taxila
