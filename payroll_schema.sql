-- Create the database
CREATE DATABASE hr_payroll;
USE hr_payroll;

-- Create the employees table
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    department VARCHAR(100) NOT NULL
);

-- Create the payroll table
CREATE TABLE payroll (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

-- Create the tax table
CREATE TABLE tax (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    tax_amount DECIMAL(10, 2) NOT NULL,
    tax_date DATE NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

-- Create the claims table
CREATE TABLE claims (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    claim_type VARCHAR(100) NOT NULL,
    claim_amount DECIMAL(10, 2) NOT NULL,
    claim_date DATE NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

-- Create the departments table
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- Add a foreign key to the employees table for the department
ALTER TABLE employees ADD CONSTRAINT fk_department FOREIGN KEY (department) REFERENCES departments(name);