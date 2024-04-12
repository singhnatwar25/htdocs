CREATE TABLE adminuser (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    last_login DATETIME, 
    /* Any other columns you may need, e.g., name, role, etc. */
);
