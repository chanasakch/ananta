# ANANTA Custom Diamond Plugin

A WordPress plugin developed for the ANANTA technical test. It enables customers to select a custom diamond when purchasing a ring setting. The project also includes a containerized deployment using Docker and a CI/CD pipeline via GitHub Actions.

---

## Plugin Features

### Backend Features
- **Diamond Database Design**: MySQL table created with fields from the supplier API.
- **Diamond Import Process**: Admin page to fetch & store diamond data from:  
  `https://anantajewelry.com/pub/tech-test/mock-diamonds.json`  
  (see: `includes/fetch_diamonds.php`).
- **REST API**: Registered endpoint `/wp-json/ananta/v1/diamonds` returns all diamonds.

### Frontend Features
- **Diamond Selector UI**: Vue.js component shown on ring product page.
- **Final Price Display**: Calculates diamond price in THB and adds to product price.
- **WooCommerce Cart Integration**: Diamond info appears in cart + pricing included.
- **Order Metadata**: Selected diamond saved with WooCommerce order items.
- **Gutenberg Block**: Registered `ananta/diamond-block` shows 6 random diamonds on frontend (`blocks.php`).
- **Vue Component & Styles**: Located in `assets/js/diamond-selector.js` and `assets/css/diamond-selector.css`.

### WordPress Best Practices
- Plugin logic encapsulated in a class (`TechTestPlugin`)
- Proper hooks and separation of admin/frontend logic
- Sanitization and validation for all external data

---

## Docker Setup

- WordPress containerized using official `nginx` base image.
- Dockerfile located at project root.

### Dockerfile Highlights
- Uses `nginx` base image.
- Mounts PHP files and WordPress content.
- Prepared for CI/CD pipeline.

---

## 🔁 CI/CD with GitHub Actions

- Workflow file: `.github/workflows/docker.yml`
- Automatically builds Docker image and pushes to Docker Hub on push to `main` branch.
- Uses secrets `DOCKER_USERNAME` and `DOCKER_PASSWORD` for authentication.

---

## Setup Guide

1. **Clone Repo**  
   `git clone https://github.com/chanasakch/ananta.git`

2. **Restore DB** using provided dump.

3. **Run WordPress locally**  
   URL: `http://anantatechtest.localhost`  
   Admin: `admin / admin`

4. **Activate Plugin** via WordPress admin.

5. **Use 'Import Diamonds' menu** to fetch data.

---

## ✅ Completed Tasks (Scoring Summary)

| Task                                                 | Status | Points |
|------------------------------------------------------|--------|--------|
| Design diamond database                              | ✅     |        |
| Import diamonds from API                             | ✅     |        |
| Display diamond selector on product page             | ✅     |        |
| Show final price with diamond                        | ✅     |        |
| Include diamond in WooCommerce cart                  | ✅     |        |
| Save diamond in WooCommerce order                    | ✅     |        |
| Gutenberg block with 6 random diamonds               | ✅     |        |
| WordPress best practices                             | ✅     |        |
| Dockerfile configuration (nginx container)           | ✅     |        |
| CI/CD GitHub Actions (push to DockerHub)             | ✅     |        |
| Technical documentation (this file)                  | ✅     |        |
| **Total**                                            |        |        |

---

## Folder Structure

```
ananta-custom-diamond/
│
├── assets/
│   ├── js/diamond-selector.js
│   └── css/diamond-selector.css
├── includes/
│   └── fetch_diamonds.php
├── blocks.php
├── ananta-custom-diamond.php
├── Dockerfile
├── .github/
│   └── workflows/docker.yml
└── README2.md
```

---

## Author
ANANTA Technical Test Solution – by chanasakch  
Repo: [https://github.com/chanasakch/ananta](https://github.com/chanasakch/ananta)