<?php
include("dbmanager.php");
$db = new dbmanager();
$db->connectToDatabase();
$conn = $db->getConnection();


if(isset($_GET['id'])){



        $query = $_GET["id"];

        $sql = "DELETE FROM XML WHERE xml_id = $query";

        $result = $conn->query($sql);

        $conn->close();



}
if(isset($_GET['query'])){
$query = $_GET['query'];
}
$val = '';
if(isset($_GET['val'])){
$val = $_GET['val'];
}

header("Location: ../search.php?query=$query&val=$val");// send the user back to where they came from
die();

?>
