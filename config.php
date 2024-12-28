<?php
class Database {
    private $servername;
    private $username;
    private $password;
    private $dbName;
    private $conn;

    public function __construct($servername, $username, $password, $dbName) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->connect();
    }

    private function connect() {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully<br>";

        $this->createDatabase();
        $this->selectDatabase();
        $this->createTable();
    }
private function createDatabase() {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->dbName";
        if (mysqli_query($this->conn, $sql)) {
            echo "Database created successfully.<br>";
        } else {
            die("Error creating database: " . mysqli_error($this->conn));
        }
    }

    private function selectDatabase() {
        mysqli_select_db($this->conn, $this->dbName);
    }

    private function createTable() {
        $query = " CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) UNIQUE NOT NULL,
            firstname VARCHAR(50) NOT NULL,
            lastname VARCHAR(50) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        if (mysqli_query($this->conn, $query)) {
            echo "Table users created successfully.<br>";
        } else {
            die("Error creating table: " . mysqli_error($this->conn));
        }
   
        $query = "CREATE TABLE IF NOT EXISTS cars (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            image VARCHAR(255) NOT NULL,
            model VARCHAR(100) NOT NULL,
            transmission VARCHAR(100) NOT NULL,
            architecture VARCHAR(100) NOT NULL,
            drive_type VARCHAR(100) NOT NULL,
            fuel_type VARCHAR(50) NOT NULL,
            engine_capacity VARCHAR(50) NOT NULL,
            rent_link VARCHAR(255) NOT NULL
        )";

        if (mysqli_query($this->conn, $query)) {
            echo "Table cars created successfully.<br>";
        } else {
            die("Error creating table: " . mysqli_error($this->conn));
        }
        $query = "CREATE TABLE IF NOT EXISTS payments (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            card_number VARCHAR(16) NOT NULL,
            expiry_date VARCHAR(5) NOT NULL,
            cvv VARCHAR(3) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if (mysqli_query($this->conn, $query)) {
            echo "Table payments created successfully.<br>";
        } else {
            die("Error creating payments table: " . mysqli_error($this->conn));
        }
        $query = "CREATE TABLE IF NOT EXISTS rentals (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            car VARCHAR(255) NOT NULL,
            duration INT NOT NULL,
            price_per_day DECIMAL(10, 2) NOT NULL,
            total DECIMAL(10, 2) NOT NULL,
            rental_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if (mysqli_query($this->conn, $query)) {
            echo "Table rentals created successfully.<br>";
        } else {
            die("Error creating rentals table: " . mysqli_error($this->conn));
        }
    }
    public function insertUser($nom, $prenom, $email, $password) {
        $stmt = $this->conn->prepare("INSERT INTO users (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nom, $prenom, $email, $password);

        if ($stmt->execute()) {
            echo "Nouvel utilisateur ajouté avec succès.<br>";
        } else {
            die("Erreur lors de l'ajout de l'utilisateur: " . $stmt->error);
        }

        $stmt->close();
    }



    public function __destruct() {
        mysqli_close($this->conn);
    }
}

// Utilisation de la classe
$db = new Database("localhost", "root", "", "CARS");

    
?>