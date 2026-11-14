# AGENTS.md — SCAIT Portal Project Knowledge Base & Agent Guidelines

> **Project Identity:** Student Computer Academy of IT (SCAIT) — `scait.in`  
> **Location / Institution:** Mahewa Road, Tewa, Kaushambi (Uttar Pradesh, India)  
> **Source Origin:** Production backup of Apache cPanel `public_html` directory (`/home/stoodooc/public_html/`)  
> **Primary Stack:** Native PHP (7.4+), MySQL / MariaDB, PHP GD Library, Apache (`.htaccess`), Bootstrap & Materialize CSS

---

## 1. Project Overview

This repository hosts the full web portal, administration system, certificate generator, online examination tool, and certificate verification suite for **Student Computer Academy of IT (SCAIT)**.

Key capabilities provided by this codebase:
1. **Public Web Portal (`index.php`)**: Institute information, course listings (ADCA, CCC, Tally, Typing, etc.), student admission inquiry, student registration modal, and certificate check modal.
2. **Dynamic Certificate Generator (`certificate/index.php`)**: Programmatic certificate image synthesis using PHP GD. Overlays student metadata, issue date, grades, and student passport photo onto high-resolution certificate templates (`certificate.jpg`) using TrueType fonts.
3. **Certificate Verification System**:
   - **Legacy PHP Search (`s_chk_res.php`)**: Queries local MySQL database by roll number and course, redirecting to the generated certificate.
   - **Modern API-Driven Verification (`veriy/index.html`)**: Single-page application rewritten with modern responsive UI and Lottie animations, communicating with a cloud REST API backend (`https://scaitbackend.onrender.com/verify/:id`).
4. **Admin Dashboard (`admin-user-add.php`, `admin-user-all.php`, `admin_log.php`)**: Admin authentication, adding student certificate records with automatic photo resizing (413x531 px), viewing, and deleting records.
5. **Online Examination & Quiz System (`exam.php`, `add_question.php`, `add_que.php`)**: Question bank administration and client-side monitored student testing environment (detects tab switches via `visibilitychange`).
6. **Tutorial Sub-site (`cgc/`)**: "C Guru Cool" — comprehensive static tutorial pages covering C programming fundamentals.

---

## 2. Directory Structure & Inventory

```
.
├── AGENTS.md                  # This file: Project guide & instructions for AI agents
├── .htaccess                  # Apache rewrite rules (HTTPS redirect, /veriy/ routing, PHP handler)
├── .well-known/               # SSL / ACME challenge directory for Let's Encrypt
│   └── acme-challenge/
│
├── connection.php             # MySQL database connection script (mysqli)
├── scaitin_academy.sql        # Database schema and initial data dump
│
├── index.php                  # Main public homepage (Contains course catalog, modals, forms)
├── error_page.php             # Unified error/feedback display with auto-redirect
├── logout.php                 # Admin session destroy & redirect
│
├── admin_log.php              # Handles admin login authentication
├── admin-user-add.php         # Admin form: Upload student details & photo
├── admin-user-all.php         # Admin table: List all students, filter by course, delete action
├── del_su_cer_det.php         # Endpoint to delete a student certificate record
│
├── s_adm.php                  # Processes public admission inquiries -> inserts into `s_adm`
├── s_det.php                  # Processes public student registration -> inserts into `s_det`
├── s_cer_det.php              # Processes admin student certificate entry -> inserts into `s_cer_det`
├── s_chk_res.php              # Handles search by Roll No & Course -> redirects to certificate
│
├── certificate/               # Dynamic certificate generation module
│   ├── index.php              # GD rendering engine: merges template, photo & fonts -> creates JPG
│   ├── certificate.jpg        # Master certificate template image (high res)
│   ├── Certificate.ttf        # Calligraphic font for main course/title
│   ├── Helvetica.ttf          # Helvetica Regular TTF for student details
│   ├── Helvetica-Bold.ttf     # Helvetica Bold TTF for headings
│   ├── Helvetica-BoldOblique.ttf
│   ├── pass.png_thump.png     # Default passport placeholder
│   ├── cer_img/               # Storage directory for generated certificate JPGs
│   ├── stu_img/               # Student photo storage
│   └── upload/                # Uploaded and resized student passport photos
│
├── cer_img/                   # Root-level cache of generated student certificates
├── photo/                     # Upload directory for public student registration photos (`s_det`)
├── upload/                    # General upload directory
│
├── veriy/                     # Modern Single-Page Certificate Verification app
│   └── index.html             # Vanilla JS + CSS3 + Lottie + REST API client (`onrender.com`)
│
├── scaitbackend-main/         # Node.js + Express + MongoDB + Canvas + QRCode microservice (Render backend)
│   ├── index.js               # Express API (/verify/:id, /generate-certificate, /generate-diploma, /save-student)
│   ├── GenerateImage.js       # Canvas result generation script
│   ├── package.json           # Dependencies (canvas, qrcode, cloudinary, mongoose, express)
│   ├── certificate.jpg        # Base template for Node canvas
│   └── diploma.jpg            # Base diploma template for Node canvas
│
├── exam.php                   # Online examination / test interface with visibility detection
├── add_question.php           # Admin interface to input multiple-choice questions
├── add_que.php                # Backend handler: Inserts questions into `question` table
│
├── cgc/                       # "C Guru Cool" tutorial mini-site
│   ├── index.html             # C programming tutorial index
│   ├── constants.html         # Tutorials on constants, variables, keywords, comments, etc.
│   ├── codes_style.css        # Stylesheet for C code formatting
│   └── ...
│
├── css/                       # Global CSS (bootstrap.css, materialize.css, style.css, style-mob.css)
├── js/                        # Global JS (bootstrap.min.js, materialize.min.js, custom.js, main.min.js)
├── fonts/                     # FontAwesome & Glyphicons
├── images/ & img/             # Theme graphics, banners, icons, and logos
└── error_log                  # Apache/PHP server runtime error log
```

