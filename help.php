


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
                        <div class="panel-heading">
                            <h3 class="panel-title">User's Guide to Generating Metadata for Photos/35mm Slides/Documents to the NJGS Data Catalog
							Using the Metadata XML File Generator</h3>
                        </div>
                        <div class="panel-body">
                            <p><strong>ACKNOWLEDGEMENTS</strong> </p>
                            <i>These people helped make this tool possible:</i>
                            <br>Jack Jamieson, Kathleen Vandegrift, Ted Pallis, Gregory Herman<p>

							<p><strong>IDENTIFY COLLECTION</strong> </p>
							<ul>
								<li>Pick the photograph/slide/document collection you wish to include in the NJGS Data Catalog.</li>
							</ul>
							<p><strong>PREPARE LOCATION FOR DATA UPLOAD</strong> </p>
							<ul>
								<li><span class="auto-style4"></span>Navigate to the following directory,
							\\dep-ap\LUM\NJGS\Projects\Library\<b>TO_BE_DETERMINED</b>. Create a folder if you do not already have one named using your first initial,
							middle initial and full last name. Example: klvandegrift</li>
                                <li>You will use this name when supplying the "Uploader" field when Uploading Metadata.</li>
								<li>Enter this folder and copy into it the folder (<b>NOT ZIPPED</b>) of photographs/slides/documents that you are generating metadata for, using a descriptive title that can include event
							and/or location and date information. Example: NJGWS Barnegat Bay Blitz 2014</li>
							</ul>
							<p><strong>PREPARE PHOTOGRAPHS</strong></p>
							<ul>
								<li>Enter the folder you just copied and select all files.  Right click and choose "Send to Compressed Zip Folder". A
							new zip file will be created.</li>
							</ul>
							<p><strong>METADATA GENERATION</strong> </p>
							<ul>
								<li>Go to the XML Generator page:
								<a href="index.php">click here</a>.
								Caution: This program will not work in Internet Explorer.</li>
							</ul>
							<p>Note that there are both required (in bold) and optional fields.
							<strong>ALL
							REQUIRED FIELDS MUST CONTAIN AN ENTRY FOR THE FILE TO BE GENERATED.</strong>
							Hovering your cursor over the "?" located next to each field title will provide
							definitions for that field.</p>
							<ul>
								<li>Populate fields
								</li>
							</ul>
							<p> (A1)
							"Browse". Click the
							"Browse" or "Choose File" button to navigate to the zip file of images you created in "Prepare Photographs".
							Double click the file. A list of all the files included in the zip file
							should be displayed
							on the xml generator page.</p>
                            <p> (A2)
							If you are only generating a single XML file, you do not need to click "Browse" or "Choose File".  Simply fill the required fields out as described below.</p>
							<p> (B) "Collection
							ID". The system defaults to P1300 for all photograph and 35mm slide
							collections. Use the drop down menu to choose an alternate ID number, if
							necessary.</p>
							<p> (C) "Title". Enter a
							descriptive title for the collection, including event name and/or location and
							date. Example: Barnegat Bay Blitz 2014 Note: If you are
							working from a zip file, the titles will already be displayed on the screen.</p>
							<p> (D) "Abstract". Enter
							more detail about the collection that would be helpful in further describing
							the collection. <strong>Be sure to add Township and County information.</strong>
							Example: "Cleanup event hosted by NJDEP and attended by NJGWS staff and other NJDEP personnel. Ship
							Bottom, Ocean County"</p>
							<p> (E) "Data Type". Select
							the correct data type for your collection.</p>
							<p> (F) "Supplemental Information".
							Leave this field set set to the language already provided in the dialogue box.</p>
							<p> (G) "Coordinates". Enter latitude
							and longitude. <strong>Data should be in decimal degrees,
							NAD83.</strong></p>
							<p> (H) Fill in information for any of the
							optional categories if its inclusion adds to the usefulness of the collection.
							<strong>Collection date is particularly useful if information is available.</strong></p>
							<ul>
								<li>Click the blue "Generate XML" button when finished. Note
							that ALL required fields must be populated in order for the file to be
								successfully generated. An XML file will be generated for each of the
								files in your collection and will appear in your downloads directory (as a
								ZIP file) unless you specified otherwise.</li>
								<li>If a dialog box appears, click "Save".</li>
							</ul>
							<p><strong>MANAGE METADATA FILES</strong></p>
							<ul>
								<li>Navigate to the XML files or XML ZIP in your downloads directory (or other directory
								you specified). Right
							click on the XML files or ZIP and select "copy". Navigate to the directory you
							created above. Right click and select "paste" to save the XML files in
								the same location as your collection.</li>
                                <li>If you proceed with the guide and upload your XML files, they will also be saved in the database for searching.</li>
							</ul>
							<p><strong>UPLOAD METADATA</strong></p>
							<ul>
								<li>Click on the "Upload Metadata" button at the top. Navigate to the Single File or Zip File portion of the screen,
								depending on whether you created a single or zip file.</li>
								<li>Click "Choose File" and choose the XML file or XML ZIP file that was just
								created.</li>
                                <li>"Upload Date" is automatically populated with today's date.</li>
                                <li>Fill in your folder name (Example: klvandegrift) in the "Uploader" dialog box.</li>
								<li>The Path to Image or ZIP cannot be edited.  It will be populated based on what was put in the Uploader field.</li>
                                <li>It is expected that all media will be placed in this location.</li>
								<li>Click "Submit". You should see a green bar telling you that upload
								was successful. If upload fails, you will receive a message in a red
								box.</li>
								<li>You can ensure that upload was successful by searching for your files
								using the "Search Metadata" tab at the top of the XML generator screen.</li>
							</ul>
							<p><strong>REPEAT</strong></p>
							<ul>
								<li>Repeat these steps for other photograph/slide/document collections you wish to upload.</li>
							</ul>



                    </div>



                </div>
            </div>
        </div>

</section>

    <?php include("base/js.php"); ?>

</body>

</html>
