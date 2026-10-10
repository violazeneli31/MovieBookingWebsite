# Movie Booking – Online Cinema Ticket Booking Website

A web application for booking cinema tickets online. Users can browse running and upcoming movies, watch trailers, choose their seats, pay and view their tickets. Admins manage movies, users, customers, tickets and feedback from an admin panel.

Built with PHP and MySQL, using HTML, CSS, Bootstrap and JavaScript (jQuery), and run locally with XAMPP. Made as a personal project for the Web Technologies & Programming course (2025), starting from the open-source project [gosaliajainam/online-movie-booking](https://github.com/gosaliajainam/online-movie-booking) and extended and redesigned.

## What I changed and added
- **Security:** user passwords are now hashed with `password_hash` / `password_verify` (the original stored them in plain text), and the feedback form uses prepared statements
- **Account settings:** users can change their username and password from the header menu
- **My Tickets:** new page where users see all the tickets they have bought
- **Admin – All Tickets:** new admin page showing every ticket bought by every customer
- **Seat booking and payment:** rewrote the seat selection, payment and ticket summary pages
- **Admin panel:** redesigned the dashboard, sidebar and the users, customers, feedback and add-movie pages, with delete options for users and feedback
- **Movies:** replaced the original movies with new ones (Zootopia, Tangled, Toy Story, The Bad Guys and more), with posters and trailers
- **Pages:** updated the About Us, Contact, Feedback, movie details and All Movies pages
- **Removed:** the theater/show management and forgot-password pages from the original

## Features
**Users**
- Register, log in and log out
- Change username and password
- Browse running and upcoming movies, and filter all movies by category and language
- Movie details page with trailer
- Seat selection and booking
- Payment and ticket summary
- "My Tickets" page with all booked tickets
- Feedback and contact pages

**Admin**
- Dashboard
- Add, edit and delete movies (with poster upload)
- Manage users and customers
- View all booked tickets
- View and delete feedback

## Technologies
PHP, MySQL (via phpMyAdmin), HTML, CSS, Bootstrap, JavaScript, jQuery, XAMPP

## How to run
1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL**.
2. Put the project folder in XAMPP's `htdocs` folder and name it `movie-booking`:
   - Windows: `C:\xampp\htdocs\movie-booking`
   - macOS: `/Applications/XAMPP/xamppfiles/htdocs/movie-booking`
3. Open http://localhost/phpmyadmin, create a database named `moviebook`, then import `moviebook.sql` into it.
4. Open http://localhost/movie-booking/

The database connection settings are in `Database.php`, `admin/Database.php` and `database_connection.php` (default XAMPP: user `root`, no password).

## Accounts
**Users** – log in at http://localhost/movie-booking/

| Username | Password |
|----------|----------|
| viola    | 123      |
| mateo    | 123      |
| bela     | 123      |

**Admin** – log in at http://localhost/movie-booking/admin/

| Name  | Password |
|-------|----------|
| admin | admin    |

## Documentation
The full project documentation is in [`docs/DOCUMENTATION.docx`](docs/DOCUMENTATION.docx). It was written for the Web Technologies & Programming course (2025) and explains the user roles (guest, user and admin), the database tables, and each page of the website with screenshots.

## Credits
Based on [online-movie-booking](https://github.com/gosaliajainam/online-movie-booking) by gosaliajainam, which is shared for study and non-commercial use.
