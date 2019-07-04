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
        return mysqli_fetch_array($this->result, MYSQLI_NUM) or [];
    }

    public function isRecordExists($query)
    {
        $this->result = mysqli_query($this->link, $query);
        if (!mysqli_fetch_array($this->result, MYSQLI_NUM)){
            return false;
        } else {
            return true;
        }

    }

    public function simpleArray($query)
    {
        $this->result = mysqli_query($this->link, $query);
        while($row = mysqli_fetch_array($this->result, MYSQLI_NUM)) {
            array_push($arr,$row[0]);
        }
    }

    public function getLastInsert()
    {
        $this->result = mysqli_query($this->link, 'SELECT LAST_INSERT_ID() as LID');
        return mysqli_fetch_array($this->result, MYSQLI_NUM);
    }

}




$abc = new sqlClass();
print_r($abc->select("SELECT id, Title FROM movies1"));