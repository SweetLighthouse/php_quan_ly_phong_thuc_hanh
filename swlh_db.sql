CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `account_name` char(60) NOT NULL UNIQUE,
  `account_hashed_password` char(60) NOT NULL,
  `account_birth` date DEFAULT '0001-01-01',
  `account_full_name` char(60) DEFAULT NULL,
  `account_email` char(60) DEFAULT NULL,
  `account_position` char(60) DEFAULT NULL,
  `account_gender` char(30) DEFAULT NULL,
  `account_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `account_updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_token` char(64) DEFAULT NULL,
   PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` char(255) NOT NULL,
  `room_position` char(255) NOT NULL,
  `room_description` mediumtext NOT NULL,
  `room_availability` tinyint(1) NOT NULL DEFAULT 0,
  `room_owner_id` int(11) NOT NULL,
   PRIMARY KEY (`room_id`),
   FOREIGN KEY (`room_owner_id`) REFERENCES `accounts`(`account_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `computers` (
  `computer_id` int(11) NOT NULL,
  `computer_name` char(255) NOT NULL,
  `computer_ram` char(30) NOT NULL,
  `computer_cpu` char(30) NOT NULL,
  `computer_vga` char(30) NOT NULL,
  `computer_monitor` char(30) NOT NULL,
  `computer_note` char(255) NOT NULL,
  `computer_availability` tinyint(1) NOT NULL,
  `computer_room_id` int(11) NOT NULL,
  `computer_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `computer_updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`computer_id`),
  FOREIGN KEY (`computer_room_id`) REFERENCES `rooms`(`room_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `request_account_id` int(11) NOT NULL,
  `request_room_id` int(11) NOT NULL,
  `request_from_time` datetime NOT NULL,
  `request_to_time` datetime NOT NULL,
  `request_approved` tinyint(4) NOT NULL,
  `request_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `request_updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`request_id`),
  FOREIGN KEY (`request_account_id`) REFERENCES `accounts`(`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`request_room_id`) REFERENCES `rooms`(`room_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;