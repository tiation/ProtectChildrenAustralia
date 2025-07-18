# API Reference

This document describes the API endpoints available in the Protect Children Australia platform. Each endpoint is designed to provide access to specific functionalities.

## Endpoints

### `GET /api/v1/posts`
- Description: Fetches all blog posts related to child safety.
- Responses:
  - `200 OK`: Returns a list of blog posts.
  - `404 Not Found`: No posts available.

### `POST /api/v1/contact`
- Description: Submits a contact form.
- Request Body:
  - Name: `string` (required)
  - Email: `string` (required)
  - Message: `string` (required)
- Responses:
  - `200 OK`: Message sent successfully.
  - `400 Bad Request`: Missing or invalid fields.

### `PUT /api/v1/posts/:id`
- Description: Update a blog post by ID.
- Path Parameters:
  - id: `string` (required)
- Request Body:
  - Title: `string`
  - Content: `string`
- Responses:
  - `200 OK`: Post updated.
  - `404 Not Found`: Post not found.

### `DELETE /api/v1/posts/:id`
- Description: Deletes a blog post by ID.
- Path Parameters:
  - id: `string` (required)
- Responses:
  - `200 OK`: Post deleted successfully.
  - `404 Not Found`: Post not found.
