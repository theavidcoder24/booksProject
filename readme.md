# Books Project
(Insert Breif Description)

## Usernames & Passwords

#### Admin Profile

Username: mallorie
Password: password
Access Role: Admin

#### Normal User Profile

Username: blah
Password: password
Access Role: admin
(Doesn't have access to "Create New User")

# Project Installation

Access Demo on https://malloriecini.com/booksProject

In your database software create a new blank database then name it 'booksProject' and import the SQL file located in the "sql" folder

Install the client and api folders into a web server like MAMP or WAMP. The folders need to be installed into the www folder if you're using Wamp for example. Update the database connection settings found within the db.php file with the username and password needed to access the database.

# Business Rules

- The application will use Google maps API integration so that the user can see the directions to the event

# Technology used in whole project

### Front End

- General use of HTML5, CSS3 and JavaScript was used throughout the project pages

### Back End

- PHP Hypertext Preprocessor Version 7.3.12
- MySQL/SQL
- Server Software: Apache/2.4.41 (Win64) PHP/7.3.12
- WAMP Version 3.2.0 - 64bit

# CRUD Matrix

## Web Application

|               | CREATE | READ | UPDATE | DELETE | SESSION |
| ------------- | ------ | ---- | ------ | ------ | ------- |
| Create Book   | \*     |      |        |        |         |
| Display Books |        | \*   |        |        |         |
| Delete Book   |        |      | \*     | \*     |         |
| Edit Book     |        |      | \*     |        |         |
| Register      | \*     |      | \*     |        |         |
| Login         |        |      |        |        | \*      |
| Logout        |        |      |        |        | \*      |
| Changelog     | \*     |      | \*     |        | \*      |
