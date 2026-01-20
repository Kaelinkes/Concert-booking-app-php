# Concert Booking System

A simple PHP-based web application for booking concert tickets. This system allows users to enter their personal details, select their ticket type, and receive a unique seat number while tracking ticket sales by age group and gender.

---

## Features

- User-friendly HTML form for booking:
  - Name and surname input
  - Age input (16-35 eligible)
  - Gender selection (Male, Female, Other)
  - Ticket type selection (General Admission, VIP, VVIP)
- Automatic seat number assignment (up to 60,000 tickets)
- Real-time ticket sales tracking by:
  - Gender
  - Age group (16-21, 22-35)
- Displays booking confirmation with ticket details and price
- Prevents booking outside eligible age range
- Displays sold-out message when all tickets are sold

---

## Technologies Used

- PHP (Server-side scripting)
- HTML & CSS (Frontend layout and styling)
- Session handling to manage seat numbers and sales data

---

## Usage

1. Clone or download the repository to your local server (e.g., XAMPP, WAMP, or MAMP).
2. Start your local server and place the project in the `htdocs` (or equivalent) folder.
3. Open the project in a web browser (e.g., `http://localhost/concert-booking/`).
4. Fill out the booking form and submit.
5. View booking confirmation and ticket sales summary.

---

## Ticket Pricing

| Ticket Type         | Price (R) |
|--------------------|-----------|
| General Admission   | 500       |
| VIP                 | 2000      |
| VVIP                | 3000      |

---

## Age Groups

- **16-21 years**
- **22-35 years**

> Users outside these age ranges cannot book tickets.

---

## Session Management

- PHP sessions are used to:
  - Keep track of the next available seat number
  - Store ticket sales by gender and age group
- Ticket sales summary updates dynamically as bookings are made.

---

## Future Improvements

- Add database integration for persistent storage
- Implement email confirmation for bookings
- Enable ticket cancellation and refund functionality
- Add search/filter features for booked tickets

