-- KREIRANJE BAZE
DROP DATABASE kafic_123;
CREATE DATABASE kafic_123;

USE kafic_123;

-- KREIRANJE TABELA
-- tabela category
CREATE TABLE IF NOT EXISTS `kafic_123`.`category` (
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`name`))
ENGINE = InnoDB;

-- tabela product
CREATE TABLE IF NOT EXISTS `kafic_123`.`product` (
  `name` VARCHAR(45) NOT NULL,
  `category_name` VARCHAR(45) NOT NULL,
  `price` INT NOT NULL,
  `qty` INT NOT NULL,
  PRIMARY KEY (`name`),
  INDEX `fk_product_category_idx` (`category_name` ASC),
  CONSTRAINT `fk_product_category`
    FOREIGN KEY (`category_name`)
    REFERENCES `kafic_123`.`category` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- tabela admin
CREATE TABLE IF NOT EXISTS `kafic_123`.`admin` (
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`username`))
ENGINE = InnoDB;

-- tabela order
CREATE TABLE IF NOT EXISTS `kafic_123`.`order` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `customer` VARCHAR(45) NOT NULL,
  `product` VARCHAR(45) NOT NULL,
  `qty` INT NOT NULL,
  `amount` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- UNOS PODATAKA
-- Unos nekih kategorija (takodje, kategorije se mogu uneti i preko forme na sajtu)
INSERT INTO `kafic_123`.`category` (`name`) VALUES ('kafa');
INSERT INTO `kafic_123`.`category` (`name`) VALUES ('sok');
INSERT INTO `kafic_123`.`category` (`name`) VALUES ('voda');

-- Unos nekih proizovda (takodje, proizvodi se mogu uneti i preko forme na sajtu)
INSERT INTO `kafic_123`.`product` (`name`, `category_name`, `price`, `qty`) VALUES ('kafa1', 'kafa', '200', '100');
INSERT INTO `kafic_123`.`product` (`name`, `category_name`, `price`, `qty`) VALUES ('kafa2', 'kafa', '300', '100');
INSERT INTO `kafic_123`.`product` (`name`, `category_name`, `price`, `qty`) VALUES ('sok1', 'sok', '150', '100');
INSERT INTO `kafic_123`.`product` (`name`, `category_name`, `price`, `qty`) VALUES ('sok2', 'sok', '170', '100');
INSERT INTO `kafic_123`.`product` (`name`, `category_name`, `price`, `qty`) VALUES ('voda1', 'voda', '120', '100');
INSERT INTO `kafic_123`.`product` (`name`, `category_name`, `price`, `qty`) VALUES ('voda2', 'voda', '100', '100');

-- unos admina
INSERT INTO `kafic_123`.`admin` (`username`, `password`) VALUES ('admin', 'admin123');

-- UPITI
-- add_category.php
INSERT INTO category(`name`) VALUES ('$ime_kategorije');

-- admin.php
SELECT `name` FROM category;
SELECT `name`, `qty` FROM product;

-- dodaj_proizvod.php
SELECT * FROM category WHERE name='$category_name';
INSERT INTO product (name, category_name, price, qty) VALUES ('$product_name', '$category_name', '$price', '$qty');

-- izmena_kolicine.php
SELECT * FROM product WHERE `name`='$product';
UPDATE product SET qty='$quantity' WHERE `name`='$product';

-- logovanje.php
SELECT * FROM `admin` WHERE username='$ime_admina' AND password='$sifra_admina';

-- porudzbina.php
SELECT `name`, `price`, `qty` FROM product;

-- prikaz_porudzbina.php
SELECT * FROM `order`;

-- process_order.php
SELECT name FROM product WHERE name = '$product';
SELECT price FROM product WHERE name='$product';
SELECT * FROM product WHERE `name`='$product';
INSERT INTO `order` (customer, product, qty, amount) VALUES ('$customer', '$product', '$qty', '$amount');
UPDATE product SET qty = $nova_kolicina WHERE name = '$product';