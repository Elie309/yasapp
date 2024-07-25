
-- Employee TABLE
CREATE TABLE IF NOT EXISTS Employees (
    employee_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    employee_name VARCHAR(100) NOT NULL UNIQUE,
    employee_email VARCHAR(255) NOT NULL UNIQUE,
    employee_phone VARCHAR(20) NOT NULL UNIQUE,

    employee_password VARCHAR(255) NOT NULL,
    employee_birthday DATE NULL,
    employee_address TEXT DEFAULT NULL,

    employee_role ENUM('admin', 'manager', 'user') NOT NULL DEFAULT 'user',
    employee_status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Users TABLE 
CREATE TABLE IF NOT EXISTS Users (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name  VARCHAR(255) NOT NULL
);

-- Countries TABLE 
CREATE TABLE IF NOT EXISTS Countries (
    country_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    country_name VARCHAR(255) NOT NULL UNIQUE,
    country_code VARCHAR(5) NOT NULL UNIQUE
);

-- Phones TABLE 
CREATE TABLE IF NOT EXISTS Phones (
    phone_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    country_id INT UNSIGNED NOT NULL,
    phone_number VARCHAR(20) NOT NULL UNIQUE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (country_id) REFERENCES Countries(country_id)
);


-- Regions TABLE 
CREATE TABLE IF NOT EXISTS Regions (
    region_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    country_id INT UNSIGNED NOT NULL,
    region_name VARCHAR(255) NOT NULL UNIQUE,
    FOREIGN KEY (country_id) REFERENCES Countries(country_id)
);

-- Subregions TABLE 
CREATE TABLE IF NOT EXISTS Subregions (
    subregion_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    region_id INT UNSIGNED NOT NULL,
    subregion_name VARCHAR(255) NOT NULL UNIQUE,
    FOREIGN KEY (region_id) REFERENCES Regions(region_id)
);

-- Cities TABLE 
CREATE TABLE IF NOT EXISTS Cities (
    city_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subregion_id INT UNSIGNED NOT NULL,
    city_name VARCHAR(255) NOT NULL UNIQUE,
    FOREIGN KEY (subregion_id) REFERENCES Subregions(subregion_id)
);


-- Locations TABLE 
CREATE TABLE IF NOT EXISTS Locations (
    location_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    city_id INT UNSIGNED NOT NULL,
    location_details TEXT DEFAULT NULL,
    FOREIGN KEY (city_id) REFERENCES Cities(city_id)

);


-- PaymentPlans TABLE
CREATE TABLE IF NOT EXISTS PaymentPlans (
    payment_plan_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    payment_plan_name VARCHAR(255) NOT NULL UNIQUE
);

-- Currencies TABLE 
CREATE TABLE IF NOT EXISTS Currencies (
    currency_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    currency_code VARCHAR(3) NOT NULL UNIQUE,
    currency_name VARCHAR(255) NOT NULL UNIQUE,
    currency_symbol VARCHAR(10) NOT NULL UNIQUE
);


-- Requests TABLE
CREATE TABLE IF NOT EXISTS Requests (
    request_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    user_id INT UNSIGNED NOT NULL,
    location_id INT UNSIGNED NOT NULL,
    payment_plan_id INT UNSIGNED NOT NULL,
    currency_id INT UNSIGNED NOT NULL,

    employee_id INT UNSIGNED NOT NULL,

    budget DECIMAL(10, 2) NOT NULL,
    
    comments TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,


    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (location_id) REFERENCES Locations(location_id),
    FOREIGN KEY (payment_plan_id) REFERENCES PaymentPlans(payment_plan_id),
    FOREIGN KEY (currency_id) REFERENCES Currencies(currency_id),

    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id)
);
