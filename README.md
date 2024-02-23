# Lab Automation System

### Participants: Khuzaima Ahmed, Muhammad Yousuf, Shoaib Shah, Muhammad Yahya
### Mentor: Syed Muhammad Arsalan Shah

## Table of Contents

1. [Introduction](#introduction)
2. [Project Synopsis](#project-synopsis)
3. [Project Analysis](#project-analysis)
4. [Project Design](#project-design)
5. [DFDs](#dfds)
6. [Process Diagram](#process-diagram)
7. [Screen Shots](#screen-shots)
8. [Source Code](#source-code)
9. [User Guide](#user-guide)
10. [Developer’s Guide](#developers-guide)

## Introduction
The Lab Automation System is a software application designed to automate laboratory or testing facility operations. It aims to streamline testing processes, facilitate data management, and enhance overall productivity. This project was developed collaboratively to provide a comprehensive lab automation solution.

## Project Synopsis
The primary goal of this project is to automate laboratory systems, eliminating the need for manual record-keeping and enabling efficient data storage in databases. The Lab Automation System offers advanced search functionality, efficient testing of products, report generation, analysis, and user management.

## Project Analysis
The Lab Automation System aims to automate laboratory operations, making daily tasks easier and more reliable. Key features include record management, advanced search functionality, user management, testing and reporting, analysis, and security measures.

## Project Design
The project was meticulously designed to ensure a user-friendly experience. The architecture prioritizes simplicity and efficiency, with a focus on clear navigation and straightforward data storage. Bootstrap and jQuery were utilized for frontend and AJAX functionality.

## DFDs
The Data Flow Diagrams (DFDs) are located in the `documentation/DFDs` folder.

## Process Diagram
The Process Diagrams are located in the `documentation/Process Diagram` folder.

## Screen Shots
High-quality screenshots of every page within the Lab Automation System are available in the `Screen Shots` folder within the Documentation Directory.

## Source Code
The source code, accompanied by clear and concise comments, is available in the `PHP Lab Automation` folder for easy reference.

## User Guide
The User Guide provides comprehensive instructions on using the Lab Automation System, including account creation, navigation, product testing, record viewing, and administrative functionalities.

## Developer’s Guide
### Introduction to Development Environment
The Lab Automation System is developed using PHP for the backend logic, HTML, CSS, JavaScript, and Bootstrap for the frontend interface, and MySQL for the database management system. Follow these steps to set up the development environment:
- Ensure PHP, MySQL, and a web server (such as Apache or Nginx) are installed on your system.
- Clone the project repository from the provided GitHub link.
- Import the database schema using the provided SQL dump file.
- Configure the database connection settings in the appropriate configuration file.

### Architecture Overview
The system follows the MVC (Model-View-Controller) architecture, where the Model represents the data and business logic, the View represents the user interface, and the Controller handles user input and interactions.

### Folder Structure
The project folder structure is organized as follows:
- `assets`: Contains CSS, JavaScript, and image files.
- `assets/php`: Contains PHP files for backend logic.
- `assets/php/connections`: Contains PHP files for database connections.
- `assets/php/auth.php`: Contains authentication logic.
- `assets/php/navbar.php`: Contains code for the navigation bar.
- `assets/php/footer.php`: Contains code for the footer section.
- `documentation`: Contains documentation files, including user guides and developer guides.

### Coding Standards
Follow PSR (PHP Standards Recommendations) for PHP coding standards. Use consistent naming conventions for variables, functions, and classes. Include comments in the code to explain the purpose of functions, classes, and complex logic.

### Source Code Overview
Main source code files include `main.php`, `login.php`, `signup.php`, `product_testing.php`, `testing_records.php`, `product_information.php`. Each file handles specific functionalities such as authentication, user registration, product testing, and record management. Comments within the source code provide insights into the functionality of each section.

### Database Schema
The database schema consists of tables such as `user_info`, `testing_process`, etc. Import the database schema using the provided SQL dump file (`lab_automation.sql`, `testing_process.sql`). Configure the database connection settings in `assets/php/connections/connection.php` and `assets/php/connections/testing_connection.php`.

### Testing Procedures
Testing procedures include manual testing of each functionality to ensure proper functionality and user experience. Developers can use tools like PHPUnit for automated unit testing.

### Deployment Instructions
Deploy the Lab Automation System to a web server with PHP and MySQL support. Ensure proper file permissions and security measures are implemented. Update configuration files with production environment settings.

### Contributing Guidelines
Fork the project repository, make changes in a separate branch, and submit a pull request for review. Follow coding standards and guidelines provided in the Developer's Guide. Participate in code reviews and discussions for improvements.

### Troubleshooting and Support
For technical support and issue resolution, refer to the project's GitHub repository or contact the project maintainers. Refer to the documentation for common issues and solutions.

### Version Control
The project uses Git for version control. Clone the project repository, create feature branches for development, and merge changes using pull requests.
