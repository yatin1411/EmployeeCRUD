# Employee Management System

A secure PHP web application for managing employee records with user authentication, CRUD operations, and search functionality, built using a custom **MVC (Model-View-Controller) framework**.

## What It Is

A complete employee management system demonstrating professional web development practices:
- **Authentication** with BCRYPT password hashing
- **CRUD Operations** (Create, Read, Update, Delete) for employees
- **Advanced Search** with database queries
- **Security** (SQL injection protection, XSS prevention, CSRF tokens)
- **Responsive UI** with Bootstrap 5
- **Clean MVC Architecture**

### MVC Pattern (Model-View-Controller)

This project follows the **MVC architectural pattern**:

```
┌─────────────────────────────────────────┐
│         USER (Browser)                  │
│      Enters URL, Clicks Buttons         │
└────────────────────┬────────────────────┘
                     │
                     ↓
        ┌────────────────────────┐
        │   ROUTER (App.php)     │
        │  Analyzes URL Pattern  │
        │  Decides which         │
        │  Controller to load    │
        └────────────┬───────────┘
                     │
                     ↓
    ┌────────────────────────────────────┐
    │      CONTROLLER                    │
    │   (Auth.php, Employees.php, etc.)  │
    │                                    │
    │  - Receives user input            │
    │  - Validates data                 │
    │  - Calls Model methods            │
    │  - Passes data to View            │
    └────────────┬───────────────────────┘
                 │
    ┌────────────┴───────────────────────┐
    │                                    │
    ↓                                    ↓
┌──────────────┐                   ┌──────────────┐
│    MODEL     │                   │     VIEW     │
│              │                   │              │
│ Database     │                   │  HTML Pages  │
│ Operations   │                   │  Templates   │
│              │                   │              │
│ - Fetch data │                   │ - Display    │
│ - Insert     │                   │   data       │
│ - Update     │                   │ - Forms      │
│ - Delete     │                   │ - Tables     │
└──────┬───────┘                   └──────┬───────┘
       │                                  │
       ↓                                  ↓
   ┌──────────────┐              ┌──────────────┐
   │   DATABASE   │              │   BROWSER    │
   │  (MySQL)     │              │  (Display)   │
   └──────────────┘              └──────────────┘
```

## Technology Stack

| Layer | Tech |
|-------|------|
| Frontend | PHP 7.0+, HTML5, Bootstrap 5.1.3 |
| Backend | PHP 7.0+, Custom MVC Framework |
| Database | MySQL 5.7+ |

## File Structure Explained

```
EmployeeCRUD/
│
├── public/
│   ├── index.php              ← Entry point (first file loaded)
│   ├── css/
│   │   └── style.css          ← All CSS styling
│   └── (images would go here)
│
├── app/
│   │
│   ├── controllers/           ← Handle logic and requests
│   │   ├── Auth.php           ← Login, register, logout
│   │   ├── Employees.php      ← Employee operations
│   │   ├── Home.php           ← Home page
│   │   ├── Api.php            ← API endpoints
│   │   └── _404.php           ← Error pages
│   │
│   ├── models/                ← Database interaction
│   │   ├── EmployeeModel.php  ← Employee queries
│   │   └── UserModel.php      ← User queries
│   │
│   ├── views/                 ← HTML templates
│   │   ├── layout.html        ← Main wrapper template
│   │   ├── home.view.php      ← Home page HTML
│   │   ├── _404.view.php      ← Error page
│   │   ├── auth/
│   │   │   ├── login.view.php
│   │   │   └── register.view.php
│   │   └── employees/
│   │       ├── index.view.php
│   │       ├── add.view.php
│   │       ├── edit.view.php
│   │       └── search.view.php
│   │
│   └── core/                  ← Framework core
│       ├── App.php            ← Router
│       ├── Controller.php     ← Base controller
│       ├── Model.php          ← Base model
│       ├── Database.php       ← Database connection
│       ├── functions.php      ← Helper functions
│       ├── config.php         ← Settings
│       └── init.php           ← Initialization
│
├── sql/
│   └── schema.sql             ← Database setup script
│
├── README.md                  ← Instructions
├── Postman_Collection.json    ← API testing file
└── PROJECT_SUMMARY.md         ← This file
```

## Database Tables

**Users:** id, email, password (hashed), created_at, updated_at

**Employees:** id, name, email, position, salary, created_at, updated_at

## How It Works - Example

**Adding an Employee:**
1. User clicks "Add Employee"
2. `Employees` controller renders `add.view.php` (form)
3. User submits form
4. Controller validates POST data
5. `EmployeeModel` inserts into database
6. Redirect to employee list with success message

## Key Design Patterns

- **MVC Separation** - Code organized by responsibility
- **Base Classes** - `Controller` & `Model` provide shared functionality
- **PDO Database Layer** - Consistent, safe database interface
- **Helper Functions** - Reusable utilities for CSRF, sanitization, sessions

## Security Features

✓ Password hashing with BCRYPT  
✓ Prepared statements (prevents SQL injection)  
✓ HTML escaping (prevents XSS)  
✓ CSRF tokens on all forms  
✓ Input validation & sanitization  
✓ HTTPOnly, Secure, SameSite cookies  

## Summary

Professional-grade CRUD application demonstrating secure MVC architecture, best-practice security implementation, and clean code organization. Works as both a working application and learning resource.
