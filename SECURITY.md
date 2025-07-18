# Security Policy

## Supported Versions

We release patches for security vulnerabilities. Which versions are eligible receiving such patches depends on the CVSS v3.0 Rating:

| Version | Supported          |
| ------- | ------------------ |
| 1.0.x   | :white_check_mark: |
| < 1.0   | :x:                |

## Reporting a Vulnerability

The Protect Children Australia team takes security bugs seriously. We appreciate your efforts to responsibly disclose your findings, and will make every effort to acknowledge your contributions.

To report a security issue, please use the GitHub Security Advisory ["Report a Vulnerability"](https://github.com/yourusername/ProtectChildrenAustralia/security/advisories/new) tab.

The Protect Children Australia team will send a response indicating the next steps in handling your report. After the initial reply to your report, the security team will keep you informed of the progress towards a fix and full announcement, and may ask for additional information or guidance.

Report security bugs in third-party modules to the person or team maintaining the module.

## Security Features

- **Input Validation**: All user inputs are validated and sanitized
- **SQL Injection Prevention**: All database queries use prepared statements
- **CSRF Protection**: Cross-site request forgery protection on all forms
- **Session Security**: Secure session management with proper cookie settings
- **Password Security**: Passwords are hashed using PHP's password_hash() function
- **File Upload Security**: Restricted file uploads with proper validation
- **Error Handling**: Secure error handling that doesn't expose sensitive information

## Security Updates

Security updates will be released as soon as possible after a vulnerability is confirmed. Users are encouraged to update to the latest version immediately.

## Contact

For security-related questions or concerns, please contact:
- Email: security@protectchildren.com.au
- Response time: Within 48 hours
