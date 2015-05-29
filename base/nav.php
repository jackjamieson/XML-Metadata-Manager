<?php


echo
'
<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top"  data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="img/logo.png" style="width:60px;float:left;margin:10px;margin-right:15px;"/>
<a class="navbar-brand page-scroll" style="margin-top:18px">NJGWS Metadata Database</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav" style="margin-top:18px" >
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php">XML Generator</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="add.php">Upload Metadata</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="search.php">Search Metadata</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="help.php">User Guide</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="prepare.php">USGS XML Combiner</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

';


?>
