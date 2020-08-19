<?php
session_start();
include_once('function/helper.php');
include_once("function/koneksi.php");

if($_SESSION['position']!=="staff"){
    header("location:home.php?pesan=gagal");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input WI</title>

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
                        if($_SESSION['position'] == 'super') 
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
                                if($_SESSION['position'] == 'admin') 
                                {
                            ?>
                            <a href="user_list.php"><i class="far fa-id-card"></i> User List</a>
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
            <h5 class="card-title font"> <b>Work Instruction</b></h5>
            <hr>
            <div class="row">
                <div class="col-sm">
                    <form>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Doc Code</b></label>
                            <div class="col-sm-9">
                            <input type="" class="form-control" id="colFormLabel" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Doc Name</b></label>
                            <div class="col-sm-9">
                            <input type="" class="form-control" id="colFormLabel" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Date</b></label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="colFormLabel" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Revisi</b></label>
                            <div class="col-sm-9">
                            <input type="" class="form-control" id="colFormLabel" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-3 col-form-label"><b>File</b></label>
                            <div class="custom-file col-sm-5 ml-3">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <a href="" class="btn general_color text-white ml-3"><i class="fas fa-save"></i> Save</a>
                        </div>
                    </form>
                </div>
                <div class="col-sm">
                    <div class="view_file">

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