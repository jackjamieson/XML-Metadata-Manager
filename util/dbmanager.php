<?php

class dbmanager{

    private $database; // the connection to pass around

    function __construct(){
    }

    public function connectToDatabase()
	{

        $servername = "127.0.0.1"; // the ip where the db is hosted, localhost at the moment
        $username = "root";
        $password = "rootpwd";
        $dbname = "xml_info_schema"; // schema name

		//Create connection
		$this->database = new mysqli($servername, $username, $password, $dbname);

		//Check connection
		if($this->database->connect_error)
			return FALSE;
		else
			return TRUE;
	}

    function getConnection(){
        return $this->database;
    }

    function listAll(){

        $sql = "SELECT * FROM XML ORDER BY `UploadDate` DESC";
        return $sql;

    }

    function byUploader($val){


        $val = $this->database->real_escape_string($val);

        $sql = "SELECT * FROM `xml` WHERE `Owner` LIKE '$val%' ORDER BY `Owner` ASC ";

        return $sql;

    }

    function byTitle($val){

        $val = $this->database->real_escape_string($val);

        $sql = "SELECT * FROM `xml` WHERE `Title` LIKE '%$val%' ORDER BY `Title` ASC ";

        return $sql;



    }

    function byDate($val){

        $val = $this->database->real_escape_string($val);

        $sql = "SELECT * FROM `xml` WHERE `UploadDate` BETWEEN '$val-01' AND '$val-31' ORDER BY `UploadDate` DESC ";

        return $sql;


    }

    function byYear($val){

        $val = $this->database->real_escape_string($val);

        $sql = "SELECT * FROM `xml` WHERE `UploadDate` LIKE '%$val%' ORDER BY `UploadDate` DESC";

        return $sql;

    }

    function byRange($from, $to){

        $from = $this->database->real_escape_string($from);
        $to = $this->database->real_escape_string($to);

        $sql = "SELECT * FROM `xml` WHERE `UploadDate` BETWEEN '$from-01' AND '$to-31' ORDER BY `UploadDate` DESC";

        return $sql;


    }

    function byAbstract($val){

        $val = $this->database->real_escape_string($val);

        $sql = "SELECT * FROM `xml` WHERE `Abstract` LIKE '%$val%' ORDER BY `UploadDate` DESC";

        return $sql;


    }

    function byCollectionID($val){

        $val = $this->database->real_escape_string($val);

        $sql = "SELECT * FROM `xml` WHERE `CollectionID` = '$val' ORDER BY `UploadDate` DESC";

        return $sql;


    }

}

?>
