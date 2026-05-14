letshopethiswork.infinityfree.me 
# SEN 3002: Full-Stack Web Portfolio
**Developer:** Yasir Ibrahim | Software Engineering Student
**Institution:** Haliç University

## Project Overview
This project is a dynamic, database-driven web portfolio designed to fulfill the requirements of the SEN 3002 Internet & Web Programming course. Rather than utilizing a standard corporate template, the UI/UX architecture was intentionally engineered to replicate the nostalgic 2014-era "Dashboard" aesthetic. It utilizes a fixed-sidebar layout with asynchronous content rendering to provide a seamless, app-like user experience.

## Technology Stack
* **Frontend:** Semantic HTML5, CSS3 (Custom Variables, Flexbox), Vanilla JavaScript (ES6)
* **Backend:** PHP 8+
* **Database:** MySQL
* **Communication:** Fetch API (AJAX) for asynchronous requests
* **Security:** PDO (PHP Data Objects) with Prepared Statements, Password Hashing (`password_verify`), Session Management.

## Core Features & Implementation
1. **Dynamic Data Integration:** The "Technical Arsenal" (skills) and "Featured Projects" sections are not hardcoded in HTML. Upon page load, JavaScript utilizes the Fetch API to asynchronously pull this data from the MySQL database via `fetch_data.php` and injects it into the DOM.
2. **Client-Side & Server-Side Validation:** The contact form ("Ask Box") utilizes JavaScript to prevent submission if fields are empty or improperly formatted. Once validated, data is sent to the server asynchronously. The backend PHP script performs a secondary validation check before executing a secure PDO insert statement. 
3. **Secure Admin Dashboard:** A dedicated `login.php` portal restricts access to the dashboard. Passwords are cryptographically hashed in the database. The `admin.php` page enforces state management utilizing `session_start()`, instantly redirecting unauthorized users.
4. **Database Management (CRUD):** The admin dashboard allows the authenticated user to read incoming messages from the database and permanently delete them directly from the UI interface.

## Deployment
The application is deployed on a live Apache/Linux environment (InfinityFree), requiring careful management of case-sensitive file structures and remote MySQL credential configuration.
