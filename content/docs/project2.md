---
title: "Project 2 – Laravel REST API & DevOps"
date: 2025-01-15
tags: ["laravel", "docker", "shell", "hugo", "github actions"]
---

## Overview

Project 2 takes the **Concert REST API** from Project 1 and upgrades it using modern tools:

- Re-implemented the API using **Laravel**
- Automated deployment with a **shell script** (`run.sh`)
- **Containerized** the app with Docker and Docker Compose
- Re-implemented the documentation using **Hugo + PaperMod** as a portfolio site
- Set up **GitHub Actions** to automatically deploy the Hugo site to **GitHub Pages (GitHub.io)**

This project is designed to be a professional portfolio piece that shows both backend and DevOps skills.

---

## Laravel Implementation

I recreated the Project 1 functionality using Laravel, including:

- API routes in `routes/api.php`
- Controllers under `App\Http\Controllers\Api\`

Example endpoints:

- `GET /api/concerts` – list concerts  
- `POST /api/concerts` – create concert  
- `GET /api/venues` – list venues  
- `POST /api/venues` – create venue  
- `POST /api/bookings` – create booking  
- `GET /api/bookings` – list bookings for the user  

**Eloquent models**:

- `App\Models\User`
- `App\Models\Venue`
- `App\Models\Concert`
- `App\Models\Booking`

Each model uses relationships (e.g., a `Venue` has many `Concerts`, a `User` has many `Bookings`).

Authentication is implemented with **Bearer tokens** so protected endpoints require:

```http
Authorization: Bearer <token>
