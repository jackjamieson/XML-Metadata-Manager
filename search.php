


<!DOCTYPE html>
<html lang="en">

<head>

    <?php include("base/head.php"); ?>
    <?php include("base/js.php"); ?>
</head>


<?php

include("util/dbmanager.php");
$db = new dbmanager();
$db->connectToDatabase();
$conn = $db->getConnection();

// this array is used to keep track of all IDS
// it is used to download all results from download_all.php
$id_array = array();


$out = "";// this is the string that gets appended to show the row results

/*
Generates the rows given the result of a query.
Needs query and val for delete.php to bring the user back to the same Location
id_array is used to download all of the files that the search returns
*/
function generateRows($result, $conn, $query, $id_array, $val){

    if ($result->num_rows > 0) {

        global $out;
        global $id_array;

        // output data of each row
        while($row = $result->fetch_assoc()) {

            $lessPath;// the modified path to the image that is shown in the table
            $imageLink = $row["Path"];// the link to the image on the shared drive
            $extChecker;

            // if the image link is a single xml file
            if(strpos($imageLink, '.xml') > 0)
            {
                $imageLink = substr($imageLink, 0, strpos($imageLink, '.xml'));// cut off the xml part
                $extChecker = "\\\dep-ap\Shared\LUM\NJGS\Projects\Library\Metadata_Database_Manager\\" . $row["Owner"] . "\\" . $row["Title"];

                $imageLink = "\\\dep-ap\Shared\LUM\NJGS\Projects\Library\Metadata_Database_Manager\\" . $row["Owner"] . "\\" . $row["Title"];
                $lessPath = substr($row["Path"], 0, strpos($row["Path"], '.xml'));
            }
            else {
                $imageLink = substr($imageLink, 0, strpos($imageLink, '.zip'));
                $extChecker = $imageLink . "\\" . $row["Title"];

                //$imageLink = $imageLink . "\\" . $row["Title"] . ".jpg";
                $lessPath = substr($row["Path"], 0, strpos($row["Path"], '.zip'));


            }

            $findExtPre = glob ($extChecker . ".*");

            // if the file exists make it a hyperlink to the file, otherwise just write the name of the file.
            if(strlen($findExtPre[0]) > 1)
            {
                // check for the file extension
                $findExt = glob ($extChecker . ".*");

                $imageLink = "<a href='util/display_image.php?path=$findExt[0]' >" . $row["Title"] . "</a>";// append the <a> tag to make it a link
            }
            else {

                //$findExt = glob ($extChecker . ".*");
                //$out .= $findExt[0];


                $imageLink = $row["Title"];
            }

            array_push($id_array, $row["xml_id"]);// add each id to the array so that we can get it later to download

            if(strlen($row["zipID"] < 1)){// this means that is not a zip aka a single xml file

            $out .= "<tr><td>" . $row["CollectionID"] . "</td><td>" . $imageLink . "</td><td>" . $lessPath . "</td><td>"
            . $row["UploadDate"] . "</td><td>" . $row["Owner"] . "</td><td>" . '<center><a href="util/download.php?id=' . $row["xml_id"] . '"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></center>' . "</td>
            <td></td><td>" . '<center><a href="#"><span id="' . $row["xml_id"] . '" style="color:#B22222;" class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>

            <script>
            $( "#' . $row["xml_id"] . '" ).click(function() {
                if (confirm("Are you sure you want to delete this?") == true) {

                    window.open("util/delete.php?id=' . $row["xml_id"] . '&query='.$query.'&val='.$val.'","_self");


                }
            });
</script></center>

            ' . "</td></tr>";
        }

        else{// this id has a zip associated with it

            $out .= "<tr><td>" . $row["CollectionID"] . "</td><td>" . $imageLink . "</td><td>" . $lessPath . "</td><td>"
            . $row["UploadDate"] . "</td><td>" . $row["Owner"] . "</td><td>" . '<center><a href="util/download.php?id=' . $row["xml_id"] . '"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></center>' . "</td>
            <td>" . '<center><a href="util/zip.php?id=' . $row["zipID"] . '"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></center>' . "</td><td>" . '<center><a href="#"><span id="' . $row["xml_id"] . '" style="color:#B22222;" class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>

            <script>
            $( "#' . $row["xml_id"] . '" ).click(function() {
                if (confirm("Are you sure you want to delete this?") == true) {

                    window.open("util/delete.php?id=' . $row["xml_id"] . '&query='.$query.'&val='.$val.'","_self");


                }
            });
</script></center>

            ' . "</td></tr>";
        }
        }
    }
    $conn->close();

}

