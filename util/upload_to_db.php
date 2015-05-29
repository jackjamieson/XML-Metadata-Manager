<?php
include("dbmanager.php");
$db = new dbmanager();
$db->connectToDatabase();
$conn = $db->getConnection();

$imgpath = $_POST['path'];


$imgpath = str_replace("\\", "\\\\", $imgpath);

$colid = $_POST['collectionId'];
$title = $_POST['title'];
$abstract = $_POST['abstract'];
$datatype = $_POST['datatype'];
$supp = $_POST['supp'];
$coords = $_POST['coords'];
$datasetref = $_POST['refdate'];

$alttitle = $_POST['alttitle'];
$altgeo = $_POST['altgeo'];
$onlineresource = $_POST['onlineresource'];
$browse = $_POST['browse'];
$coldate = $_POST['coldate'];
$extent =  $_POST['extent'];


$uploadDate = $_POST['upload'];
$owner = $_POST['owner'];

$actualPath = $_POST['actualSingle'];

$fullpath = $imgpath . '\\\\' . $actualPath;


if(strlen($uploadDate) < 1 || strlen($imgpath) < 1 || strlen($owner) < 1)
{
    ?>
    <script>
     parent.upload_failed();
    </script>
    <?php
    $conn->close();
}
else{

    $sql = "INSERT INTO xml (Path, CollectionID, Title, AlternateTitle, Abstract, DataType, Supplemental, Coordinates, AlternateGeometry, OnlineResource, BrowseGraphic, CollectionDate, DatasetReference, VerticalExtent, UploadDate, Owner)" .
            "VALUES ('$fullpath', '$colid', '$title', '$alttitle', '$abstract', '$datatype', '$supp', '$coords', '$altgeo', '$onlineresource', '$browse', '$coldate', '$datasetref', '$extent', '$uploadDate', '$owner')";
    //$result = $conn->query($sql);

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // $stmt = $conn->prepare("INSERT INTO XML (UploadDate, Owner) VALUES (:UploadDate, :Owner)");
    // //echo $stmt->error_list;
    // $stmt->bindParam(':UploadDate', $name);
    // $stmt->bindParam(':Owner', $value);
    //
    // // insert one row
    // $name = $_POST["upload"];
    // $value = $_POST["owner"];
    // $stmt->execute();

    $conn->close();
    ?>
    <script>
     parent.upload_completed();
    </script>
    <?php
}

?>
