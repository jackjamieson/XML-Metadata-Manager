


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
                    <div class="panel panel-default" >
                        <div style="display:none;" id="loading"><center><p><img src="img/loader.gif"/><br><b>Reading ZIP Contents...</b></p></center></div>

                        <div class="panel-heading">
                            <h3 class="panel-title">USGS XML Combiner</h3>
                        </div>
                        <div class="panel-body">

                            <p><strong>Usage Instructions:</strong> Click browse and select a zip containing <b>ALL XML METADATA</b> files you wish to upload to the USGS National
                                Digital Catalog.  Click Combine and the files will be combined into a single XML file for you.</p>
                                    <table>
                                    <tr><td><i>XML Metadata Zip:</i></td><td><input id="fileInput" name="file" type="file"></td></tr>


                                    <tr><td><a id="gen" href="#" download="usgs-xml.xml" class="btn btn-primary">Combine</a></td></tr>
                                </table>


                        </div>
                    </div>



                </div>
            </div>
        </div>

    </section>


    <?php include("base/js.php"); ?>

    <script src="js/xml-combine.js"></script>



</body>

</html>
