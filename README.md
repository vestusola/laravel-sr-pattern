# Laravel Service and Repository Pattern
Register user and create post using the Laravel Service and Repository Pattern.

## How to use
1. $ git clone https://github.com/vestusola/laravel-sr-pattern.git
2. $ cd laravel-sr-pattern
3. $ composer install
4. $ php artisan key:generate
5. $ php artisan migrate
6. $ php artisan serve
7. Test on postman

## Endpoints
### Auth Endpoints
| **Name**              | **Url**               | **Method**     | **Data/Params**                          |
|-----------------------|-----------------------|----------------|------------------------------------------|
| register              | /api/register         | POST           |     name,email,password,confirm_password |
| login                 | /api/login            | POST           |     email,password                       |

### User Endpoints
| **Name**              | **Url**               | **Method**     | **Data/Params**     | **Header**     |
|-----------------------|-----------------------|----------------|---------------------|----------------|
| profile               | /api/user/profile     | GET            |                     | Authorization  |

### Post Endpoints
| **Name**                | **Url**                 | **Method**     | **Data/Params**         | **Header**     |
|-------------------------|-------------------------|----------------|-------------------------|----------------|
| Fetch all posts         | /api/user/posts         | GET            |                         | Authorization  |
| Add new post            | /api/user/posts         | POST           |     title, description  | Authorization  |
| View post details       | /api/user/posts/{id}    | GET            |                         | Authorization  |
| Update post details     | /api/user/posts/{id}    | PUT/PATCH      |     title, description  | Authorization  |
| Delete post             | /api/user/posts/{id}    | DELETE         |                         | Authorization  |