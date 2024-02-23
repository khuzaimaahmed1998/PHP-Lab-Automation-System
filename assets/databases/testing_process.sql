-- Create database testing_process
CREATE DATABASE testing_process;

-- Switch to the testing_process database
USE testing_process;

-- Create table product_categories
CREATE TABLE product_categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    category_name VARCHAR(100),
    description TEXT
);

-- Create table testing_process
CREATE TABLE testing_process (
    sno INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    product_code VARCHAR(10),
    product_id VARCHAR(50),
    product_name VARCHAR(100),
    product_description TEXT,
    product_price DECIMAL(10, 2),
    testing_id VARCHAR(12),
    testing_date DATE,
    testing_type VARCHAR(50),
    testing_result VARCHAR(50),
    remake_required BOOLEAN,
    next_testing_step VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    remarks TEXT,
    testing_duration VARCHAR(50),
    last_modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    modified_by VARCHAR(100),
    testing_revise VARCHAR(50),
    product_category VARCHAR(255),
    product_type VARCHAR(50),
    manufacturer VARCHAR(100),
    expiry_date DATE
);

-- Select all records from product_categories table
SELECT * FROM product_categories;

-- Select all records from testing_process table
SELECT * FROM testing_process;
