
-- Employee TABLE
CREATE TABLE IF NOT EXISTS employees (
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


-- clients TABLE 
CREATE TABLE IF NOT EXISTS clients (
    client_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_firstname VARCHAR(255) NOT NULL,
    client_lastname  VARCHAR(255) NOT NULL,
    client_email VARCHAR(255) NULL,

    employee_id INT UNSIGNED NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (employee_id) REFERENCES employees(employee_id)

);

-- countries TABLE 
CREATE TABLE IF NOT EXISTS countries (
    country_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    country_name VARCHAR(255) NOT NULL UNIQUE,
    country_code VARCHAR(5) NOT NULL UNIQUE
);

-- phones TABLE 
CREATE TABLE IF NOT EXISTS phones (

    phone_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    client_id INT UNSIGNED NOT NULL,
    country_id INT UNSIGNED NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    
    FOREIGN KEY (client_id) REFERENCES clients(client_id),
    FOREIGN KEY (country_id) REFERENCES countries(country_id)

);


-- regions TABLE 
CREATE TABLE IF NOT EXISTS regions (
    region_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    country_id INT UNSIGNED NOT NULL,
    region_name VARCHAR(255) NOT NULL UNIQUE,
    FOREIGN KEY (country_id) REFERENCES countries(country_id)
);

-- subregions TABLE 
CREATE TABLE IF NOT EXISTS subregions (
    subregion_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    region_id INT UNSIGNED NOT NULL,
    subregion_name VARCHAR(255) NOT NULL UNIQUE,
    FOREIGN KEY (region_id) REFERENCES regions(region_id)
);

-- cities TABLE 
CREATE TABLE IF NOT EXISTS cities (
    city_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subregion_id INT UNSIGNED NOT NULL,
    city_name VARCHAR(255) NOT NULL UNIQUE,
    FOREIGN KEY (subregion_id) REFERENCES subregions(subregion_id)
);

-- PaymentPlans TABLE
CREATE TABLE IF NOT EXISTS payment_plans (
    payment_plan_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    payment_plan_name VARCHAR(255) NOT NULL UNIQUE
);

-- currencies TABLE 
CREATE TABLE IF NOT EXISTS currencies (
    currency_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    currency_code VARCHAR(3) NOT NULL UNIQUE,
    currency_name VARCHAR(255) NOT NULL UNIQUE,
    currency_symbol VARCHAR(10) NOT NULL UNIQUE
);


-- Requests TABLE
CREATE TABLE IF NOT EXISTS requests (
    request_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    client_id INT UNSIGNED NOT NULL,
    city_id INT UNSIGNED NOT NULL,
    payment_plan_id INT UNSIGNED NOT NULL,
    currency_id INT UNSIGNED NOT NULL,

    employee_id INT UNSIGNED NOT NULL,
    agent_id INT UNSIGNED NULL,

    request_location TEXT,
    request_budget INT NOT NULL,
    request_state ENUM('pending', 'fulfilled', 'rejected', 'cancelled', 'on-hold', 'processing') NOT NULL DEFAULT 'pending',
    request_priority ENUM('low', 'medium', 'high') NOT NULL DEFAULT 'medium',
    
    comments TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,


    FOREIGN KEY (client_id) REFERENCES clients(client_id),
    FOREIGN KEY (city_id) REFERENCES cities(city_id),
    FOREIGN KEY (payment_plan_id) REFERENCES payment_plans(payment_plan_id),
    FOREIGN KEY (currency_id) REFERENCES currencies(currency_id),

    FOREIGN KEY (employee_id) REFERENCES employees(employee_id),
    FOREIGN KEY (agent_id) REFERENCES employees(employee_id)
);


-- LISTINGS

CREATE TABLE property_status (
    property_status_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    property_status_name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE property_type (
    property_type_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    property_type_name VARCHAR(255) NOT NULL UNIQUE
);


CREATE TABLE properties (
    property_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    
    client_id INT UNSIGNED NOT NULL,
    employee_id INT UNSIGNED NOT NULL,
    payment_plan_id INT UNSIGNED NOT NULL,
    currency_id INT UNSIGNED NOT NULL,

    city_id INT UNSIGNED NOT NULL,
    property_type_id INT UNSIGNED NOT NULL,
    property_status_id INT UNSIGNED NOT NULL,

    land_id INT UNSIGNED NULL,
    apartment_id INT UNSIGNED NULL, 

    -- FOREIGN KEYS WILL BE ADDED LATER IN THE FLOW

    property_location VARCHAR(255),
    property_referral_name VARCHAR(255),
    property_referral_phone VARCHAR(20),

    property_catch_phrase TEXT,

    property_size DECIMAL(10, 2),
    property_price DECIMAL(15, 2),
    


    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    

    FOREIGN KEY (client_id) REFERENCES clients(client_id),
    FOREIGN KEY (city_id) REFERENCES cities(city_id),
    FOREIGN KEY (payment_plan_id) REFERENCES payment_plans(payment_plan_id),
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id),
    FOREIGN KEY (property_type_id) REFERENCES property_type(property_type_id),
    FOREIGN KEY (property_status_id) REFERENCES property_status(property_status_id),
    FOREIGN KEY (currency_id) REFERENCES currencies(currency_id)
    
    -- FOREIGN KEY (land_id) REFERENCES land_details(land_id),
    -- FOREIGN KEY (apartment_id) REFERENCES apartment_details(apartment_id)
    -- THEY ARE ADDED LATER IN THE FLOW
);



CREATE TABLE land_details (
    land_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    property_id INT UNSIGNED NOT NULL UNIQUE,

    land_type ENUM('residential', 'industrial', 'commercial', 'agricultural', 'mixed', 'other') DEFAULT 'residential',
    land_zone_first DECIMAL(5, 2),
    land_zone_second DECIMAL(5, 2),
    land_extra_features TEXT,
    FOREIGN KEY (property_id) REFERENCES properties(property_id)
);

CREATE TABLE apartment_gender (
    apartment_gender_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    apartment_gender_name VARCHAR(255) NOT NULL
);


CREATE TABLE apartment_details (

    apartment_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    property_id INT UNSIGNED NOT NULL UNIQUE,

    ad_terrace BOOLEAN DEFAULT FALSE,
    ad_terrace_area INT DEFAULT 0,
    ad_roof BOOLEAN DEFAULT FALSE,
    ad_roof_area INT DEFAULT 0,

    ad_gender_id INT UNSIGNED NOT NULL,
    
    ad_furnished BOOLEAN DEFAULT FALSE,
    ad_furnished_on_provisions BOOLEAN DEFAULT FALSE,
    ad_elevator BOOLEAN DEFAULT FALSE,

    ad_status_age VARCHAR(255),
    ad_floor_level INT DEFAULT 0,
    ad_apartments_per_floor INT DEFAULT 1,
    ad_view VARCHAR(255),
    ad_type ENUM('luxury', 'high-end', 'standard', 'bad') DEFAULT 'standard',
    ad_architecture_and_interior TEXT,
    ad_extra_features TEXT,

    FOREIGN KEY (property_id) REFERENCES properties(property_id),
    FOREIGN KEY (ad_gender_id) REFERENCES  apartment_gender(apartment_gender_id)
);

ALTER TABLE properties ADD FOREIGN KEY (land_id) REFERENCES land_details(land_id);
ALTER TABLE properties ADD FOREIGN KEY (apartment_id) REFERENCES apartment_details(apartment_id);


CREATE TABLE apartment_partitions (
    partition_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    apartment_id INT UNSIGNED NOT NULL UNIQUE,

    partition_salon VARCHAR(255) DEFAULT '',
    partition_dining VARCHAR(255) DEFAULT '',
    partition_kitchen VARCHAR(255) DEFAULT '',
    partition_master_bedroom VARCHAR(255) DEFAULT '',
    partition_bedroom VARCHAR(255) DEFAULT '',
    partition_bathroom VARCHAR(255) DEFAULT '',
    partition_maid_room VARCHAR(255) DEFAULT '',
    partition_reception_balcony VARCHAR(255) DEFAULT '',
    partition_sitting_corner VARCHAR(255) DEFAULT '',
    partition_balconies VARCHAR(255) DEFAULT '',
    partition_parking VARCHAR(255) DEFAULT '',
    partition_storage_room VARCHAR(255) DEFAULT '',
    partition_extra_features TEXT DEFAULT '',

    FOREIGN KEY (apartment_id) REFERENCES apartment_details(apartment_id)
);

CREATE TABLE apartment_specifications (
    spec_id INT AUTO_INCREMENT PRIMARY KEY,

    apartment_id INT UNSIGNED NOT NULL UNIQUE,

    spec_heating_system BOOLEAN DEFAULT FALSE,
    spec_heating_system_on_provisions BOOLEAN DEFAULT FALSE,
    spec_ac_system BOOLEAN DEFAULT FALSE,
    spec_ac_system_on_provisions BOOLEAN DEFAULT FALSE,
    spec_double_wall BOOLEAN DEFAULT FALSE,
    spec_double_glazing BOOLEAN DEFAULT FALSE,
    spec_shutters_electrical BOOLEAN DEFAULT FALSE,
    spec_tiles ENUM('european', 'marble', 'granite', 'other') DEFAULT 'other',
    spec_oak_doors BOOLEAN DEFAULT FALSE,
    spec_chimney BOOLEAN DEFAULT FALSE,
    spec_indirect_light BOOLEAN DEFAULT FALSE,
    spec_wood_panel_decoration BOOLEAN DEFAULT FALSE,
    spec_stone_panel_decoration BOOLEAN DEFAULT FALSE,
    spec_security_door BOOLEAN DEFAULT FALSE,
    spec_alarm_system BOOLEAN DEFAULT FALSE,
    spec_solar_heater BOOLEAN DEFAULT FALSE,
    spec_intercom BOOLEAN DEFAULT FALSE,
    spec_garage BOOLEAN DEFAULT FALSE,
    spec_extra_features TEXT DEFAULT '',
    

    FOREIGN KEY (apartment_id) REFERENCES apartment_details(apartment_id)
);
