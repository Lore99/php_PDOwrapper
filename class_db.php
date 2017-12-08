<?php
/*
Copyright 2017 Lorenzo Boldorini
The class for php My_db is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
The class for php My_db is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Affero General Public License for more details.
You should have received a copy of the GNU General Public License along with This file.
If not, see <http://www.gnu.org/licenses/>.
*/

class My_db{
    private $connection;
    private $host='';
    private $dbname='';
    private $user='';
    private $password='';
    private $prep_statement;
    private $query_statement;
    private $fetch_return_array;
    
    function __construct(){
        $this->connection = new PDO ("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
        $this->connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    
    public function getFetchReturn(){
        return $this->fetch_return_array;
    }
    
//  PDO FUNCTIONS WRAPPER  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function exec_query($sql){
        //	$nw = $dbh->query($sql);
        $this->query_statement = $this->connection->query($sql);
    }
    
    public function exec($sql){
        $this->connection->exec($sql);       
    }
	
    public function prepare($sql){
        $this->prep_statement = $this->connection->prepare($sql);       
    }
    
    public function bindParameter($parameterName, $parameterValue)/*parameterName has to be a string like ":id  :value  :param"*/{
        $this->prep_statement->bindParam($parameterName, $parameterValue);
    }
    
    public function executePrepareStm($array = 0)/*array has to be like the bindParameter { :parameterName => $parameterValue }*/{
        if($array == 0) $this->prep_statement->execute();
        else $this->prep_statement->execute($array);
    }
    
    public function fetchAll(){
        $this->fetch_return_array = $this->query_statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
?>