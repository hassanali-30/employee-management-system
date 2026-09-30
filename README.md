# Employee Management System

A PHP and MySQL web application for managing organizational departments, designations, employees, and administrator access.

## Features

- Administrator login and session flow
- Department management
- Designation management linked to departments
- Employee record creation, viewing, updating, and deletion
- HTML and CSS interface

## Technology Stack

- PHP
- MySQL
- HTML5 and CSS3
- Apache through XAMPP or WAMP

## Database Areas

| Table | Purpose |
| --- | --- |
| `Users` | Administrator accounts and authentication data |
| `Departments` | Organizational departments |
| `Designations` | Job titles associated with departments |
| `Employees` | Employee records |

## Installation

1. Install PHP, MySQL, and Apache through XAMPP, WAMP, or an equivalent local stack.
2. Clone or copy the repository into the server document root, such as `htdocs`.
3. Import `database.sql`; it creates the `ems_db` database and tables.
4. The demo login is `admin` / `password`; change it before real use.
5. Start Apache and MySQL, then open the project through the local server.

## Security Considerations

Before production use, review and strengthen:

- Password storage with `password_hash()` and `password_verify()`
- Prepared statements for database queries
- Input validation and output encoding
- Session and authorization controls
- Configuration and database-credential handling

## Project Structure

```text
project.php     # Main PHP application
database.sql    # Database schema and seed data, if present
README.md       # Project documentation
Report.pdf      # Project report, if present
LICENSE         # License information
```