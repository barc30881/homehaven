<?php

namespace Framework;

use PDO;
use PDOException;
use Exception;

class Database{
    public $conn;

    /**
     * Construct a database class
     * @param array $config
     */

    public function __construct($config){
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        $options =[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try{
            $this->conn = new PDO($dsn,$config["username"],$config["password"],$options);
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
        
        
    }   


    /**
     * Query the database
     * 
     * @param string $query
     * @param array $params
     * 
     * @return \PDOStatement
     * @throws PDOEXCEPTION
     */
    public function query($query,$params=[]){
          try{
            $sth = $this->conn->prepare($query);
            // Bind parameter names
            foreach($params as $param =>$value){
                $sth->bindValue(':'.$param,$value);
            }
            $sth->execute();
            return $sth;
          } catch(PDOException $e){
            throw new Exception("Query Failed to execute : {$e->getMessage()}");
          }
    }
}