# LMS
<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/your_username/repo_name">
    <img src="img/01.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Library Management System</h3>

  <p align="center">
    A comprehensive solution to manage library operations efficiently.
    <br />
    <a href="https://github.com/Chamaracperera/LMS.git"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/Chamaracperera/LMS.git">View Demo</a>
    ·
    <a href="https://github.com/Chamaracperera/LMS/issues/new?labels=bug&template=bug-report---.md">Report Bug</a>
    ·
    <a href="https://github.com/Chamaracperera/LMS/issues/new?labels=enhancement&template=feature-request---.md">Request Feature</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
    <li><a href="#collaborations">Collaborations</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->
## About The Project

The Library Management System is a comprehensive web-based software solution designed for efficient library operations. It enables administrators to manage user registrations, book entries, and member fines. With features like book availability tracking and seamless integration, the system ensures a user-friendly and reliable tool for librarians to organize, monitor, and maintain library resources effectively.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

This section lists the major frameworks/libraries used to bootstrap the project.

* [![HTML][html-badge]][html-url]
* [![CSS][css-badge]][css-url]
* [![JavaScript][js-badge]][js-url]
* [![PHP][PHP.com]][PHP-url]
* [![MySQL][MySQL.com]][MySQL-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

List of things you need to use the software and how to install them.
* XAMPP
  ```sh
  Download and install XAMPP from https://www.apachefriends.org/index.html
  ```

### Installation

_Below are the steps to set up the project._

1. Clone the repo
   ```sh
   git clone https://github.com/Chamaracperera/LMS.git
   ```
2. Copy the project to the `htdocs` folder of XAMPP
3. Start Apache and MySQL from the XAMPP control panel
4. Import the provided database
   1. Open phpMyAdmin
   2. Create a new database named `library_system`
   3. Import the provided `database.sql` file into `library_system`
5. Configure the database connection in `config.php`
   ```php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'library_system');
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->
## Contact

Chamara Perera - [@twitter](https://www.linkedin.com/in/chamara-perera-b832762b7?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app)

Project Link: [https://github.com/Chamaracperera/LMS.git](https://github.com/Chamaracperera/LMS.git)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

Resources used and credits:

* [GitHub Pages](https://pages.github.com)
* [Sweet alert](https://github.com/t4t5/sweetalert.git)
* [Unicons](https://unicons.iconscout.com)
* [unpkg](https://unpkg.com)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- COLLABORATION -->
## Collaborations

This project is made possible through the collaboration of the following team members:

* **Feature 1 – Login and User Registration**
  * [Chamara Perera ](https://github.com/Chamaracperera)
* **Feature 2 – Books Registration**
  * [Chanuli Sandanayake](https://github.com/Chanuli-Sandanayake)
  * [Sathsarani Geethamali](https://github.com/Sathsarani2002)
* **Feature 3 – Library Member Registration (by library staff)**
  * [Avindi Navodya ](https://github.com/AvindiNavodya)
  * [Chamathya Sepiyumi](https://github.com/Du2002)
* **Feature 4 – Book Borrow Details**
  * [Imansa Gayathmi](https://github.com/Imansa2002)
  * [Prageeth Dissanayake](https://github.com/PrageethDisanayaka)


<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[PHP.com]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://www.php.net/
[MySQL.com]: https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white
[MySQL-url]: https://www.mysql.com/
[html-badge]: https://img.shields.io/badge/HTML-239120?style=for-the-badge&logo=html5&logoColor=white
[html-url]: https://developer.mozilla.org/en-US/docs/Web/HTML
[js-badge]: https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black
[js-url]: https://developer.mozilla.org/en-US/docs/Web/JavaScript
[css-badge]: https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=css3&logoColor=white
[css-url]: https://www.w3schools.com/css/
