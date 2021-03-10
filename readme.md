# Books Project

Admin section of a website that presents the most popular books of all time. The criterion used to select the books is to identify the books that have had more copies sold over the years.

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

- The admin part of the website must include pages whose purpose is to be able to access the login/authentication pages
- Implementation of password hashing and encryption
- The presentation of all the books will be on a page that displays all the books already existing within the database
- When adding books to the database a form page must be created for simple insert procedure of new books.
- Must be able to update/edit existing books on the database on the browser that includes the “created date” on display books and “last updated date”
- The user that updates the book must be tracked.
- Ability to delete books in the database from the admin section
- Creation of new users only by the user that has access rights as an Admin, normal users cannot register so new accounts will be created for them.

# Technology used in whole project

### Front End

- General use of HTML5, CSS3 and JavaScript was used throughout the project pages

### Back End

- PHP Hypertext Preprocessor Version 7.3.12
- MySQL/SQL
- Server Software: Apache/2.4.41 (Win64) PHP/7.3.12
- WAMP Version 3.2.0 - 64bit

# CRUD Matrix

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
