<?php
include("dbmanager.php");
$db = new dbmanager();
$db->connectToDatabase();
$conn = $db->getConnection();

if(isset($_GET['id'])){

    $zip = new ZipArchive();
    $filename = "metadata.zip";

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit("cannot open <$filename>\n");
    }


    $query = $_GET["id"];

        $sql = "SELECT * FROM XML WHERE zipID = '$query'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {


                $altTitle = '<title>' .$row["AlternateTitle"] . '</title>';
                $altGeo = $row["AlternateGeometry"];
                $oR = '<resourceURL>' . $row["OnlineResource"] . '</resourceURL>';
                $bG = '<resourceURL>' . $row["BrowseGraphic"]  . '</resourceURL>';
                $coll = '<date>' . $row["CollectionDate"] . '</date>';
                $vert = $row["VerticalExtent"];
                $data = $row["DataType"];
                $dataOut = "";

                $dataArr = explode(', ', $data);


                for($i = 0; $i < count($dataArr) - 1; $i++){
                    $dataOut .= "\n\t<dataType>" . $dataArr[$i] . "</dataType>";
                }
                $dataOut .= "\n";

                // fix the undefined variables
                if($row["AlternateTitle"] == "undefined")
                {
                    $altTitle = "";
                }
                if($altGeo == "undefined")
                {
                    $altGeo = "";
                }
                if($row["OnlineResource"] == "")
                {
                    $oR = "";
                }
                if($row["BrowseGraphic"] == "")
                {
                    $bG = "";
                }
                if($row["CollectionDate"] == "0000-00-00")
                {
                    $coll = "";
                }
                if($vert == "undefined")
                {
                    $vert = "";
                }


                // generate the xml file
$xmlOut =
'<?xml version="1.0" encoding="UTF-8"?>
<sample>
    <collectionID>' .$row["CollectionID"] . '</collectionID>
    <title>' . $row["Title"] . '</title>
    <alternateTitle>'
        . $altTitle .
    '</alternateTitle>
    <abstract>' . $row["Abstract"] . '</abstract>' .
    $dataOut .
    '<supplementalInformation>
        <info>' . $row["Supplemental"] . '</info>
    </supplementalInformation>
    <coordinates>' . $row["Coordinates"] . '</coordinates>
    <alternateGeometry>' . $altGeo . '</alternateGeometry>
    <onlineResource>'
        . $oR .
    '</onlineResource>
    <browseGraphic>'
        . $bG .
    '</browseGraphic>
    <dates>'
        . $coll .
    '</dates>
    <datasetReferenceDate>' . $row["DatasetReference"] . '</datasetReferenceDate>
    <verticalExtent>' . $vert . '</verticalExtent>
</sample>';


                //print $xmlOut;
                $zip->addFromString($row["Title"] . '.xml', $xmlOut);
            }
        } else {

        }

        $conn->close();
        $zip->close();
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        readfile($filename);
        unlink($filename);

}



?>
