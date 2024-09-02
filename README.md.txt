# Product Management System

## Overview

The Product Management System is a web application that allows users to manage products by adding, viewing, editing, and deleting product information. The system also includes user authentication, profile management, and robust security measures.

## DEMO 
# [Click here](http://alamiin.infinityfreeapp.com/productmanagement) 👈

## Features

### User Authentication
- **Login:** Users can log in using their username or email and password.
- **signup:** User can register using username email & password.
### Product Management
- **Add Product:** Users can add products with details such as name, price, and description.
- **View Products:** Users can view a list of all products they have added.
- **Edit Product:** Users can edit existing products via a modal popup with pre-filled form data.
- **Delete Product:** Users can delete products with a confirmation popup.

### Profile Management
- **View Profile:** Users can view their profile information, including username (read-only) and email.
- **Update Email:** Users can update their email address.
- **Change Password:** Users can securely change their password with validation checks.

### Modal Popups
- **Product Form:** A modal popup form is used for adding and editing products, with client-side validation.
- **Success Messages:** Success messages are displayed using modal popups after successful operations.

### Security and Validation
- **Password Security:** Passwords are securely hashed and verified.
- **Input Validation:** Client-side and server-side validation are implemented for all forms.

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/alamin-babu/productmanagment.git
   cd productmanagment
2. **Setup the database:**
     ```bash
     Create a Database named it 'product' then import the table from the /table directory from this repo.
     you may change the Database name, if you change the datbase name then consider to modify  the database connection details in config/database.php.
3. **Run the project:**
    ```bash
    Use a local server like XAMPP to host the project.
    Ensure that PHP and MySQL are running.
4. **Access the application:**
     ```bash
     Open your browser and navigate to http://localhost/productmanagment
     
##  Usage
* Login: Use the login page to sign in using your credentials.
* Add Product: Click on the "Add Product" button to open the modal popup and submit product details.
* View Products: Navigate to the "View Products" page to see the list of products you’ve added.
* Edit/Delete Product: Use the respective buttons in the product list to edit or delete a product.
* Profile Management: Visit the profile page to view or update your email and change your password.     

## Contributing
If you have suggestions or improvements, feel free to fork the repository and submit a pull request. Contributions are welcome!
     