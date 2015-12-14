<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Galerie</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Galerie</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="Profile.php">Profile</a></li>
                        <li><a href="Logout.php">Déconnexion</a></li>
                        <?php
                        if(isset($_SESSION['IDUsager']))
                        if($_SESSION['IDUsager']==0) {
                            ?>
                            <li role="separator" class="divider"></li>
                            <li><a href="Admin.php">Administration</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>


        </div><!-- /.navbar-collapse -->
    </div>
</nav>