---

## 3. Database Schema & Data Dictionary

Database dump file: `scaitin_academy.sql` (Default DB name in config: `stoodooc_scait`).

### Table: `admin`
Stores credentials for administrative access.
| Column | Type | Attributes | Description |
|---|---|---|---|
| `id` | `int(11)` | PRIMARY KEY, AUTO_INCREMENT | Unique admin identifier |
| `user` | `varchar(255)` | NOT NULL | Admin username |
| `pass` | `varchar(255)` | NOT NULL | Admin password (currently plain-text) |

### Table: `s_cer_det` (Student Certificate Details)
Core table holding student records for certificate generation and result verification.
| Column | Type | Attributes | Description |
|---|---|---|---|
| `id` | `int(255)` | PRIMARY KEY, AUTO_INCREMENT | Unique student record ID |
| `name` | `varchar(255)` | DEFAULT NULL | Student's full name |
| `fname` | `varchar(255)` | DEFAULT NULL | Father's name |
| `mname` | `varchar(255)` | DEFAULT NULL | Mother's name |
| `enroll` | `varchar(255)` | DEFAULT NULL | Enrollment Number |
| `roll` | `varchar(255)` | DEFAULT NULL | Roll Number (used for lookup) |
| `dob` | `varchar(255)` | DEFAULT NULL | Date of Birth (format string, e.g. "12-May-2000") |
| `course` | `varchar(255)` | DEFAULT NULL | Enrolled course (ADCA, TALLY, TYPING, CCC, etc.) |
| `duration` | `varchar(255)` | DEFAULT NULL | Course duration ("3 Months", "6 Months", "1 Year") |
| `gender` | `varchar(255)` | DEFAULT NULL | "male" or "female" (controls "He"/"She" on certificate) |
| `photo` | `varchar(255)` | DEFAULT NULL | Relative path to resized passport photo |

### Table: `s_adm` (Student Admission Inquiries)
Captures leads submitted through the public inquiry form.
| Column | Type | Attributes | Description |
|---|---|---|---|
| `id` | `int(255)` | PRIMARY KEY, AUTO_INCREMENT | Unique lead ID |
| `Name` | `varchar(255)` | NOT NULL | Inquirer name |
| `Phone` | `varchar(255)` | NOT NULL | Contact phone number |
| `Address` | `varchar(255)` | NOT NULL | Inquirer address |

