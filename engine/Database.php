<?php

class Database extends PDO {

    private $server = "localhost";
    private $dbname = "shop";
    private $username = "shop";
    private $passwd = "Pass12@@";
    private static Database $instance;

    private function __construct(){
        $dsn="mysql:host=$this->server;dbname=$this->dbname";
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES=>true
        ];
        parent::__construct( $dsn,$this->username, $this->passwd, $options);
    }

    private function __clone(){}

    public static function connect(){
        if (empty(self::$isntance)){
            try{
                self::$instance=new Database;
            }catch (PDOException $e){
                die($e->getMessage());
            }
        }
        return self::$instance;
    }

    public function insert($table , $values):array{
        $columns = "";
        $masks="";
        $params=[];
        $result=[];
        foreach ($values as $key => $value) {
            $columns.=($columns?",":"").$key;
            $masks.= ($masks?",":"").":$key";
            $params[":$key"]=$value;
            $result[$key]=$value;
        }
        $query = "INSERT INTO $table ($columns) VALUES ($masks)";
//        print_r($params);
//        die($query);
        try {
            $stmt = $this->prepare($query);
            $stmt->execute($values);
            $result=$values;
            $result["id"]=$this->lastInsertId();
        } catch (PDOException $e){
            $result=["error"=>$e->getMessage()];
        }
        return $result;
    }

    public function update($table , $values):array{
        $sets = "";
        $params=[];
        $result=[];
        foreach ($values as $key => $value) {
            $sets.=($sets?",":"")."$key=:$key";
            $params[":$key"]=$value;
            $result[$key]=$value;
        }
        $query = "UPDATE $table SET $sets WHERE id=:id";
        try {
            $stmt = $this->prepare($query);
            $stmt->execute($values);
            if($stmt->rowCount()) return $result;
        } catch (PDOException $e){
            return ["error"=>$e->getMessage()];
        }
        return ["error"=>"Что-то пошло не так"];
    }

    public function delete($table, $id):array {
        $query = "DELETE FROM $table WHERE id=:id";
        try {
            $stmt = $this->prepare($query);
            if($stmt->execute([":id"=>$id])) return ["id"=>$id];
        } catch (PDOException $e){
            return ["error"=>$e->getMessage()];
        }
        return ["error"=>"Что-то пошло не так"];
    }

    //$where=["id"=>5,....] $limit="5" или $limit="4,5" $order="id ASC"
    public function select($table,$where,$startId="0",$limit="1",$order=""):array{
        $whereStr="";
        $whereParams=[];
        foreach ($where as $key => $value) {
            $whereStr.=($whereStr?" AND ":"WHERE ")."$key=:$key";
            $whereParams[":$key"]=$value;
        }
        if (!$whereStr){
            $whereStr=" WHERE id>:id";
            $whereParams[":id"]=$startId;
        }
        $query="SELECT * FROM $table $whereStr";
        if ($order) $query.=" ORDER BY $order";
        $query.=" LIMIT $limit";
        try {
            $stmt = $this->prepare($query);
            if($stmt->execute($whereParams)) return $stmt->fetchAll();
        } catch (PDOException $e){
            return ["error"=>$e->getMessage()];
        }
        return ["error"=>"Что-то пошло не так"];
    }
    public function selectQuery($query,$where=[]){
        $whereStr="";
        $whereParams=[];
        foreach ($where as $key => $value) {
            $whereStr.=($whereStr?" AND ":" WHERE ")."$key=:$key";
            $whereParams[":$key"]=$value;
        }
        try {
            $stmt = $this->prepare($query.$whereStr);
            if($stmt->execute($whereParams)) return $stmt->fetchAll();
        } catch (PDOException $e){
            return ["error"=>$e->getMessage()];
        }
        return ["error"=>"Что-то пошло не так"];
    }
}

