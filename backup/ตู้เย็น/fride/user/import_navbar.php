<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a href="index.php"><img src="../seal.png" width="100" height="40" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <span class="nav-link"><b>Role: </b><?php echo$_SESSION['sess_u_type'];?></span>
                    </li>
                    <div class="dropdown">
                        <button class="btn btn-primary active dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"> </i>
                            <?php
                            echo $_SESSION['sess_u_user'];
                            ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="edit_profile.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php"><b style='color:red'><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</b></a>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>