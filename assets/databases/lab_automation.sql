-- Create database lab_automation
CREATE DATABASE lab_automation;

-- Switch to the lab_automation database
USE lab_automation;

-- Create table user_info
CREATE TABLE user_info (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    First_Name VARCHAR(50),
    Last_Name VARCHAR(50),
    Email VARCHAR(100) UNIQUE,
    Password VARCHAR(100),
    Contact VARCHAR(20),
    Role VARCHAR(50) DEFAULT 'User'
);

-- Select all records from user_info table
SELECT * FROM user_info;

