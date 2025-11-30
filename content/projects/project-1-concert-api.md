---
title: "Concert REST API – Project 1"
date: 2025-01-01
tags: ["php", "rest api", "mysql", "nginx"]
---

## Overview

This project implements a **Concert REST API** that supports:

- Users and authentication
- Venues
- Concerts
- Ticket bookings

Clients can:

- Register and log in
- View/create venues
- View/create concerts
- Book tickets for a concert

This documentation was originally written as a **Marp slide deck** and has been **re-implemented here as a Hugo page** for my portfolio site.

---

## Tech Stack

- **PHP** REST API
- **MySQL** database (managed through phpMyAdmin)
- **XAMPP** for local development
- **NGINX** for deployment
- **cURL / HTML pages** for testing

---

## Database Design

The system uses several related tables:

- `users` – user accounts and credentials
- `venues` – concert locations
- `concerts` – concert events
- `bookings` – ticket bookings for a user and concert

Relationships:

- One **venue** has many **concerts**
- One **concert** can have many **bookings**
- One **user** can have many **bookings**

---

## API Endpoints (Conceptual)

| Endpoint        | Method | Description                   | Auth |
|----------------|--------|-------------------------------|------|
| `/register`    | POST   | Create a new user             | ❌   |
| `/login`       | POST   | Log in and return a token     | ❌   |
| `/venues`      | GET    | List venues                   | ❌   |
| `/venues`      | POST   | Create venue                  | ✅   |
| `/concerts`    | GET    | List concerts                 | ❌   |
| `/concerts`    | POST   | Create concert                | ✅   |
| `/bookings`    | GET    | List bookings for a user      | ✅   |
| `/bookings`    | POST   | Create a new booking          | ✅   |
| `/profile`     | GET    | Get currently logged-in user  | ✅   |

Protected endpoints require:

```http
Authorization: Bearer <token>
