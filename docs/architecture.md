# Architecture

The Protect Children Australia website is designed to be modular and secure, utilizing modern web technologies.

## Overview

- **Frontend**: Built with HTML5, CSS3, and JavaScript. Utilizes the Bootstrap framework for responsiveness.
- **Backend**: Developed in PHP, interacting with a MySQL database using PDO for secured database operations.
- **Security**: Implements best practices including prepared statements, input sanitization, password hashing, and CSRF protection.

## Diagram

![Architecture Diagram](architecture-diagram.png)

## Components

- **Web Server**: Handles HTTP requests and serves web pages.
- **Database**: MySQL relational database for persistent data storage.
- **Admin Panel**: Allows authorized users to manage website content and settings.
- **Public Site**: Provides safety information and resources to users.

## Future Enhancements

Potential improvements include advanced caching, load balancing, and API gateway implementation.
