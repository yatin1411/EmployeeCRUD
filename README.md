# Employee Management System
## What This Application Does

- **Create Accounts** — New users can register and create an account
- **Login Securely** — Users login with their email and password
- **Manage Employees** — Add new employees, view all employees, edit their info, or delete records
- **Search Employees** — Quickly find an employee by their name or email
- **API Access** — Advanced users can access employee data programmatically (for other applications)

## What You Need Before Starting

Make sure your computer has:
- **PHP 7.4 or newer** (a programming language)
- **MySQL 5.7 or newer** (a database to store employee information)
- **XAMPP or WAMP** (a package that includes both PHP and MySQL)

## How to Get It Running (Step-by-Step)

### Step 1: Create the Database
The database is where all employee information gets stored. Run this command in your terminal or command prompt:

```powershell
mysql -u root < sql/schema.sql
```

This creates two tables:
- **users table** — stores login information (email and password)
- **employees table** — stores employee names, emails, positions, and salaries

### Step 2: Set Up Database Connection
The application needs to know where to find the database. Open the file `app/core/config.php` and check these settings:

```php
define('DB_HOST', 'localhost');    // Where the database is located
define('DB_USER', 'root');         // Username to access the database
define('DB_PASS', '');             // Password for the database (empty by default in XAMPP)
define('DB_NAME', 'employee_db');  // Name of your database
```

Usually these default settings work fine for beginners using XAMPP locally.

### Step 3: Open the Application in Your Browser
Once everything is set up, open your web browser and visit:

```
http://localhost/EmployeeCrud/public/index.php
```

You should see the home page!

## Using the Application

Once you've opened the application, here's what you can do:

### First Time? Create an Account
- Go to **Register** page: `http://localhost/EmployeeCrud/public/index.php?url=auth/register`
- Enter an email and password
- Click "Register"
- Now you have an account!

### Login to Your Account
- Go to **Login** page: `http://localhost/EmployeeCrud/public/index.php?url=auth/login`
- Enter your email and password
- Click "Login"
- You'll see the employee management dashboard

### Manage Employee Records
- **View All Employees** — See a list of all employees
- **Add New Employee** — Click "Add Employee" and fill in the form (name, email, position, salary)
- **Edit Employee** — Click the edit button next to an employee to change their info
- **Delete Employee** — Click delete to remove an employee record
- **Search** — Use the search box to find an employee by name or email

## Security (How Your Data Stays Safe)

This application has several built-in safety features to protect employee information:

### Passwords Are Encrypted
- When you enter your password, it doesn't get stored directly in the database
- Instead, the password is "hashed" (converted to a special code) using bcrypt
- Even if someone gets the database, they can't read the actual passwords

### Sessions Keep You Logged In
- When you login, the system creates a session (like a digital ID card)
- Your session ID is stored in a secure cookie (a small file in your browser)
- This cookie expires automatically for security
- Your session can't be stolen or used by hackers

### Forms Are Protected
- All forms (especially login) are protected from CSRF attacks (a type of hack)
- Each form has a hidden token (a random code) that prevents unauthorized requests
- If someone tries to hack your form, the token won't match and the request fails

### Database Queries Are Safe
- The application uses "prepared statements" when talking to the database
- This prevents SQL injection attacks (when hackers try to trick the database)
- Think of it like a bouncer checking IDs — only safe requests get through