### Table: `s_det` (Registered Students)
Stores student accounts created via public student registration modal.
| Column | Type | Attributes | Description |
|---|---|---|---|
| `id` | `int(11)` | PRIMARY KEY, AUTO_INCREMENT | Unique student ID |
| `name` | `varchar(255)` | NOT NULL | Student name |
| `phone` | `varchar(255)` | NOT NULL | Phone number |
| `course` | `varchar(255)` | NOT NULL | Course applied for |
| `profile` | `varchar(255)` | NOT NULL | Uploaded profile image path (`photo/...`) |
| `pass` | `varchar(255)` | NOT NULL | Account password (plain-text) |

### Table: `question` (Online Exam Questions)
Referenced by `add_que.php` and `exam.php` (created for the quiz module).
| Column | Type | Description |
|---|---|---|
| `id` | `int` | Primary Key, Auto Increment |
| `que` | `text` | Question statement |
| `opt1`, `opt2`, `opt3`, `opt4` | `varchar(255)` | Four multiple-choice options |
| `correct` | `varchar(255)` | Correct option value |

---

## 4. Key Workflows & Execution Mechanics

### 4.1 Dynamic Certificate Generation (`certificate/index.php`)
1. Accepts query parameters: `of` (Roll Number) and `cor` (Course).
2. Queries `s_cer_det WHERE roll='$of' AND course='$cor'`.
3. Loads base template image (`certificate.jpg`) into a GD image resource.
4. Loads student passport photo from `$fet['photo']` and merges it into position `(X: 2250, Y: 1650)` with dimensions `413 x 531 px` via `imagecopymerge()`.
5. Uses `imagettftext()` to print:
   - Certificate Title (X depends on course length: ADCA=100, TALLY=680, TYPING=705)
   - Enrollment, Roll Number, Duration at `(410, 1500)`
   - Student Name, Father's Name, Mother's Name, DOB at `(1210, 1800)`
   - Course Modules / Syllabus description at `(410, 2800)`
   - Grade Award string ("He/She has been Awarded with 'A' grade") at `(418, 3390)`
6. Writes JPEG output to `cer_img/{roll}.jpg`.
7. Displays preview in HTML with a single-click download button.

### 4.2 Certificate Verification (`veriy/index.html`)
- Rewrite rule in `.htaccess`: `RewriteRule ^veriy/([a-zA-Z0-9]+)/?$ /veriy/index.html [L]`
- URL structure: `https://scait.in/veriy/{ROLL_OR_ENROLLMENT_NO}`
- Extracts ID from path or query string (`?id=...`).
- Queries backend REST API: `https://scaitbackend.onrender.com/verify/${id}`.
- Displays animated verification shield, student photo, father/mother name, session, grades, percentage, and SCAIT digital authentication badge.

### 4.3 Admin Flow
- **Login (`admin_log.php`)**: Form in `index.php` posts to `admin_log.php`. Checks `admin` table; upon match, sets `$_SESSION['user'] = $user` and redirects to `admin-user-add.php`.
- **Add Record (`admin-user-add.php` -> `s_cer_det.php`)**:
  - Validates session.
  - Form receives student details and uploaded image.
  - `s_cer_det.php` uses GD (`imagecreatetruecolor`, `imagecopyresized`) to force image dimensions to 413x531 px.
  - Saves file to `certificate/upload/{name}{timestamp}.jpg`.
  - Inserts row into `s_cer_det`.
- **View & Delete (`admin-user-all.php` -> `del_su_cer_det.php`)**:
  - Displays table of students. Filterable by `?course=...`.
  - Delete button links to `del_su_cer_det.php?id={id}`.

### 4.4 Online Exam Engine (`exam.php`)
- Contains test container styling and anti-cheating check:
  ```javascript
  document.addEventListener("visibilitychange", function() {
    if (document.hidden) {
      alert("Tab switched / screen hidden!");
    }
  });
  ```

