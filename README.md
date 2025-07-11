# 🛍️ E-Commerce REST API (Laravel)  

A fully functional e-commerce backend built with Laravel, featuring JWT authentication, product management, cart system, orders, and user roles.  

## ✨ Features  

- **🔐 Secure Authentication**  
  - JWT-based login/register system 

- **🛒 Product Management**  
  - Full CRUD operations for products  
  - Product categories and tags  

- **📦 Order System**  
  - Complete checkout process  
  - Order history tracking  

- **👥 User Management**  
  - Role-based access control (Admin/Customer)  
  - User profile management  

## 🚀 Quick Setup  
- **Prerequisites**  
  - PHP 8.1+  
  - Composer
  - MySQL 8.0+
  - Laravel 10.x
 
  
**Installation**
1. Clone the repository
   ```bash
   git clone https://github.com/sahadat96/laravel-e-commerce-backend.git
   cd laravel-e-commerce-backend
   ```
   
2. Install dependencies
   ```bash
   composer install
   ```
   
3. Configure .env (Copy from .env.example)
   ```bash
   cp .env.example .env
   ```
   
4. Fill in the environment variables in `.env`
   ```bash
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password
   JWT_SECRET=generate_with_php_artisan_jwt:secret 
   ```
   
5. Generate keys & migrate
   ```bash
   php artisan key:generate
   php artisan jwt:secret
   php artisan migrate --seed
   ```

6. Start the development server
   ```bash
   php artisan serve
   ```

## 📚 API Endpoints

### Products
| Feature          | Endpoint          | Method | Auth Required |
|------------------|-------------------|--------|---------------|
| List Products    | `/api/getallproducts`   | GET    | No            
| Product Details  | `/api/getproductdetails` | GET | No        |

### Cart
| Feature          | Endpoint          | Method | Auth Required |
|------------------|-------------------|--------|---------------|
| Add to Cart      | `/api/addtocart`   | POST   | Yes |
| View Cart        | `/api/getcart`       | GET    | Yes |
| Remove from Cart | `/api/cartdelete/{cartId}`  | DELETE | Yes |

### Orders
| Feature          | Endpoint                 | Method | Auth Required |
|------------------|--------------------------|--------|---------------|
| Order History    | `/api/get_order`            | GET    | Yes |
| Order Details    | `/api/getOrderDetails/{id}`  | GET    | Yes |

### Authentication
| Feature          | Endpoint          | Method | Auth Required |
|------------------|-------------------|--------|---------------|
| Register         | `/api/userregistration` | POST | No          |
| Login            | `/api/userlogin` | POST    | No            |
| Logout           | `/api/logout` | POST   | Yes           |


