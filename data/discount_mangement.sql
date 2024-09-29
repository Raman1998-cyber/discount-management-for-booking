CREATE TABLE discounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    type ENUM('fixed', 'percentage'),
    value DECIMAL(10, 2),
    max_uses INT,
    max_discount DECIMAL(10, 2),
    recurring BOOLEAN,
    family_member BOOLEAN,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    schedule_id INT,
    booking_date DATE,
    total_cost DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);


CREATE TABLE user_families (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    family_member_id BIGINT UNSIGNED,
    relationship VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (family_member_id) REFERENCES users(id)
);


/*Run the following Artisan commands to create migration files for user_families, bookings, and discounts tables:
php artisan make:migration create_user_families_table
php artisan make:migration create_bookings_table
php artisan make:migration create_discounts_table


php artisan make:model Booking
php artisan make:model Discount
php artisan make:model User */