### 4.5 Cloud Node.js Microservice (`scaitbackend-main` -> `scaitbackend.onrender.com`)
- **Stack:** Node.js (v24), Express.js, MongoDB Atlas (`student` DB, `results` collection), Cloudinary, `canvas`, `qrcode`.
- **Endpoints:**
  - `GET /verify/:id`: Fetches student record from MongoDB matching `rollNumber: id` and returns verification JSON for `veriy/index.html`.
  - `POST /generate-certificate`: Uses `canvas` and `qrcode` to generate PNG certificate with dynamic QR code pointing to `https://scait.in/veriy/${rollNumber}` at `(700, 930)`.
  - `POST /generate-diploma`: Uses `canvas` and `diploma.jpg` with dynamic QR code at `(100, 110)`.
  - `POST /save-student`: Validates base64 photo, uploads to Cloudinary, and saves student/marksheet data to MongoDB Atlas.

---

## 5. Critical Bugs & Security Vulnerabilities (Immediate Attention Required)

When working on this repository, agents **must prioritize** remediating these critical issues:

1. **Syntax Error in `index.php` (Line 1)**:
   - Line 1 begins with `/<`?php (a stray leading slash).
   - This corrupts HTTP headers and outputs `/` at the top of the browser view.
2. **Severe SQL Injection Vulnerabilities (Everywhere)**:
   - All PHP endpoints (`admin_log.php`, `s_cer_det.php`, `s_adm.php`, `s_det.php`, `s_chk_res.php`, `del_su_cer_det.php`, `admin-user-all.php`) concatenate raw `$_POST` / `$_GET` variables into SQL queries.
   - **Fix**: Use parameterized prepared statements (`$stmt = mysqli_prepare(...)` or PDO).
3. **Plaintext Passwords**:
   - Both `admin` and `s_det` store passwords in clear text without hashing.
   - **Fix**: Upgrade to `password_hash()` and `password_verify()`.
4. **Broken Access Control on Delete (`del_su_cer_det.php`)**:
   - `del_su_cer_det.php` executes `DELETE FROM s_cer_det WHERE id = '$_GET[id]'` without verifying `$_SESSION['user']`. Any unauthenticated user can wipe records.
   - **Fix**: Add `session_start()` and verify authentication before deleting.
5. **Hardcoded Database Credentials (`connection.php`)**:
   - Hardcoded host, user, password, and database name.
   - **Fix**: Use environment variables or a non-committed config file (`.env` or `config.php` outside webroot).
6. **Hardcoded Production Domain (`scait.in`)**:
   - Redirects in `s_chk_res.php`, `error_page.php`, and `index.php` hardcode `https://scait.in/...` instead of using relative paths, breaking local development and staging environments.
7. **Insecure File Uploads (`s_cer_det.php` & `s_det.php`)**:
   - Only checks client-provided MIME type `$_FILES['file']['type']` which can be easily spoofed. Does not strictly validate extension or scan for PHP shell scripts inside images.

---

## 6. Guidelines for AI Agents Working on this Codebase

When making modifications or adding features to this repository, follow these rules:

1. **Never break certificate alignment**:
   - Coordinate offsets in `certificate/index.php` (e.g. `X: 2250, Y: 1650` for photo; `(410, 1500)`, `(1210, 1800)`) are tuned to the exact physical dimensions of `certificate.jpg`. Do not change these numbers without testing rendering against the template.
2. **Preserve Font Files**:
   - The TrueType font files (`Certificate.ttf`, `Helvetica.ttf`, `Helvetica-Bold.ttf`) in both root and `certificate/` must remain intact; missing font files will cause `imagettftext()` fatal errors.
3. **Maintain Dual Verification Paths**:
   - `veriy/index.html` connects to an external Render microservice (`scaitbackend.onrender.com`).
   - `s_chk_res.php` and `certificate/index.php` use local MySQL and GD image rendering.
   - Ensure changes to student schemas account for both systems or bridge them appropriately.
4. **Local Testing**:
   - Can be run with PHP's built-in development server:
     ```bash
     php -S localhost:8000
     ```
   - Note: Requires `php-gd` and `php-mysqli` extensions enabled.
5. **Session Management**:
   - Ensure `session_start()` is called at the very top of all authenticated pages before any whitespace or HTML output.
6. **Keep Backwards Compatibility**:
   - Keep URLs for certificate lookups (`certificate/index.php?of={roll}&cor={cor}`) functioning, as historical printed certificates may have QR codes or links pointing to this structure.

