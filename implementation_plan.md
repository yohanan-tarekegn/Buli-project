# Implementation Plan - Gap Filling (All Target Users & Missing Features)

This plan fills the gaps identified from the proposal's target users and additional features checklist. 

## Summary of Gaps to Fill

| Priority | Feature | Who it serves |
|---|---|---|
| 🔴 High | Login/Portal button visible on website | All users |
| 🔴 High | Student Portal (login + dashboard) | Current Students |
| 🔴 High | Staff login (to post updates) | Staff & College |
| 🟡 Medium | Photo & Video Gallery page | Partners, Alumni, Community |
| 🟡 Medium | Download Center (forms, publications) | Prospective & Current Students |
| 🟢 Low | Alumni & Partners section | Partners, Alumni, Community |

---

## Proposed Changes

### 1. Database — New Tables

#### [MODIFY] [database.sql](file:///c:/xampp/htdocs/Buli-website/database.sql)
New tables to add:
- **`students`**: Stores registered student login accounts (name, email, password hash, department, status).
- **`staff`**: Stores staff login accounts (name, email, password hash, role).
- **`gallery`**: Stores photo/video items (title, file path, type, date).
- **`downloads`**: Stores downloadable file records (title, category, file path, date).

---

### 2. Login Portal Button

#### [MODIFY] [header.php](file:///c:/xampp/htdocs/Buli-website/includes/header.php)
- Add a **"Login"** button in the top navigation bar that opens a dropdown with two options:
  - 👤 **Student Login** → `student_login.php`
  - 🔒 **Staff / Admin Login** → `staff_login.php`

---

### 3. Student Portal

#### [NEW] [student_login.php](file:///c:/xampp/htdocs/Buli-website/student_login.php)
- Clean login form with email + password fields.
- Verifies credentials against the `students` table using `password_verify()`.
- On success, stores `$_SESSION['student_id']` and redirects to the portal dashboard.

#### [NEW] [student_portal.php](file:///c:/xampp/htdocs/Buli-website/student_portal.php)
- Accessible only when `$_SESSION['student_id']` is set.
- Shows:
  - Personal information summary (name, department, registration status from `admissions`).
  - Latest college announcements and news (from `news_events` table).
  - Links to Download Center for academic resources.
  - Logout button.

---

### 4. Staff Portal

#### [NEW] [staff_login.php](file:///c:/xampp/htdocs/Buli-website/staff_login.php)
- Login form with email + password verification against `staff` table.
- Staff role determines where they are redirected:
  - **Admin role** → `admin.php` (existing panel)
  - **Staff role** → `staff_portal.php`

#### [NEW] [staff_portal.php](file:///c:/xampp/htdocs/Buli-website/staff_portal.php)
- Simple staff dashboard for non-admin staff.
- Allows staff to post news/announcements entries directly into the `news_events` table.
- Logout button.

---

### 5. Photo & Video Gallery

#### [NEW] [gallery.php](file:///c:/xampp/htdocs/Buli-website/gallery.php)
- Reads gallery items from the `gallery` database table.
- Displays images in a simple CSS grid layout.
- Falls back to placeholder panels if table is empty.

#### [MODIFY] [header.php](file:///c:/xampp/htdocs/Buli-website/includes/header.php)
- Add `Gallery` link to the navigation menu.

---

### 6. Download Center

#### [NEW] [downloads.php](file:///c:/xampp/htdocs/Buli-website/downloads.php)
- Lists available downloadable items from the `downloads` table.
- Categorized: Application Forms, Academic Guides, Publications, Regulations.
- Falls back to a simple sample list if DB table is empty.

#### [MODIFY] [header.php](file:///c:/xampp/htdocs/Buli-website/includes/header.php)
- Add `Downloads` link to navigation.

---

## Verification Plan

### Manual Verification
1. Submit a student application on `admission.php` — register a student account on `student_login.php` and verify dashboard shows their info.
2. Log in as staff on `staff_login.php`, post a news update, and verify it appears on the homepage.
3. Verify Admin login button correctly redirects to `admin.php`.
4. Confirm Gallery page displays (or shows empty message if no images uploaded).
5. Confirm Downloads page lists seeded file entries from the database.
