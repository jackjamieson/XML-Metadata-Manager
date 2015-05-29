var fullXml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<samples>\n";
var hasChanged = false;

// reading the zip data
(function () {
    if (!window.FileReader || !window.ArrayBuffer) {
        alert("Your browser does not support this tool. Try updating or switching to Chrome or Firefox.");
        return;
    }


    //var $result = $("#result");
    $("#fileInput").on("change", function(evt) {
        hasChanged = true;
        var count = 0;
        var showLoading = document.getElementById('loading');
        // remove content
        //$result.html("");
        // be sure to show the results
        //$("#result_block").removeClass("hidden").addClass("show");

        // see http://www.html5rocks.com/en/tutorials/file/dndfiles/

        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {

                showLoading.style.display = "block"; // show the loading div

                return function(e) {
                    var $title = $("<h4>", {
                        text : theFile.name
                    });
                    //console.log(theFile.name);
                    zipFile = theFile.name.substring(0, theFile.name.indexOf('.zip'));
                    zipFileImg = theFile.name.substring(0, theFile.name.indexOf('-xml'));




                    //$result.append($title);
                    var $fileContent = $("<ul>");
                    try {

                        var dateBefore = new Date();
                        // read the content of the file with JSZip
                        var zip = new JSZip(e.target.result);
                        var dateAfter = new Date();

                        $title.append($("<span>", {
                            text:" Contents: "
                        }));


                        // that, or a good ol' for(var entryName in zip.files)
                        $.each(zip.files, function (index, zipEntry) {

                            var fileName = zipEntry.name.substring(zipEntry.name.indexOf('/')+1, zipEntry.name.length);
                            if(fileName != 'Thumbs.db'){
                                // hide this because we are showing it another way
                                // $fileContent.append($("<li>", {
                                //     text : zipEntry.name
                                // }));

                            }
                            // the content is here : zipEntry.asText()
                            var inputs = document.getElementById("#newInputs")
                            count++;

                            var tempFile = zipEntry.asText();
                            tempFile = tempFile.substring(tempFile.indexOf("\n") + 1);
                            fullXml += tempFile + "\n";

                        });
                        // set the 'total' field so the db knows how many records to generate


                        //addTitleFields(fileList.length, fileList);
                        // end of the magic !
                        fullXml += "\n</samples>"
                        //console.log(fullXml);

                    } catch(e) {
                        $fileContent = $("<div>", {
                            "class" : "alert alert-danger",
                            text : "Error reading " + theFile.name + " : " + e.message
                        });
                    }
                    //$result.append($fileContent);
                    showLoading.style.display = 'none';

                }
            })(f);

            // read the file !
            // readAsArrayBuffer and readAsBinaryString both produce valid content for JSZip.
            reader.readAsArrayBuffer(f);

            // reader.readAsBinaryString(f);
        }

    });
})();


// when the predfined ids are changed, change the Collection id input
$( "#gen" ).click(function() {

    if(hasChanged){


        var textFile = null,
        makeTextFile = function (text) {
            var data = new Blob([text], {type: 'text/xml'});

            // If we are replacing a previously generated file we need to
            // manually revoke the object URL to avoid memory leaks.
            if (textFile !== null) {
                window.URL.revokeObjectURL(textFile);
            }

            textFile = window.URL.createObjectURL(data);

            return textFile;
        };
        this.href = makeTextFile(fullXml);
    }
    else
        alert("You have to select a ZIP of Metadata first.");

});
