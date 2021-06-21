<?php
class CreateDb
{
        public $servername;
        public $username;
        public $password;
        public $dbname;
        public $tablename;
        public $con;
        // class constructor
    public function __construct(
        $dbname = "3855137_hyu1",
        $tablename = "producttb",
        $servername = "fdb22.awardspace.net",
        $username = "3855137_hyu1",
        $password = "huypr113"
    )
    {
      $this->dbname = $dbname;
      $this->tablename = $tablename;
      $this->servername = $servername;
      $this->username = $username;
      $this->password = $password;

      // create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // Check connection
        if (!$this->con){
            die("Connection failed : " . mysqli_connect_error());
        }

        // query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // execute query
        if(mysqli_query($this->con, $sql)){

            $this->con = mysqli_connect($servername, $username, $password, $dbname);

        }else{
            return false;
        }
    }

    // get product from the database
    public function getData(){
        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
}






