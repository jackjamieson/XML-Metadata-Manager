// xml tags
var collectionID = "";
var title = "";
var alternateTitle = "";
var abstract = "";
var datatype = "";
var supplementalInformation = "";
var coordinate = "";
var alternateGeometry = "";
var onlineResource = "";
var browseGraphic = "";
var date = "";
var datasetReferenceDate = "";
var verticalExtent = "";

var fileList = [];

function fillToday(){

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd='0'+dd
    }

    if(mm<10) {
        mm='0'+mm
    }

    today = yyyy + '-' + mm + '-' + dd;

    var dateField = document.getElementById('date');
    dateField.setAttribute('value', today);

    var dateField2 = document.getElementById('zipdate');
    dateField2.setAttribute('value', today);
}



//Read the file from the user
function readSingleFile(evt) {
    // Check for the various File API support.
    if (window.File && window.FileReader && window.FileList && window.Blob) {


        //Retrieve the first (and only!) File from the FileList object
        var f = evt.target.files[0];

        if (f) {
            var r = new FileReader();
            r.onload = function (e) {
                //reset();
                var inputText = e.target.result; //copy the file into a local var
                //console.log(e.target.result);
                //parseFile(inputText);
                //writeFile();
                //xmlString = inputText;
                if(f.name.indexOf(".xml") > -1)
                {
                    parseFile(inputText);
                    $("#actualSingle").val(title + ".xml");
                }
                else
                    alert("The file must be a .XML, if you want to use a .ZIP use the box below.")


            }
            r.readAsText(f);
        } else {
            alert("Failed to load file");
        }


    } else {
        alert('The File APIs are not fully supported by your browser.');
    }

}


