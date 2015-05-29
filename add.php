


<!DOCTYPE html>
<html lang="en">

<head>

<?php include("base/head.php"); ?>

</head>


<?php include("base/nav.php"); ?>


    <!-- Intro Section -->
    <section id="intro" class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible" role="alert" id="upload_status" style="display:none;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <strong>Metadata Added!</strong> Use Search Metadata to find your upload.</div>

                    <div class="alert alert-danger alert-dismissible" role="alert" id="upload_failure" style="display:none;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <strong>Upload Failed!</strong> Make sure you have filled in all of the fields.</div>

                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            <h3 class="panel-title">Upload Metadata - <b>Single XML File</b></h3>
                        </div>
                        <div class="panel-body">

                            <p><strong>Usage Instructions:</strong> Click browse and select a single XML Metadata file.  When you hit submit, it will extract the information.
                              Include the path to the image, the upload date (pre-populated to today) and your last name to identify the owner.</p>
                                <form action="util/upload_to_db.php" method="POST" target="hidden_upload" enctype="multipart/form-data">
                                    <table>
                                    <tr><td><i>XML Metadata:</i></td><td><input id="fileInput" name="file" type="file"></td></tr>

                                    </td></tr>
                                <tr><td><i>Upload Date: </i></td><td><input type='text' id='date' name="upload" size="40" placeholder="today">
                                </td></tr>
                                <tr><td><i>Uploader(Your Folder): </i></td><td><input type='text' id='uploader' name="owner" size="40">
                                </td></tr>
                                <tr><td><i>Path to Image File: </i></td><td><input type='text' id='path' name="path" size="90" maxlength="800" readonly="readonly" value="\\dep-ap\Shared\LUM\NJGS\Projects\Library\Metadata_Database_Manager">

                                    <tr><td><button type="submit" class="btn btn-primary">Submit</button></td></tr>
                                </table>
                                    <!-- hidden fields for the metadata !-->
                                    <input type='text' id='collectionId' hidden="hidden" name="collectionId">
                                    <input type='text' id='title' hidden="hidden" name="title">
                                    <input type='text' id='abstract' hidden="hidden" name="abstract">
                                    <input type='text' id='datatype' hidden="hidden" name="datatype">
                                    <input type='text' id='supp' hidden="hidden" name="supp">
                                    <input type='text' id='coords' hidden="hidden" name="coords">
                                    <input type='text' id='refdate' hidden="hidden" name="refdate">

                                    <!-- alt info !-->
                                    <input type='text' id='alttitle' hidden="hidden" name="alttitle">
                                    <input type='text' id='altgeo' hidden="hidden" name="altgeo">
                                    <input type='text' id='onlineresource' hidden="hidden" name="onlineresource">
                                    <input type='text' id='browse' hidden="hidden" name="browse">
                                    <input type='text' id='coldate' hidden="hidden" name="coldate">
                                    <input type='text' id='extent' hidden="hidden" name="extent">

                                    <input type='text' id='actualSingle' hidden="hidden" name="actualSingle">



                                </form>
                                <iframe id="hidden_upload" name="hidden_upload" style="display:none" ></iframe>

                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible" role="alert" id="upload_status2" style="display:none;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <strong>Metadata Added!</strong> Use Search Metadata to find your upload.</div>

                    <div class="alert alert-danger alert-dismissible" role="alert" id="upload_failure2" style="display:none;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <strong>Upload Failed!</strong> Make sure you have filled in all of the fields.</div>

                    <div style="display:none;" id="loading"><center><p><img src="img/loader.gif"/><br><b>Reading ZIP Contents...</b></p></center></div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Upload Metadata - <b>XML Zip File</b></h3>
                        </div>
                        <div class="panel-body">

                            <p><strong>Usage Instructions:</strong> Click browse and select a zip file of XML metadata.  When you hit submit, it will extract the information.
                              Include the path to the zip containing the images, the upload date (pre-populated to today) and your last name to identify the owner.</p>
                                <form action="util/upload_to_db_zip.php" method="POST" target="hidden_upload" enctype="multipart/form-data">
                                    <table>
                                    <tr><td><i>XML Metadata Zip:</i></td><td><input id="zipinput" name="zipinput" type="file"></td></tr>

                                    </td></tr>
                                <tr><td><i>Upload Date: </i></td><td><input type='text' id='zipdate' name="zipdate" size="40" placeholder="today">
                                </td></tr>
                                <tr><td><i>Uploader(Your Folder): </i></td><td><input type='text' id='zipuploader' name="zipuploader" size="40">
                                </td></tr>
                                <tr><td><i>Path to Image Zip: </i></td><td><input type='text' readonly="readonly" id='zippath' name="zippath" size="90" maxlength="800" value="\\dep-ap\Shared\LUM\NJGS\Projects\Library\Metadata_Database_Manager">


                                    <tr><td><button type="submit" class="btn btn-primary">Submit</button></td></tr>
                                </table>

                                <!-- extra hidden fields !-->
                                <input type='number' id='total' hidden="hidden" name="total">
                                <input type='text' hidden="hidden" id='actual' name="actual">



                                <div id="newInputs"></div>

                                </form>
                                <iframe id="hidden_upload" name="hidden_upload" style="display:none" ></iframe>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>


    <?php include("base/js.php"); ?>

    <script type="text/javascript">

    function upload_completed(){
     document.getElementById("upload_status").style.display="block";

    }

    function upload_failed(){
     document.getElementById("upload_failure").style.display="block";
    }

    function upload_completed2(){
     document.getElementById("upload_status2").style.display="block";

    }

    function upload_failed2(){
     document.getElementById("upload_failure2").style.display="block";
    }

    $("#zipuploader").keyup(function(){
            $('#zippath').val("\\\\dep-ap\\Shared\\LUM\\NJGS\\Projects\\Library\\Metadata_Database_Manager\\" + $('#zipuploader').val());
    });
    $("#zipuploader").change(function(){
            $('#zippath').val("\\\\dep-ap\\Shared\\LUM\\NJGS\\Projects\\Library\\Metadata_Database_Manager\\" + $('#zipuploader').val());
    });

    $("#uploader").keyup(function(){
            $('#path').val("\\\\dep-ap\\Shared\\LUM\\NJGS\\Projects\\Library\\Metadata_Database_Manager\\" + $('#uploader').val());
    });
    $("#uploader").change(function(){
            $('#path').val("\\\\dep-ap\\Shared\\LUM\\NJGS\\Projects\\Library\\Metadata_Database_Manager\\" + $('#uploader').val());
    });

    </script>
    <!-- XML reading JS !-->
    <script src="js/xml-read.js"></script>


</body>

</html>
