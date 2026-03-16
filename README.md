Employee Management System (EMS)

The Employee Management System (EMS) is a web-based application developed using PHP and MySQL to efficiently manage employee information within an organization.
It provides administrators with an intuitive interface to manage departments, designations, employees, and view/delete employee records.

Features

Secure administrator login/logout

Department management (add/view)

Designation management (add/view)

Employee management (add/view/delete)

Full CRUD operations for main entities

Relational database design using MySQL

Technologies Used

Backend: PHP

Database: MySQL

Frontend: HTML, CSS (basic styling)

SQL: Structured queries for CRUD operations

Database Tables

The system uses the following tables:

Users – administrator login credentials

Departments – department information

Designations – job titles linked to departments

Employees – employee records

Optional tables like Salaries, Attendance, and Leaves can be added in future versions.

Project Structure
employee-management-system/
│
├── project.php           # Main PHP file containing all functionality
├── database.sql          # SQL file to create tables and seed data
├── README.md             # Project documentation
└── screenshots/          # Optional: screenshots of the application
Installation

Clone the repository

git clone https://github.com/yourusername/employee-management-system.git
cd employee-management-system

Setup Database

Open phpMyAdmin or MySQL CLI

Create a new database:

CREATE DATABASE ems_database;

Import database.sql into your new database

Configure Project

Open project.php and update the database connection if needed:

$conn = mysqli_connect("localhost", "root", "", "ems_database");

Run the Project

Place the project folder inside your server root (xampp/htdocs or equivalent)

Start Apache and MySQL

Open in browser:

http://localhost/employee-management-system/project.php
Future Improvements

Role-based access control (Admin, HR, Employee)

Password hashing for secure login

Payslip generation and salary management

Attendance tracking and leave management

Advanced reporting and charts

Author

Hassan Ali (23-cys-035)
Cybersecurity Student
HITEC University Taxila