### Protection Against Common Attacks
- Input sanitization — Data is checked before being stored (removing dangerous code)
- Output escaping — Data is safely displayed (so code can't run in your browser)
- Security headers — Special instructions sent to your browser to protect against attacks

## Understanding the Application Structure

The application is organized in a way that makes it easy to understand and modify:

```
app/
├── controllers/    # These handle what happens when you click buttons
│                   # Example: When you click "Add Employee", a controller processes it
│
├── core/          # The core engine of the application
│                  # These handle database connections, routing, and helpers
│
├── models/        # These talk to the database
│                  # UserModel: handles user login/registration
│                  # EmployeeModel: handles employee data
│
└── views/         # These are the HTML pages you see
                   # login.view.php, register.view.php, employee list, etc.

public/
└── index.php      # The main file that runs the application
                   # Everything goes through this file

sql/
└── schema.sql     # The instructions to create your database
```

**What Happens When You Click Something:**
1. You click a link or button
2. It goes to `public/index.php`
3. The router finds the right controller
4. The controller gets the data using a model
5. The view displays the information to you

## Customization & Settings

### Development Mode (For Learning)
While you're learning and developing, you can enable detailed error messages. Open `app/core/config.php` and change:

```php
define('APP_HAS_ERRORS', true);
```

This will show you detailed error messages if something goes wrong. **Important:** Always set this to `false` when you release the application to other people, so errors don't give away sensitive information.

### When You're Ready to Share Your App (Production)

Before sharing your application with others, you should:

1. **Hide Your Database Credentials**
   - Don't put passwords directly in the config file
   - Use environment variables instead (advanced topic for later)

2. **Turn Off Error Messages**
   - Change `APP_HAS_ERRORS` to `false`
   - This hides technical details from users

3. **Use HTTPS**
   - If hosting online, get an SSL certificate
   - This encrypts data sent between users' browsers and your server
   - Look for "Let's Encrypt" for free certificates

4. **Strong Database Password**
   - Change the default empty password to a strong one
   - Mix uppercase, lowercase, numbers, and symbols
   - Make it at least 16 characters long

5. **Regular Backups**
   - Regularly backup your database
   - If something goes wrong, you can restore your data

6. **File Permissions**
   - Make sure only authorized people can access your files
   - Files should have permission `644`
   - Folders should have permission `755`

## Common Problems & How to Fix Them

### Problem: "Could not connect to database"
**What this means:** The application can't find or access the database.

**How to fix it:**
1. Make sure MySQL is running
   - On Windows, open Services (search "Services" in Start menu)
   - Look for "MySQL" and make sure it says "Running"

2. Check your database credentials in `app/core/config.php`
   - `DB_HOST` should be `localhost` (on your computer)
   - `DB_USER` should be `root` (default in XAMPP)
   - `DB_PASS` is usually empty for local development
   - `DB_NAME` should be `employee_db`

3. Verify the database exists
   - Open command prompt and type: `mysql -u root`
   - Then type: `SHOW DATABASES;`
   - Look for `employee_db` in the list
   - If it's not there, run: `mysql -u root < sql/schema.sql`

### Problem: "404 - Page Not Found"
**What this means:** The application can't find the page you requested.

**How to fix it:**
1. Check the URL is correct
   - Should be: `http://localhost/EmployeeCrud/public/index.php`
   - Check for spelling mistakes

2. Make sure you're using the right URL parameter
   - To view employees: `http://localhost/EmployeeCrud/public/index.php?url=employees`
   - To login: `http://localhost/EmployeeCrud/public/index.php?url=auth/login`
   - To register: `http://localhost/EmployeeCrud/public/index.php?url=auth/register`

### Problem: "You're not logged in" or authentication not working
**What this means:** The system isn't recognizing your login.

**How to fix it:**
1. Clear your browser cookies and cache
   - Press `Ctrl + Shift + Delete` (Windows) or `Cmd + Shift + Delete` (Mac)
   - This removes old session data that might be corrupted

2. Make sure you registered first
   - You can't login unless you have an account
   - Go to the register page and create one

3. Verify cookies are enabled in your browser
   - Some browsers block cookies by default
   - Check your browser settings and allow cookies

### Problem: "Permission denied" error
**What this means:** The web server doesn't have permission to access the files.

**How to fix it:**
1. Make sure the EmployeeCrud folder is accessible
   - Right-click the folder → Properties → Security
   - Make sure "SYSTEM" user has read/write permissions

2. For XAMPP users:
   - The `htdocs` folder should have read permission for everyone
   - If you moved the folder, move it back to `C:\xampp\htdocs`

## API Testing (Advanced - Skip if You Just Started)

**What is an API?** An API is a way for other applications to talk to your application and get data. Instead of a human clicking buttons in the browser, another program sends a request directly.

**When would you need this?** If you want to connect your employee system to another app (like a mobile app, spreadsheet tool, or accounting software).

### Testing with Postman (Recommended)
Postman is an easy tool for testing APIs:

1. Download and install [Postman](https://www.postman.com/downloads/)
2. Open Postman
3. Click "Import" and select the `Postman_Collection.json` file in your project
4. This loads all available API commands
5. Click on an API request and click "Send"

### Testing with curl (Command Line)
If you prefer the command line, you can use curl:

```bash
# Step 1: Login to create a session
curl -c cookies.txt -d "email=test@example.com&password=testpass" \
  http://localhost/EmployeeCrud/public/index.php?url=auth/login

# Step 2: Add a new employee (using the session from step 1)
curl -b cookies.txt -X POST \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","position":"Manager","salary":50000}' \
  http://localhost/EmployeeCrud/public/index.php?url=api/addEmployee
```

**What's happening here?**
- `-c cookies.txt` — Save the login session
- `-b cookies.txt` — Use the saved session for the next request
- `-X POST` — Send data to the server
- `-d` — The data to send (employee information)

## Important Files Explained

If you want to understand the application better, here are the key files to look at:

### Files You Might Want to Modify

- **`app/core/config.php`** — Database settings and basic configuration
  - This is where you change the database name, username, and password
  - This is also where you turn error messages on/off

- **`app/views/layout.html`** — The main page template
  - Controls how the page looks
  - Includes the navigation menu
  - Good place to change colors, fonts, or add your company logo

- **`app/views/employees/index.view.php`** — The employee list page
  - Shows all employees in a table
  - Change this to add more information or remove columns

### Files That Handle Logic

- **`app/controllers/Auth.php`** — Handles login and registration
  - When you click login/register, this file processes it

- **`app/controllers/Employees.php`** — Handles employee operations
  - When you add/edit/delete an employee, this file handles it

- **`app/models/UserModel.php`** — The user database manager
  - Talks to the database to save and read user accounts
  - Handles password hashing

- **`app/models/EmployeeModel.php`** — The employee database manager
  - Talks to the database to save and read employee records
  - Handles searching for employees

### Files You Usually Don't Need to Change

- **`app/core/App.php`** — The main router (directs requests to the right controller)
- **`app/core/Database.php`** — Connects to the database
- **`app/core/functions.php`** — Helper functions (CSRF protection, sanitization)

## Learning Path

**Day 1: Get it working**
- Follow the installation steps
- Create a test user account
- Add a few test employees

**Day 2: Understand the flow**
- Open `app/controllers/Employees.php` and read through the code
- Open `app/models/EmployeeModel.php` and see how database queries work
- Try making a small change to `app/views/employees/index.view.php` (like changing a column name)

**Day 3: Make small customizations**
- Change the colors in `app/views/layout.html`
- Add a new field to the employee form
- Modify the search functionality

**Day 4: Deploy (share with others)**
- Follow the "Customization & Settings" section
- Set up HTTPS if hosting online
- Create regular backups
