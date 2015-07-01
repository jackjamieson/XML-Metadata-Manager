<?php

if(isset($_GET["path"])){//

    if(strpos($_GET["path"], ".pdf") > 1){
        header('Content-type:application/pdf');
    }
    else if(strpos($_GET["path"], ".JPG") > 1){
        header('Content-type:image/jpeg');
    }
    else if(strpos($_GET["path"], ".PNG") > 1){
        header('Content-type:image/png');
    }
    else if(strpos($_GET["path"], ".dae") > 1){
        header('Content-type:text/plain');
    }
    else header('Content-type:text/plain'); // try and show the text if all else fails

    //get file from the shared drive
    readfile($_GET["path"]);



die();
}
?>
