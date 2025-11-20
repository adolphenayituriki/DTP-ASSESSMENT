**PROJECT TOPIC: Community Issue Reporting System (PHP + MySQL)**
___
Project Overview

This project is a Community Issue Reporting System built for the 2-hour software development assessment.
It includes a PHP backend with three API endpoints (create, list, update), a MySQL database, and a simple HTML/JavaScript frontend that interacts with the API.

**Technologies Used**

PHP (WAMP Server)

MySQL Database

HTML, CSS, JavaScript

Git (3 commits: setup, backend, frontend)

**API Endpoints**
1. Create Issue

POST → backend/create_issue.php
Body fields: title, description

2. List Issues

GET → backend/list_issues.php
___

**How to Run the Project**

Install and start WAMP Server

Copy the project into:
C:\wamp64\www\community_report_issue\

Import the SQL table into MySQL

Open the frontend:
http://localhost/community_report_issue/frontend/index.html

API base path:
http://localhost/community_report_issue/backend/

3. Update Issue Status

POST or PUT → backend/update_issue.php?id=ISSUE_ID
Body field: status


