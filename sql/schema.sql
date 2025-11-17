CREATE DATABASE IF NOT EXISTS glitzers_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE glitzers_db;

-- Jobs table
CREATE TABLE IF NOT EXISTS jobs (
  jobRef VARCHAR(20) PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  description TEXT,
  location VARCHAR(100),
  datePosted DATE
);

-- EOI table
CREATE TABLE IF NOT EXISTS eoi (
  EOInumber INT AUTO_INCREMENT PRIMARY KEY,
  jobRef VARCHAR(20),
  firstName VARCHAR(20) NOT NULL,
  lastName VARCHAR(20) NOT NULL,
  dob DATE,
  gender ENUM('Male','Female','Other') DEFAULT 'Other',
  streetAddress VARCHAR(40),
  suburb VARCHAR(40),
  state ENUM('VIC','NSW','QLD','NT','WA','SA','TAS','ACT'),
  postcode CHAR(4),
  email VARCHAR(255),
  phone VARCHAR(20),
  skill1 VARCHAR(50),
  skill2 VARCHAR(50),
  skill3 VARCHAR(50),
  otherSkills TEXT,
  status ENUM('New','Current','Final') DEFAULT 'New',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (jobRef) REFERENCES jobs(jobRef) ON DELETE SET NULL
);

-- Managers table (for HR login)
CREATE TABLE IF NOT EXISTS managers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  failed_attempts INT DEFAULT 0,
  locked_until DATETIME DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
