## Help

- ER Diagram is above as file "ER-Diagram.png"
- MySQL queries are necessary for this project are on file "MySQL-quary.txt"


## MySQL Databse 
```sql [language=sql]
CREATE DATABASE online-bookstore;
```

## Database Tables

### Users Table

```sql [language=sql]

CREATE TABLE users (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  full_name VARCHAR(255),
  address VARCHAR(255),
  phone_number VARCHAR(20)
);
```


### Books table

```sql [language=sql]
CREATE TABLE books (
  book_id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(255) NOT NULL,
  description TEXT,
  image LONGBLOB,
  publication_date DATE,
  price DECIMAL(10, 2) NOT NULL,
  quantity INT NOT NULL
);
```


### Table for: Cart

```sql [language=sql]
CREATE TABLE cart (
  cart_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  quantity INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (book_id) REFERENCES books(book_id)
);
```

### Table for: Orders

```sql [language=sql]
CREATE TABLE orders (
  order_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  order_date DATETIME NOT NULL,
  total_amount DECIMAL(10, 2),
  status ENUM('Pending', 'Processing', 'Shipped', 'Delivered') DEFAULT 'Pending',
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);
```

### Table for: Categories

```sql [language=sql]
CREATE TABLE categories (
  category_id INT PRIMARY KEY AUTO_INCREMENT,
  category_name VARCHAR(255) NOT NULL,
  description TEXT
);
```

### Table for: Order Details

```sql [language=sql]
CREATE TABLE order_details (
  order_detail_id INT PRIMARY KEY AUTO_INCREMENT,
  order_id INT NOT NULL,
  book_id INT NOT NULL,
  quantity INT,
  price DECIMAL(10, 2),
  FOREIGN KEY (order_id) REFERENCES orders(order_id),
  FOREIGN KEY (book_id) REFERENCES books(book_id)
);
```

### Table for: wishlist 

```sql [language=sql]
CREATE TABLE wishlist (
  wishlist_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (book_id) REFERENCES books(book_id)
);
```