// if we have sent a query through the search box, pick it up here
// each option has its own method and SQL in dbmanager.php
if(isset($_GET['query'])){


    $query = $_GET["query"];

    if($query == "listAll"){

        $sql = $db->listAll();
        $result = $conn->query($sql);

        generateRows($result, $conn, $query, $id_array, "");

    }

    if($query == "uploader"){

        $val = $_GET['val'];
        $val = $conn->real_escape_string($val);

        $sql = $db->byUploader($val);

        $result = $conn->query($sql);

        generateRows($result, $conn, $query, $id_array, $val);
    }

    if($query == "title"){

        $val = $_GET['val'];

        $sql = $db->byTitle($val);

        $result = $conn->query($sql);

        generateRows($result, $conn, $query, $id_array, $val);
    }

    if($query == "date"){

        $val = $_GET['val'];

        $sql = $db->byDate($val);

        $result = $conn->query($sql);

        generateRows($result, $conn, $query, $id_array, $val);

    }

    if($query == "year"){

        $val = $_GET['val'];

        $sql = $db->byYear($val);

        $result = $conn->query($sql);

        generateRows($result, $conn, $query, $id_array, $val);

    }

    if($query == "range"){

        $val = $_GET['val'];

        $pieces = explode("t", $val);

        $sql = $db->byRange($pieces[0], $pieces[1]);

        $result = $conn->query($sql);

        generateRows($result, $conn, $query, $id_array, $val);


    }

    if($query == "abstract"){

        $val = $_GET['val'];

        $sql = $db->byAbstract($val);

        $result = $conn->query($sql);

        generateRows($result, $conn, $query, $id_array, $val);

    }


    if($query == "colid"){

        $val = $_GET['val'];

        $sql = $db->byCollectionID($val);

        $result = $conn->query($sql);

        generateRows($result, $conn, $query, $id_array, $val);


    }

}



?>

<?php include("base/nav.php"); ?>

<section id="intro" class="intro-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Search Metadata</h3>
                    </div>
                    <div class="panel-body">


                        <p><strong>Usage Instructions:</strong> List all will list all Metadata Records in the database.  Searching can be done based on partial matches.</p>
                        <select id="options">
                            <option value="listAll">List All</option>
                            <option value="colid">By Collection ID</option>
                            <option value="abstract">By Abstract</option>
                            <option value="uploader">By Owner</option>
                            <option value="title">By Title</option>
                            <option value="date">By Upload Date (YYYY-MM)</option>
                            <option value="range">By Date Range (YYYY-MM)</option>
                            <option value="year">By Upload Year (YYYY)</option>

                        </select>
                        <input type='text' name="q" id='query' size="40" ><div id="to" style="display:none">&nbsp;<b>to</b>&nbsp;</div>
                        <input type='text' name="q2" id='queryTo' size="40" style="display:none;">

                        <br><br>


                        <a href="#" id="btn"><button type="button" id="searchbtn" class="btn btn-primary">Search</button></a>

                        <?php
                        // below is the code to download all files searched for
                        // they are placed into an invisible text box comma seperated, then parsed in download_all.php
                        $ids = "";
                        if(isset($_GET['query'])){
                            ?>
                            <a href="#" id="btndl"><button type="button" id="downloadAll" class="btn btn-primary">Download Results</button></a>
                            <?php
                            for($i = 0; $i < count($id_array); $i++){

                                if($i+1 == count($id_array))
                                {
                                    $ids .= $id_array[$i];
                                }
                                else{
                                    $ids .= $id_array[$i] . ',';
                                }
                            }


                        }
                        ?>

                        <input type='text' name="idlist" id='idlist' size="40" style="display:none;" value="<?php echo $ids?>">
                    </div>
                </div>



                <?php
                if(isset($_GET['query'])) {

                    ?>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Search Results</h3>

                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead><tr><th>Collection ID</th><th>Title</th><th>Image Path</th><th>Upload Date</th><th>Owner</th><th>XML Record</th><th>Zip File</th><th>Delete</th></tr></thead>

                        <?php echo $out ?>

                    </table>
                </div>

                <?php } ?>
            </div>
        </div>
    </section>

    <script>

    $( "#searchbtn" ).click(function() {
        if($( "#options" ).val() == 'range')
        {
            $('#btn').attr('href','search.php?query=' + $( "#options option:selected" ).val()+ "&val=" + $("#query").val() + "t" + $("#queryTo").val());

        }
        else
            $('#btn').attr('href','search.php?query=' + $( "#options option:selected" ).val()+ "&val=" + $("#query").val());

    });

    $( "#downloadAll" ).click(function() {

        $('#btndl').attr('href','util/download_all.php?list=' + $("#idlist").val());



    });

    // this adds a second box for the 'range' search
    $( "#options" ).change(function() {
        if($( this ).val() == 'range')
        {
            $( "#to" ).css("display", "inline-block");
            $( "#queryTo" ).css("display", "inline-block");
        }
        else {

            $( "#to" ).css("display", "none");
            $( "#queryTo" ).css("display", "none");


        }
    });



    </script>
</body>

</html>
