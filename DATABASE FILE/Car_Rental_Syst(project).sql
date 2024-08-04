
--database creation
CREATE DATABASE `car_rental_syst`;

--cars table
CREATE TABLE `cars` (
  `car_model` varchar(50) NOT NULL,
  `car_year` INT NOT NULL,
  `car_nameplate` varchar(50) NOT NULL,
  `car_img` varchar(250) DEFAULT 'NA',
  `price` float NOT NULL , 
  `car_availability` varchar(10) NOT NULL,
  PRIMARY KEY(`car_nameplate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--sample data
INSERT INTO `cars` (`car_model`,`car_year`, `car_nameplate`, `car_img`,`price`,`car_availability`) VALUES
('Audi A4',2024 ,'GA3KA6969', 'assets/img/cars/audi-a4.jpg', 2600, 'yes')

--admin table
CREATE TABLE `clients` (
  `client_username` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_phone` varchar(15) NOT NULL,
  `client_email` varchar(25) NOT NULL UNIQUE,
  `client_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `client_password` varchar(20) NOT NULL,
  PRIMARY KEY (`client_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `clients` (`client_username`, `client_name`, `client_phone`, `client_email`, `client_address`, `client_password`) VALUES
('harry', 'Harry Den', '9876543210', 'harryden@gmail.com', '2477  Harley Vincent Drive', 'password'),
('jenny', 'Jeniffer Washington', '7850000069', 'washjeni@gmail.com', '4139  Mesa Drive', 'jenny'),
('tom', 'Tommy Doee', '900696969', 'tom@gmail.com', '4645  Dawson Drive', 'password');


--customers table
CREATE TABLE `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(25) NOT NULL UNIQUE,
  `customer_address` varchar(50) NOT NULL,
  `customer_password` varchar(20) NOT NULL,
  PRIMARY KEY (`customer_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `customers` (`customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`) VALUES
('antonio', 'Zark', '0785556580', 'antony@gmail.com', '2677  Burton Avenue', 'password'),
('christine', 'Christine', '8544444444', 'chr@gmail.com', '3701  Fairway Drive', 'password'),
('ethan', 'Ethan Hawk', '69741111110', 'thisisethan@gmail.com', '4554  Rowes Lane', 'password'),
('james', 'James Washington', '0258786969', 'james@gmail.com', '2316  Mayo Street', 'password'),
('lucas', 'Lucas Rhoades', '7003658500', 'lucas@gmail.com', '2737  Fowler Avenue', 'password'),
('steve', 'Steve', '1234567890', 'steve@mail.com', 'Address', 'password');


--office table 
CREATE TABLE `offices` (
  `office_id` INT AUTO_INCREMENT ,
  `location` varchar(250) NOT NULL,
  `phone_num` INT NOT NULL ,
  PRIMARY KEY (`office_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--Reservation table 
CREATE TABLE `reservation` (
  `res_id` INT NOT NULL AUTO_INCREMENT,
  `total_payment` FLOAT NOT NULL,
  `start-date` DATE NOT NULL,
  `end-date` DATE NOT NULL,
  `return_date` DATE DEFAULT NULL,
  `no. of days` INT ,
  `car_nameplate` varchar(50) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `office_id` INT,
  PRIMARY KEY (`res_id`) ,
  FOREIGN KEY (`car_nameplate`) REFERENCES `cars`(`car_nameplate`) ,
  FOREIGN KEY (`customer_username`) REFERENCES `customers`(`customer_username`),
  FOREIGN KEY (`office_id`) REFERENCES `offices`(`office_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

