<?php
include("dbmanager.php");
$db = new dbmanager();
$db->connectToDatabase();
$conn = $db->getConnection();

$imgpath = $_POST['zippath'];
$imgpath = str_replace("\\", "\\\\", $imgpath);

$zipName = $_POST['actual'];

$total = $_POST['total'];
$zipID = uniqid();

$uploadDate = $_POST['zipdate'];
$owner = $_POST['zipuploader'];

$fullpath = $imgpath . '\\\\' . $zipName;


if(strlen($uploadDate) < 1 || strlen($imgpath) < 1 || strlen($owner) < 1 || strlen($zipName) < 1)
{
    ?>
    <script>
        parent.upload_failed2();
    </script>
    <?php
    $conn->close();
}

for($i = 1; $i <= $total; $i++){

    $colid = $_POST['collectionId' . $i];
    $title = $_POST['title'. $i];
    $abstract = $_POST['abstract'. $i];
    $datatype = $_POST['datatype'. $i];
    $supp = $_POST['supp'. $i];
    $coords = $_POST['coords'. $i];
    $datasetref = $_POST['refdate'. $i];

    $alttitle = $_POST['alttitle'. $i];
    $altgeo = $_POST['altgeo'. $i];
    $onlineresource = $_POST['onlineresource'. $i];
    $browse = $_POST['browse'. $i];
    $coldate = $_POST['coldate'. $i];
    $extent =  $_POST['extent'. $i];




    if(strlen($uploadDate) < 1 || strlen($imgpath) < 1 || strlen($owner) < 1)
    {
        ?>
        <script>
            parent.upload_failed2();
        </script>
        <?php
        $conn->close();
    }
    else{


        $sql = "INSERT INTO xml (Path, CollectionID, Title, AlternateTitle, Abstract, DataType, Supplemental, Coordinates, AlternateGeometry, OnlineResource, BrowseGraphic, CollectionDate, DatasetReference, VerticalExtent, UploadDate, Owner, zipID)" .
                "VALUES ('$fullpath', '$colid', '$title', '$alttitle', '$abstract', '$datatype', '$supp', '$coords', '$altgeo', '$onlineresource', '$browse', '$coldate', '$datasetref', '$extent', '$uploadDate', '$owner', '$zipID')";
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

        ?>
        <script>
         parent.upload_completed2();
        </script>
        <?php
    }



}

$conn->close();




?>
