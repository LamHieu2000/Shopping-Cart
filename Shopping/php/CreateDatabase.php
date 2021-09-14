<?php

class CreateDatabase{
    // tao modun trong php co the su dung tren bat ki project project nao
    public $serverName;
    public $userName;
    public $passWord;
    public $databaseName;
    public $tableName;
    public $con;

    //class constructor - pp khoi tao
    public function __construct(
        $databaseName = "Newdb",
        $tableName = "Productdb",
        $serverName = "localhost",
        $userName = "root",
        $passWord = ""
    )
    {
        $this->databaseName = $databaseName;
        $this->tableName = $tableName;
        $this->serverName = $serverName;
        $this->userName = $userName;
        $this->passWord = $passWord;

        //tao ket noi - goi ket noi nay vao quyen so huu rieng
        $this->con = mysqli_connect($serverName, $userName, $passWord);//mo ra 1 ket noi moi toi may chu server

        //kiem tra ket noi toi server
        if(!$this->con){
            die("Connection failed: ".mysqli_connect_error());    
        }
         //truy van de tao csdl moi
         $sql = "CREATE DATABASE IF NOT EXISTS $databaseName";
        
         //thuc hien truy van
         if(mysqli_query($this->con, $sql)){
            
            $this->con = mysqli_connect($serverName, $userName, $passWord, $databaseName);
            // chi dinh may chu, root ten nguoi dung va mk
            //sql de tao 1 bang moi
            $sql = "CREATE TABLE IF NOT EXISTS $tableName
                (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                product_name VARCHAR(25) NOT NULL,
                product_price FLOAT,
                product_image VARCHAR(100)
                );";

            if(!mysqli_query($this->con, $sql)){
                echo "Error creating table: ".mysqli_error($this->con);
            }
            else{
                return false;
            }
         }
         
    } 
    // lay product tu database
    public function getData(){
         $sql = "SELECT *FROM $this->tableName";
         
         $result = mysqli_query($this->con, $sql);

         if(mysqli_num_rows($result) > 0){
             return $result;
         }
    }

}