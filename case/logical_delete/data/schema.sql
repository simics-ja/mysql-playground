CREATE TABLE `baseline`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `message` VARCHAR(255) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- A client switch the visibility of data by is_deleted column
CREATE TABLE `flag_column`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `message` VARCHAR(255) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `is_deleted` BOOLEAN NOT NULL DEFAULT FALSE
);

-- A client switch the visibility of old data by timestamp_master table
CREATE TABLE `timestamp_master`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `delete_timestamp` DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `timestamp_slave`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `message` VARCHAR(255) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);