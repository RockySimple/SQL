<?php

class sqlClass
{
    private $link;
    private $result;


    public function __construct($host = "localhost", $username = "root",
                                $passwrd = "", $dbname = "project1db")
    {
        $this->link = mysqli_connect($host, $username, $passwrd, $dbname);
        if (!$this->link) {
            die('Ошибка соединения: ' . mysqli_error($this->link));
        }
    }

    public function select($query)
    {
        $this->result = mysqli_query($this->link, $query);
        $arr = [];
        while($row = mysqli_fetch_array($this->result, MYSQLI_NUM)) {
            array_push($arr,$row);
        }
        return $arr;
    }

    public function selectOne($query)
    {
        $this->result = mysqli_query($this->link, $query);
        $fetch = mysqli_fetch_array($this->result, MYSQLI_NUM);
        return $fetch ? $fetch : [];
//        if($fetch){
//            return $fetch;
//        } else {
//            return [];
//        }
    }

    public function isThereRecord($query)
    {
        $this->result = mysqli_query($this->link, $query);
        $fetch = mysqli_fetch_array($this->result, MYSQLI_NUM);
        return $fetch ? 'true' : 'false';
    }

    public function simpleArray($query)
    {
        $arr =  [];
        $this->result = mysqli_query($this->link, $query);
        while($row = mysqli_fetch_array($this->result, MYSQLI_NUM)) {
            array_push($arr,$row[0]);
        }
        return $arr;
    }

    public function getLastInsert()
    {
        $this->result = mysqli_query($this->link, 'SELECT LAST_INSERT_ID()');
        $arr = mysqli_fetch_array($this->result, MYSQLI_NUM);
        return $arr[0];
    }

    public function query($table, $column, $values)
    {
        $query = "INSERT INTO $table($column) VALUES ($values)";
        print_r($query);
        $this->result = mysqli_query($this->link, $query);
    }
}

$abc = new sqlClass();

//print_r($abc->select("SELECT id FROM movies1"));
//echo PHP_EOL;

//print_r($abc->selectOne('SELECT id, Title FROM movies1 WHERE id = 2'));
//echo PHP_EOL;

//print_r($abc->isThereRecord("SELECT id, Title FROM movies1 WHERE id=11"));
//echo PHP_EOL;

//print_r($abc->simpleArray("SELECT id FROM movies1"));
//echo PHP_EOL;

print_r($abc->query('movies1', 'Title',"'Kukus'"));
echo PHP_EOL;

print_r($abc->getLastInsert());

