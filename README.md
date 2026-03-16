
# 📊 Employee Management System (EMS)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)

A lightweight, web-based solution for managing organizational hierarchies and personnel records, built with **PHP** and **MySQL**.

---

## 🚀 Features

* **Secure Authentication:** Administrator login and session management.
* **Department Management:** Create and organize company departments.
* **Designation Tracking:** Manage job titles linked to specific departments.
* **Full CRUD:** Create, Read, Update, and Delete capabilities for employee records.

---

## 🛠️ Technologies Used

* **Backend:** PHP (Procedural)
* **Database:** MySQL
* **Frontend:** HTML5, CSS3
* **Server:** Apache (XAMPP / WAMP)

---

## 📊 Database Structure

| Table | Description |
| :--- | :--- |
| `Users` | Administrator credentials and authentication data |
| `Departments` | Organizational units (e.g., IT, HR, Sales) |
| `Designations` | Job titles mapped to specific departments |
| `Employees` | Core employee data and profile records |
---
## ⚙️ Installation & Setup
1. Environment Setup
Clone the repository to your local server root (e.g., htdocs or www):

2. Database Configuration
Create a new database named ems_database.

Import the database.sql file provided in this repository.

3. Connection Settings
Open project.php and verify the connection string:

## 🛡️ Future Enhancements
Security: Implement password_hash() for user credentials.

SQL Injection: Transition to Prepared Statements.

UI/UX: Integration of Bootstrap 5 for a responsive dashboard.

## 👤 Author
Hassan Ali (23-cys-035)

Cybersecurity Student

HITEC University Taxila
