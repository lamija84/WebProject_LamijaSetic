# WebProject_LamijaSetic
DentalClinic
Project Overview

DentalClinic is a web application designed as a management system for a dental clinic. It enables efficient management of patients, appointments, doctors, staff records, and contact messages, providing a structured workflow for daily clinic operations.

This project was developed as part of academic work to simulate a real-world healthcare management system while strengthening backend development skills and gaining practical experience with REST APIs, databases, and full-stack design.

Project Details

Application Type: Web application (clinic management system)

Team Size: Individual project

Role: Full Stack Developer – responsible for designing, building, and testing all aspects of the system

Goal: Build a full-stack healthcare management system to gain practical experience with REST APIs, databases, and secure authentication

Technologies Used

Programming Languages: PHP, SQL, HTML, CSS, JavaScript
Frameworks / Libraries: FlightPHP (backend), PDO (database access), Swagger PHP (API documentation), Firebase PHP JWT (authentication)
Tools: Composer (dependency management), Postman (API testing), GitHub (version control), Live Server (frontend during development)

Architecture and Implementation

Architecture: Layered structure with clear separation of concerns:

Routes: API endpoints for patients, appointments, doctors, and contacts (rest/routes/)

Services: Business logic layer

DAO Classes: Database access layer, extending a BaseDao class to reuse secure PDO queries

Backend: FlightPHP handles routing and request processing. The main entrypoint is rest/index.php which loads all route definitions.

Database: MySQL database named klinika with tables for patients, doctors, appointments, statuses, and contacts. Relationships are managed via DAO queries.

Authentication: JWT-based authentication implemented with Firebase PHP JWT library to secure API access.

Frontend: HTML pages (e.g., index.html, loginsignup.html) with CSS styling and JavaScript for API interaction. Templates stored in tpl/ folder.

API Documentation: Generated with Swagger PHP and accessible at public/v1/docs.

Features

User Authentication: Secure login and signup with JWT

Patient Management: Register, update, and view patient records

Doctor Management: Maintain doctor records with search and filtering options

Appointments: Schedule, track, and manage appointments

Contact Handling: Receive and process contact messages from users

Status Tracking: Maintain and update appointment or patient statuses

Full REST API: Supports standard CRUD operations for all resources

Installation and Setup

Clone the repository:

git clone <repository_url>


Install dependencies via Composer:

composer install


Set up the MySQL database:

Create a database named klinika

Import the provided SQL schema for tables (patients, doctors, appointments, statuses, contacts)

Configure database connection in config.php

Run the backend with PHP (e.g., via built-in server or Apache/Nginx)

Open frontend files (index.html, loginsignup.html) in a browser or use Live Server

Usage

Access the frontend through your browser

Use the login/signup forms to authenticate

Interact with the system to manage patients, doctors, appointments, and contacts

API endpoints can also be accessed directly and tested with Postman

Testing

All API endpoints were tested using Postman to verify:

Input validation

Correct output and data persistence

Error handling

Consistency between frontend and backend

Author

Lamija Šetić – Full Stack Developer, responsible for the complete design, development, and testing of the project.
