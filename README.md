# API Documentation

## Authentication

### Register
**Endpoint:** `POST /api/register`

**Request Body:**
```json
{
  "name": "John Doe",
  "email": "johndoe@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response:**
```json
{
  "message": "User registered successfully",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "johndoe@example.com",
    "role": "user"
  }
}
```

---

### Login
**Endpoint:** `POST /api/login`

**Request Body:**
```json
{
  "email": "johndoe@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "token": "your-access-token",
  "role": "user"
}
```

---

### Logout
**Endpoint:** `POST /api/logout`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Response:**
```json
{
  "message": "Logged out successfully."
}
```

---

## Admin Endpoints

### Admin Dashboard
**Endpoint:** `GET /api/admin/dashboard`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Response:**
```json
{
  "message": "Welcome, Admin!"
}
```

---

### Get All Articles (Admin)
**Endpoint:** `GET /api/admin/articles`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Response:**
```json
[
  {
    "id": 1,
    "title": "First Article",
    "content": "This is the content of the first article."
  }
]
```

---

### Create Article (Admin)
**Endpoint:** `POST /api/admin/articles`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Request Body:**
```json
{
  "title": "New Article",
  "content": "This is the content of the new article."
}
```

**Response:**
```json
{
  "message": "Article created successfully.",
  "article": {
    "id": 2,
    "title": "New Article",
    "content": "This is the content of the new article."
  }
}
```

---

### Update Article (Admin)
**Endpoint:** `PUT /api/admin/articles/{id}`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Request Body:**
```json
{
  "title": "Updated Title",
  "content": "Updated content."
}
```

**Response:**
```json
{
  "message": "Article updated successfully."
}
```

---

### Delete Article (Admin)
**Endpoint:** `DELETE /api/admin/articles/{id}`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Response:**
```json
{
  "message": "Article deleted successfully."
}
```

---

## Writer Endpoints

### Writer Dashboard
**Endpoint:** `GET /api/writer/dashboard`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Response:**
```json
{
  "message": "Welcome, Writer!"
}
```

---

### Get All Articles (Writer)
**Endpoint:** `GET /api/writer/articles`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Response:**
```json
[
  {
    "id": 1,
    "title": "First Article",
    "content": "This is the content of the first article."
  }
]
```

---

### Create Article (Writer)
**Endpoint:** `POST /api/writer/articles`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Request Body:**
```json
{
  "title": "New Article",
  "content": "This is the content of the new article."
}
```

**Response:**
```json
{
  "message": "Article created successfully.",
  "article": {
    "id": 2,
    "title": "New Article",
    "content": "This is the content of the new article."
  }
}
```

---

### Update Article (Writer)
**Endpoint:** `PUT /api/writer/articles/{id}`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Request Body:**
```json
{
  "title": "Updated Title",
  "content": "Updated content."
}
```

**Response:**
```json
{
  "message": "Article updated successfully."
}
```

---

### Delete Article (Writer)
**Endpoint:** `DELETE /api/writer/articles/{id}`

**Headers:**
```
Authorization: Bearer your-access-token
```

**Response:**
```json
{
  "message": "Article deleted successfully."
}
```

---

## Notes
- All requests that require authentication must include the `Authorization: Bearer your-access-token` header.
- Admin can manage all articles, while writers can only manage their own.
- Roles available: `admin`, `penulis`, and `user`.
- The `role` middleware ensures only users with the correct roles can access certain endpoints.

---

## Author
- **Project Maintainer:** Your Name
- **Tech Stack:** Laravel, Sanctum for Authentication

