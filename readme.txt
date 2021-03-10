


Usernames & Passwords
======================

Admin Profile
Username: mallorie
Password: password
Access Role: Admin

Profile
Username: blah
Password: password
Access Role: admin
(Doesn't have access to "Create New User")

# Project Installation

Access Demo on https://malloriecini.com/booksProject

# Business Rules

- The application will use Google maps API integration so that the user can see the directions to the event.
- Uses can choose to add the event to the device calendar and allow access to their contacts so they can send invitations to the event out via text, call them directly or email.
- When user is signing up can select some interested places for the app to recommend when they are nearby.
- See suggested events around the user’s current location in map view based on the user’s interested selected when registering.
- Events will have markers/icons that are colour coded.
- The application can pinpoint events that are near the user when they enter the app and click on “Explore Events” that also integrates with Facebook events giving the user multiple options
- It has a maximum radius of events where the user is situated.
- Users will be directed to the website of the event if they need to book tickets
- To get your event featured on Eventee you would have to pay a fee
- Receive in-app notifications about upcoming events. If you are an event organizer you can receive notifications when someone has registered at your event.

# Technology used in whole project

### Front End

- General use of HTML5, CSS3 and JavaScript was used throughout the project pages.

### Back End

- PHP Hypertext Preprocessor Version 7.3.12
- MySQL/SQL
- Server Software: Apache/2.4.41 (Win64) PHP/7.3.12
- WAMP Version 3.2.0 - 64bit

# CRUD Matrix

## Web Application

|                | CREATE | READ | UPDATE | DELETE | SESSION |
| -------------- | ------ | ---- | ------ | ------ | ------- |
| Create Events  | \*     |      |        |        |         |
| Explore Events |        | \*   |        |        |         |
| Join Event     | \*     | \*   | \*     |        |         |
| Edit Event     |        |      | \*     |        |         |
| Update Profile |        |      | \*     |        |         |
| Register       | \*     |      | \*     |        |         |
| Login          |        |      |        |        | \*      |
| Logout         |        |      |        |        | \*      |
| Log Event      | \*     |      | \*     |        | \*      |
