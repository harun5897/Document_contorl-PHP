<?php
session_start();
include_once('function/helper.php');
include_once("function/koneksi.php");

if($_SESSION['position']!=="super" && $_SESSION['position'] !== 'super_admin'){
    header("location:home.php?pesan=gagal");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <!--STYLING CSS DAN JQUERY BOOTSTRAP  -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fa/css/all.css">
    <link rel="stylesheet" type="text/css" href="style/custom.css">
    
    <script type="text/javascript" src="jquery/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="pooper/pooper.min.js"></script>

    <script type="text/javascript" src="js/bootstrap.min.js"> </script>
    <script type="text/javascript" src="js/bootstrap.js"> </script>
    <!--TUTUP STYLING CSS DAN JQUERY BOOTSTRAP  -->

    <!-- SWALL -->
    <script src="alert/sweetalert2.all.min.js"></script>
</head>
<?php

if(isset($_GET['hal'])) {
    if($_GET['hal'] == 'edit'){
        show_user($koneksi, $_GET['id']);
    }
    $arr = $_SESSION['data_user'];
}

if(isset($_POST['btn_edit_user'])) {
    if($_SESSION['position'] == 'super_admin') {
        $position = $_POST['position'];
    } else {
        $position = 'staff';
    }
    edit_user($koneksi, $_GET['id'], $_POST['nik'], $_POST['name'], $_POST['email'], $position, $_POST['password'],);
}

?>
<body class="body">
<div class="top_title container-fluid">
    <div class="row">
        <div class="col-sm-1">
            <img class="mt-2 ml-3" src="img/icon.png" alt="" style="height: 80px;">
        </div>
        <div class="col-sm mt-auto font text-white">
            <h4>Document Control</h4>
            <p>  PT. Sanden</p>
        </div>
        <div class="col-sm-1"> 
            <a href="logout.php">
                <div class="log_out ml-3"> 
                    <!-- <a href=""><img class="center_logout" src="img/icon_logout.png" alt="" style="height: 45px;"></a> -->
                    <h1 class="mt-4 ml-3" style="color:black;"><i class="fas fa-power-off"></i></h1>
                </div>
            </a> 
        </div>
    </div>
    
</div>
<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-warning text-white">  
            <div class="row">
                <div class="col-sm">
                    <b> <a href="home.php" class="mr-4" style="color: black;"> <i class="fas fa-home"></i>| Home </a></b>
                    <b> <a href="wi.php" class="mr-4" style="color: black"> <i class="far fa-clipboard"> </i>| Work Instruction </a></b>
                    <?php
                        if($_SESSION['position'] == 'admin') 
                        {
                    ?>
                        <b> <a href="obsolete.php" class="mr-4" style="color: black"> <i class="fas fa-file-alt"> </i>| Obsolete WI </a></b>
                    <?php
                        }
                    ?>
                    <?php
                        if($_SESSION['position'] == 'super' || $_SESSION['position'] =="staff") 
                        {
                    ?>
                        <b> <a href="request.php" class="mr-4" style="color: black"> <i class="fas fa-check-circle"> </i>| Request </a></b>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-sm-1.5">
                    <div class="dropdown mr-3">
                        <b><a href="" style="color:black"><i class="fas fa-cog "></i> Setings</a></b>
                        <div class="dropdown-content">
                            <a href="" type="button"  data-toggle="modal" data-target="#exampleModal2" ><i class="fas fa-key"></i> Change Password</a>
                            <?php
                                if($_SESSION['position'] == 'super') 
                                {
                            ?>
                            <a href="user_list.php"><i class="far fa-id-card"></i> Staff List</a>
                            <?php
                                }
                            ?>
                            <a href="#"><i class="fas fa-info-circle"></i> About us</a>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
        <div class="card-body">
            <h5 class="card-title font"> <b>Edit User</b></h5>
            <hr>
            <div class="row">
                <div class="col-sm">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php
                            if(isset($_GET['hal'])) 
                                {
                                ?>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Nik</b></label>
                                    <div class="col-sm-9">
                                    <input type="" class="form-control" id="colFormLabel" placeholder="" value="<?=$arr['nik']?>" name="nik">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Name</b></label>
                                    <div class="col-sm-9">
                                    <input type="" class="form-control" id="colFormLabel" placeholder="" value="<?=$arr['name']?>" name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Email</b></label>
                                    <div class="col-sm-9">
                                    <input type="" class="form-control" id="colFormLabel" placeholder="" value="<?=$arr['email']?>" name="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Position</b></label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" name="position">
                                            <option value="staff" <?php if($arr['position'] == 'staff') { ?> selected <?php } ?>>Staff</opti>
                                            <option value="super" <?php if($arr['position'] == 'super') { ?> selected <?php } ?>>Atasan</option>
                                            <option value="admin" <?php if($arr['position'] == 'admin') { ?> selected <?php } ?>>Manager</option>
                                            <option value="super_admin" <?php if($arr['position'] == 'super_admin') { ?> selected <?php } ?>>Super admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Password</b></label>
                                    <div class="col-sm-9">
                                    <input type="" class="form-control" id="colFormLabel" placeholder="" value="<?=$arr['password']?>" name="password">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <b> <button type="submit" class="btn btn-warning ml-3" name="btn_edit_user" ><i class="fas fa-save"></i> Save</button>
                                    </b>
                                </div>
                            <?php
                            } 
                        ?>
                    </form>
                </div>
                <div class="col-sm">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" type="application/pdf" allowfullscreen></iframe>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal GANTI PASSWORD -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header general_color text-white">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-key"></i> Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="password" placeholder="Input Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="password" placeholder="Input New Password">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="b_pass" class="btn general_color text-white"> <i class="fas fa-key"></i> <b>OK</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>