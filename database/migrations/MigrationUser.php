<?php
namespace migrations;

use PDO;

 require '../../config.php';

class MigrationUser
{
    public function up()
    {
        $sql = "
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        );
        ";

        // Execute the SQL for creating the table
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->exec($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE users;";

        // Execute the SQL for reverting the migration

        // Replace this with your actual database connection
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->exec($sql);
    }
}

$migration = new MigrationUser();
$migration->up();


