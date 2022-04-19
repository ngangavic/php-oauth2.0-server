<?php
/***
 * Created by ngangavic on 25/03/2022
 ***/

 session_start();
 $_SESSION['auth']="signup";

class Database{	
	
    private $connection = null;

    // this function is called everytime this class is instantiated		
    public function __construct( $dbhost = "localhost", $dbname = "oath", $username = "oath", $password    = "oath"){

        try{
        
            $this->connection = new PDO("mysql:host={$dbhost};dbname={$dbname};", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }			
        
    }
    
    // Insert a row/s in a Database Table
    public function Insert( $statement = "" , $parameters = [] ){
        try{
            
            $this->executeStatement( $statement , $parameters );
            return $this->connection->lastInsertId();
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }

    // Select a row/s in a Database Table
    public function Select( $statement = "" , $parameters = [] ){
        try{
            
            $stmt = $this->executeStatement( $statement , $parameters );
            return $stmt->fetchAll();
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }
    
    // Update a row/s in a Database Table
    public function Update( $statement = "" , $parameters = [] ){
        try{
            
            $this->executeStatement( $statement , $parameters );
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }		
    
    // Remove a row/s in a Database Table
    public function Remove( $statement = "" , $parameters = [] ){
        try{
            
            $this->executeStatement( $statement , $parameters );
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }		
    
    // execute statement
    private function executeStatement( $statement = "" , $parameters = [] ){
        try{
        
            $stmt = $this->connection->prepare($statement);
            $stmt->execute($parameters);
            return $stmt;
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }
    
}