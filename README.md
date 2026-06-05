# PlanBot - Event Management System

PlanBot is a web platform that connects event organizers with participants. Users can sign up, log in, register for events, and give feedback. Admins can manage events and view statistics.

---

## Team Members - Planbot Crew

| Name          | Component                  |
| ------------- | -------------------------- |
| Shristi       | Event Management           |
| Ashraful      | Registration & Attendance  |
| Saurav        | Feedback & Statistics      |
| Deepika       | Admin Dashboard            |
| Subash Khatri | User Authentication        |

---

## What the System Does

- Users can create an account and log in
- Users can see and register for events
- Users can edit their profile and change password
- Users can reset their password if they forget it
- Admins can log in separately and manage events
- Admin can see registrations, attendance and feedback

---

## My Part - User Authentication

I worked on the user authentication part of the system. This includes:

- **Signup** - new users can create an account
- **Login** - users log in with email and password
- **Dashboard** - shows the events the user registered for
- **Edit Profile** - users can update their name, email and password
- **Forgot Password** - generates a reset link using a secure token
- **Reset Password** - users can set a new password using the link
- **Logout** - ends the session and redirects to login

I made sure the system is secure by using sessions, checking for duplicate emails, validating passwords and protecting pages so users cannot access them without logging in.

---

## Technologies

- PHP
- MySQL
- HTML and CSS
- XAMPP
- PHPUnit for testing
- GitHub for version control

---

## Database

Database name: `managing_events`

Tables used:
- users
- admins
- events
- registrations
- attendance
- feedback

---

## How to Run

1. Download or clone the project
2. Put the folder in `C:/xampp/htdocs/`
3. Open phpMyAdmin and create database `managing_events`
4. Import `managing_events.sql`
5. Start Apache and MySQL in XAMPP
6. Go to `http://localhost/event/event/`

---

## Testing

I used PHPUnit to test my code. I wrote 35 tests covering different data types:

- String tests - name, email, password fields
- Numeric tests - user ID
- Boolean tests - login success and failure
- Date tests - created date, token expiry
- 

**Result:**
```
OK (35 tests, 41 assertions)
```

All 35 tests passed successfully.

---

## Author

Subash Khatri - P2893769
Planbot Crew Team
Portfolio 2 - Agile Development