// reading the zip data
(function () {
    if (!window.FileReader || !window.ArrayBuffer) {
        alert("Your browser does not support this tool. Try updating or switching to Chrome or Firefox.");
        return;
    }


    //var $result = $("#result");
    $("#zipinput").on("change", function(evt) {
        var count = 0;
        var showLoading = document.getElementById('loading');
        fileList.length = 0;
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

                    $("#actual").val(zipFileImg + ".zip");
                    //$('#zippath').val("\\\\dep-ap\\LUM\\NJGS\\Projects\\Library\\Metadata_Database_Manager\\" + zipFileImg + ".zip");


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

                        // clear the inputs so we don't stack fields
                        clearInputs();

                        // that, or a good ol' for(var entryName in zip.files)
                        $.each(zip.files, function (index, zipEntry) {

                            var fileName = zipEntry.name.substring(zipEntry.name.indexOf('/')+1, zipEntry.name.length);
                            if(fileName != 'Thumbs.db'){
                                // hide this because we are showing it another way
                                // $fileContent.append($("<li>", {
                                //     text : zipEntry.name
                                // }));
                                fileList.push(zipEntry.name); // add the filename to the array so we can count them later and use name
                            }
                            // the content is here : zipEntry.asText()
                            var inputs = document.getElementById("#newInputs")
                            count++;
                            makeInputs(inputs, count);
                            parseFileZip(zipEntry.asText(), count);
                            ///console.log(zipEntry.asText());
                            //TODO write new parse file function, call it here
                        });
                        // set the 'total' field so the db knows how many records to generate
                        document.getElementById("total").value = count;


                        //addTitleFields(fileList.length, fileList);
                        // end of the magic !

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

//set up the page
function init() {

    //watch the file selector for changes
    document.getElementById("fileInput").addEventListener("change", readSingleFile, false);

}

function clearInputs(){

    $( "#newInputs" ).html("");


}


function makeInputs(div, num){

    var inputFields = "";

    inputFields += '<input type="text" id="collectionId' + num + '" hidden="hidden" name="collectionId' + num + '">';
    inputFields += '<input type="text" id="title' + num + '" hidden="hidden" name="title' + num + '">';
    inputFields += '<input type="text" id="abstract' + num + '" hidden="hidden" name="abstract' + num + '">';
    inputFields += '<input type="text" id="datatype' + num + '" hidden="hidden" name="datatype' + num + '">';
    inputFields += '<input type="text" id="supp' + num + '" hidden="hidden" name="supp' + num + '">';
    inputFields += '<input type="text" id="coords' + num + '" hidden="hidden" name="coords' + num + '">';
    inputFields += '<input type="text" id="refdate' + num + '" hidden="hidden" name="refdate' + num + '">';

    inputFields += '<input type="text" id="alttitle' + num + '" hidden="hidden" name="alttitle' + num + '">';
    inputFields += '<input type="text" id="altgeo' + num + '" hidden="hidden" name="altgeo' + num + '">';
    inputFields += '<input type="text" id="onlineresource' + num + '" hidden="hidden" name="onlineresource' + num + '">';
    inputFields += '<input type="text" id="browse' + num + '" hidden="hidden" name="browse' + num + '">';
    inputFields += '<input type="text" id="coldate' + num + '" hidden="hidden" name="coldate' + num + '">';
    inputFields += '<input type="text" id="extent' + num + '" hidden="hidden" name="extent' + num + '">';

    $( "#newInputs" ).append(inputFields);



}

function parseFileZip(input, count){

    // fill all the fields with empty strings initially
    document.getElementById("collectionId" + count).value = "";
    document.getElementById("title" + count).value = "";
    document.getElementById("abstract" + count).value = "";
    document.getElementById("datatype" + count).value = "";
    document.getElementById("supp" + count).value = "";
    document.getElementById("coords" + count).value = "";
    document.getElementById("refdate" + count).value = "";

    // }

    // if we have a modern browser
    if (window.DOMParser)
    {

        parser2=new DOMParser();
        xmlDoc=parser2.parseFromString(input,"text/xml");

        collectionID = xmlDoc.getElementsByTagName("collectionID")[0].childNodes[0].nodeValue;
        title = xmlDoc.getElementsByTagName("title")[0].childNodes[0].nodeValue;



        abstract = xmlDoc.getElementsByTagName("abstract")[0].childNodes[0].nodeValue;

        datatype = "";

        for(var i = 0; i < xmlDoc.getElementsByTagName("dataType").length; i++)
        {
            datatype += xmlDoc.getElementsByTagName("dataType")[i].childNodes[0].nodeValue + ", ";


        }


        supplementalInformation = xmlDoc.getElementsByTagName("info")[0].childNodes[0].nodeValue;

        coordinates = xmlDoc.getElementsByTagName("coordinates")[0].childNodes[0].nodeValue;

        datasetReferenceDate = xmlDoc.getElementsByTagName("datasetReferenceDate")[0].childNodes[0].nodeValue;

        if(xmlDoc.getElementsByTagName("alternateTitle")[0].childNodes.length > 0 ){
            var innerTitle = xmlDoc.getElementsByTagName("alternateTitle")[0].innerHTML.trim();
            bgraph=parser.parseFromString(innerTitle,"text/xml");
            //console.log(bgraph.getElementsByTagName("title")[0].childNodes[0]);
            if((bgraph.getElementsByTagName("title")[0].childNodes[0] != null))
                alternateTitle = bgraph.getElementsByTagName("title")[0].childNodes[0].nodeValue;
        }

        if(xmlDoc.getElementsByTagName("alternateGeometry")[0].childNodes.length > 0 )
            alternateGeometry = xmlDoc.getElementsByTagName("alternateGeometry")[0].childNodes[0].nodeValue;

        if(xmlDoc.getElementsByTagName("onlineResource")[0].childNodes.length > 0 ){
            var innerOR = xmlDoc.getElementsByTagName("onlineResource")[0].innerHTML.trim();
            bgraph=parser.parseFromString(innerOR,"text/xml");

            onlineResource = bgraph.getElementsByTagName("resourceURL")[0].childNodes[0].nodeValue;
        }

        if(xmlDoc.getElementsByTagName("browseGraphic")[0].childNodes.length > 0 ){
            var innerBrowse = xmlDoc.getElementsByTagName("browseGraphic")[0].innerHTML.trim();
            bgraph=parser.parseFromString(innerBrowse,"text/xml");

            browseGraphic = bgraph.getElementsByTagName("resourceURL")[0].childNodes[0].nodeValue;
        }

        if(xmlDoc.getElementsByTagName("verticalExtent")[0].childNodes.length > 0 )
            verticalExtent = xmlDoc.getElementsByTagName("verticalExtent")[0].childNodes[0].nodeValue;

        if(xmlDoc.getElementsByTagName("dates")[0].childNodes.length > 0 )
            date = xmlDoc.getElementsByTagName("date")[0].childNodes[0].nodeValue;


        // now put the information into the hidden text boxes

        document.getElementById("collectionId" + count).value = collectionID;
        document.getElementById("title" + count).value = title;
        document.getElementById("abstract" + count).value = abstract;
        document.getElementById("datatype" + count).value = datatype;
        document.getElementById("supp" + count).value = supplementalInformation;
        document.getElementById("coords" + count).value = coordinates;
        document.getElementById("refdate" + count).value = datasetReferenceDate;

        document.getElementById("alttitle" + count).value = alternateTitle;
        document.getElementById("altgeo" + count).value = alternateGeometry;
        document.getElementById("onlineresource" + count).value = onlineResource;
        document.getElementById("browse" + count).value = browseGraphic;
        document.getElementById("coldate" + count).value = date;
        document.getElementById("extent" + count).value = verticalExtent;
    }
    else alert("Your browser is not compatible.  Try a more modern browser like Chrome or Firefox.");



}


function parseFile(input) {

    document.getElementById("collectionId").value = "";
    document.getElementById("title").value = "";
    document.getElementById("abstract").value = "";
    document.getElementById("datatype").value = "";
    document.getElementById("supp").value = "";
    document.getElementById("coords").value = "";
    document.getElementById("refdate").value = "";

    if (window.DOMParser)
    {
        parser=new DOMParser();
        xmlDoc=parser.parseFromString(input,"text/xml");

        collectionID = xmlDoc.getElementsByTagName("collectionID")[0].childNodes[0].nodeValue;
        title = xmlDoc.getElementsByTagName("title")[0].childNodes[0].nodeValue;



        abstract = xmlDoc.getElementsByTagName("abstract")[0].childNodes[0].nodeValue;

        for(var i = 0; i < xmlDoc.getElementsByTagName("dataType").length; i++)
        {
            datatype += xmlDoc.getElementsByTagName("dataType")[i].childNodes[0].nodeValue + ", ";


        }

        supplementalInformation = xmlDoc.getElementsByTagName("info")[0].childNodes[0].nodeValue;

        coordinates = xmlDoc.getElementsByTagName("coordinates")[0].childNodes[0].nodeValue;

        datasetReferenceDate = xmlDoc.getElementsByTagName("datasetReferenceDate")[0].childNodes[0].nodeValue;

        if(xmlDoc.getElementsByTagName("alternateTitle")[0].childNodes.length > 0 ){
            var innerTitle = xmlDoc.getElementsByTagName("alternateTitle")[0].innerHTML.trim();
            bgraph=parser.parseFromString(innerTitle,"text/xml");
            console.log(bgraph.getElementsByTagName("title")[0].childNodes[0]);
            if((bgraph.getElementsByTagName("title")[0].childNodes[0] != null))
                alternateTitle = bgraph.getElementsByTagName("title")[0].childNodes[0].nodeValue;
        }

        if(xmlDoc.getElementsByTagName("alternateGeometry")[0].childNodes.length > 0 )
            alternateGeometry = xmlDoc.getElementsByTagName("alternateGeometry")[0].childNodes[0].nodeValue;

        if(xmlDoc.getElementsByTagName("onlineResource")[0].childNodes.length > 0 ){
            var innerOR = xmlDoc.getElementsByTagName("onlineResource")[0].innerHTML.trim();
            bgraph=parser.parseFromString(innerOR,"text/xml");

            onlineResource = bgraph.getElementsByTagName("resourceURL")[0].childNodes[0].nodeValue;
        }

        if(xmlDoc.getElementsByTagName("browseGraphic")[0].childNodes.length > 0 ){
            var innerBrowse = xmlDoc.getElementsByTagName("browseGraphic")[0].innerHTML.trim();
            bgraph=parser.parseFromString(innerBrowse,"text/xml");

            browseGraphic = bgraph.getElementsByTagName("resourceURL")[0].childNodes[0].nodeValue;
        }

        if(xmlDoc.getElementsByTagName("verticalExtent")[0].childNodes.length > 0 )
            verticalExtent = xmlDoc.getElementsByTagName("verticalExtent")[0].childNodes[0].nodeValue;

        if(xmlDoc.getElementsByTagName("dates")[0].childNodes.length > 0 )
            date = xmlDoc.getElementsByTagName("date")[0].childNodes[0].nodeValue;


        // now put the information into the hidden text boxes

        document.getElementById("collectionId").value = collectionID;
        document.getElementById("title").value = title;
        document.getElementById("abstract").value = abstract;
        document.getElementById("datatype").value = datatype;
        document.getElementById("supp").value = supplementalInformation;
        document.getElementById("coords").value = coordinates;
        document.getElementById("refdate").value = datasetReferenceDate;

        document.getElementById("alttitle").value = alternateTitle;
        document.getElementById("altgeo").value = alternateGeometry;
        document.getElementById("onlineresource").value = onlineResource;
        document.getElementById("browse").value = browseGraphic;
        document.getElementById("coldate").value = date;
        document.getElementById("extent").value = verticalExtent;








    }
    else alert("Your browser is not compatible.  Try a more modern browser like Chrome or Firefox.");


}

// functions called at start
init();
fillToday();//fill the date field with today's date
