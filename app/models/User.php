<?php
// show databases;
// use ppr;
// CREATE TABLE trlogic_users (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, username VARCHAR(20), email VARCHAR(200), psw VARCHAR(200), file VARCHAR(200), timestamp TIMESTAMP(6));
// ALTER TABLE `trlogic_users` ADD INDEX NEWINDEX (`email`);
// DESCRIBE trlogic_users;
// INSERT INTO trlogic_users (username, email, psw, file) VALUES ('Smith', 'mail', 'psw', 'file');
// SELECT * FROM trlogic_users;
// TRUNCATE TABLE trlogic_users;
class User
{
    const DB_HOST = "localhost";
    const DB_DATABASE = "ppr";
    const DB_USERNAME = "homestead";
    const DB_PASSWORD = "secret";
    const DB_TABLE = "trlogic_users";

    // const DB_HOST = "localhost";
    // const DB_DATABASE = "vlasikov";
    // const DB_USERNAME = "vlasikov";
    // const DB_PASSWORD = "Vlasikov1986";
    // const DB_TABLE = "trlogic_users";

    /**
     * Добавление записи в таблицу
     * @return boolean
     */
    public function add($data, $fileName) {
        $name = $data['name'];
        $email = $data['email'];
        $psw = md5($data['password']);
        $fileName = $fileName;

        $conn = $this->connectDB();

        // экранирование спец символов для безопасности
        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);

        $sql = "INSERT INTO ".self::DB_TABLE." (username, email, psw, file)
                VALUES ('".$name."', '".$email."', '".$psw."', '".$fileName."')";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    /**
     * Подсчет записей с заданными значениями
     * @param string fieeld
     * @param string name
     * @return int num_rows
     */
    public function count($field, $value) {
        $conn = $this->connectDB();
        $sql = "SELECT * FROM ".self::DB_TABLE." WHERE ".$field." LIKE '".$value."'";
        $result = $conn->query($sql);
        return $result->num_rows;
    }

    /**
     * Поиск записи по email
     * @param string email
     * @return int row
     */
    public function find($email) {
        $conn = $this->connectDB();
        $sql = "SELECT * FROM ".self::DB_TABLE." WHERE "."email"." LIKE '".$email."'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    /**
     * Подключение к ДБ
     * @return connect
     */
    private function connectDB() {
        // Create connection
        $conn = new mysqli(self::DB_HOST, self::DB_USERNAME, self::DB_PASSWORD, self::DB_DATABASE);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
