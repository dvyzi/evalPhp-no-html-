-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 jan. 2024 à 12:03
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cooker`
--

-- --------------------------------------------------------

-- Création de la table user
CREATE TABLE users (
    user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(30) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL
);

-- Création de la table recipe
CREATE TABLE recipes (
    recipe_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    recipe_title VARCHAR(50) NOT NULL,
    recipe_instructions_ingredients TEXT,
    recipe_picture VARCHAR(500)
);

-- Création de la table comment
CREATE TABLE comments (
    comment_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    comment_content TEXT,
    recipe_id INT(6) UNSIGNED,
    user_id INT(6) UNSIGNED,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
