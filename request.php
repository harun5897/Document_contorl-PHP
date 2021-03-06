<?php
session_start();
include_once('function/helper.php');
include_once("function/koneksi.php");

if($_SESSION['position']!=="admin" && $_SESSION['position']!=="staff" && $_SESSION['position']!=="super" && $_SESSION['position'] !== 'super_admin'){
    header("location:index.php?pesan=gagal");
}

if(isset($_GET['hal'])) {
    if($_GET['hal'] == 'reject') {

        // reject($koneksi, $_GET['id']);
        $_SESSION['val'] = $_GET['id'];
    ?>
        <script>
            var modal = 1;
        </script>
    <?php
        
    }

    if($_GET['hal'] == 'accept') {

        // accept($koneksi, $_GET['id']);
        $_SESSION['accept'] = $_GET['id'];
        ?>
        <script>
            var accept = 1;
        </script>
    <?php
    }

    if($_GET['hal'] == 'req') {

        // req($koneksi, $_GET['id']);
        $_SESSION['req'] = $_GET['id'];
        ?>
        <script>
            var req = 1;
        </script>
    <?php
        
    }
}

if(isset($_GET['notif'])) {
    if($_GET['notif'] == 'reject' ) {
        notif_reject($koneksi, $_GET['id']);
    }

    if($_GET['notif'] == 'acc' ) {
        notif_acc($koneksi, $_GET['id']);
    }

    if($_GET['notif'] == 'request' ) {
        notif_request($koneksi, $_GET['id']);
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>

    <!--STYLING CSS DAN JQUERY BOOTSTRAP  -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fa/css/all.css">
    <link rel="stylesheet" type="text/css" href="style/custom.css">
    
    <script type="text/javascript" src="jquery/jquery-3.2.1.slim.min.js"></script>
    <!-- <script type="text/javascript" src="pooper/pooper.min.js"></script> -->

    <script type="text/javascript" src="js/bootstrap.min.js"> </script>
    <script type="text/javascript" src="js/bootstrap.js"> </script>
    <!--TUTUP STYLING CSS DAN JQUERY BOOTSTRAP  -->

    <!-- SWALL -->
    <script src="alert/sweetalert2.all.min.js"></script>
</head>
<?php
if(isset($_GET['save'])){
    ?>
        <script> var save = true; 
        console.log(save);
        </script>
    <?php
} 
if(isset($_POST['b_pass'])) {

    change_password($koneksi, $_SESSION['id'], $_POST['password'], $_POST['new_password']);

}

if(isset($_POST['b_reject'])) {
    reject($koneksi, $_POST['comment'], $_SESSION['val']);
}

if(isset($_POST['b_req'])) {
    // reject($koneksi, $_POST['comment'], $_SESSION['val']);
    req($koneksi,  $_SESSION['req']);
}

if(isset($_POST['b_accept'])) {
    // reject($koneksi, $_POST['comment'], $_SESSION['val']);
    accept($koneksi,  $_SESSION['accept']);
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
<?php
if(isset($_GET['edit'])) {
        ?>
            <!-- Alert Edit -->
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succes Edit !</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        ?>
        <?php
}
?>
    <div class="card">
        <div class="card-header bg-warning text-white">  
            <div class="row">
                <div class="col-sm">
                    <b> <a href="home.php" class="mr-4" style="color: black;"> <i class="fas fa-home"></i>| Home </a></b>
                    <b> <a href="wi.php" class="mr-4" style="color: black"> <i class="far fa-clipboard"> </i>| Work Instruction </a></b>
                    <?php
                        if($_SESSION['position'] == 'admin' || $_SESSION['position'] == 'super_admin') 
                        {
                    ?>
                        <b> <a href="obsolete.php" class="mr-4" style="color: black"> <i class="fas fa-file-alt"> </i>| Obsolete WI </a></b>
                    <?php
                        }
                    ?>
                    <?php
                        if($_SESSION['position'] == 'super' || $_SESSION['position']=="staff" || $_SESSION['position'] == 'super_admin') 
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
                                if($_SESSION['position'] == 'super' || $_SESSION['position'] == 'super_admin') 
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
            <h5 class="card-title font"> <b>Request</b></h5>
            <hr>
            <div class="row">
                <div class="col-sm">
                    <?php
                        if($_SESSION['position'] == 'staff' || $_SESSION['position'] == 'super_admin') 
                        {
                    ?>
                        <a href="input_wi.php" class="btn general_color text-white"><i class="fas fa-plus"></i> New</a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-sm-3">
                <input class="form-control is-valid" type="search" placeholder="Search" aria-label="Search" id="myInput">
                </div>
            </div>
            <table class="table table-bordered mt-2 table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Doc Code</th>
                        <th scope="col">Doc Name</th>
                        <?php
                        if($_SESSION['position'] == 'super') {
                        ?>
                        <th scope="col">Requester</th>

                        <?php
                        }
                        ?>
                        <th scope="col">Date</th>
                        <th scope="col">Revisi</th>
                        <th scope="col">Status</th>
                        <th scope="col">Remark</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="myTable">
                <!-- UNTUK STAFF -->
                    <?php
                        $tampil = mysqli_query($koneksi, "SELECT * from tb_wi");
                        while($data = mysqli_fetch_array($tampil)) : 
                            if ($_SESSION['position'] == 'staff') {
                            if ($data['status'] == 'N' || $data['status'] == 'R') {
                                if ($_SESSION['id'] == $data['id_requester']) {
                    ?>
                    <tr>
                        <th scope="row"> <?=$data['id']?> </th>
                        <td> <?=$data['doc_code']?> </td>
                        <td> <?=$data['doc_name']?> </td>
                        <td> <?=$data['date']?></td>
                        <td> <?=$data['revision']?> </td>
                        <td>   
                                <?php
                                    if($data['status'] == 'N'){
                                        echo '<span class="badge badge-pill badge-warning"> Request 
                                        </span>';
                                    }
                                    if($data['status'] == 'R'){
                                        echo '<span class="badge badge-pill badge-danger"> Not Accepted 
                                        </span>';
                                    }
                                ?>
                        </td>
                        <td style="width: 250px"><?=$data['comment']?></td>
                        <td class="text-center">
                            <a href="show.php?hal=show&id=<?=$data['id']?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

                            <?php
                                if($_SESSION['position'] == 'staff'){
                            ?>
                            <a href="input_wi.php?hal=edit&id=<?=$data['id']?>" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i></a>
                            <a href="request.php?hal=req&id=<?=$data['id']?>" class="btn btn-success btn-sm"><i class="fas fa-arrow-alt-circle-right"></i></a>
                            <?php
                                }
                            ?>
                            <?php
                                if($_SESSION['position'] == 'super' && $data['status'] !== "R"){
                                    
                            ?>
                            <a href="request.php?hal=accept&id=<?=$data['id']?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                            <a href="request.php?hal=reject&id=<?=$data['id']?>" class="btn btn-danger btn-sm" ><i class="fas fa-times"></i></a>

                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php }}
                        } 
                    ?>


                    <!-- UNTUK SUPER ADMIN-->
                    <?php 
                            if ($_SESSION['position'] == 'super_admin') {
                            if ($data['status'] == 'N' || $data['status'] == 'R') {
                                $req = $data['id_requester'];
                                $requester = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id = '$req' ");
                                $arr_requester = mysqli_fetch_array($requester);
                    ?>
                    <tr>
                        <th scope="row"> <?=$data['id']?> </th>
                        <td> <?=$data['doc_code']?> </td>
                        <td> <?=$data['doc_name']?> </td>
                        <td> <?=$data['date']?></td>
                        <td> <?=$data['revision']?> </td>
                        <td>   
                                <?php
                                    if($data['status'] == 'N'){
                                        echo '<span class="badge badge-pill badge-warning"> Request 
                                        </span>';
                                    }
                                    if($data['status'] == 'R'){
                                        echo '<span class="badge badge-pill badge-danger"> Not Accepted 
                                        </span>';
                                    }
                                ?>
                        </td>
                        <td style="width: 250px"><?=$data['comment']?></td>
                        <td class="text-center">
                            <a href="show.php?hal=show&id=<?=$data['id']?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

                            <?php
                                if($_SESSION['position'] == 'super_admin' && $data['status'] !== 'N') {
                            ?>
                            <a href="input_wi.php?hal=edit&id=<?=$data['id']?>" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i></a>
                            <a href="request.php?hal=req&id=<?=$data['id']?>" class="btn btn-success btn-sm"><i class="fas fa-arrow-alt-circle-right"></i></a>
                            <?php
                                }
                            ?>
                            <?php
                                if($_SESSION['position'] == 'super_admin' && $data['status'] !== "R"){
                                    
                            ?>
                            <a href="request.php?hal=accept&id=<?=$data['id']?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                            <a href="request.php?hal=reject&id=<?=$data['id']?>" class="btn btn-danger btn-sm" ><i class="fas fa-times"></i></a>

                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php }
                        } 
                    ?>

                        <!-- UNTUK ATASAN -->
                    <?php
                        if ($_SESSION['position'] == 'super') {
                        if ($data['status'] == 'N' || $data['status'] == 'R') {
                            $req = $data['id_requester'];
                            $requester = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id = '$req' ");
                            $arr_requester = mysqli_fetch_array($requester);
                ?>
                <tr>
                    <th scope="row"> <?=$data['id']?> </th>
                    <td> <?=$data['doc_code']?> </td>
                    <td> <?=$data['doc_name']?> </td>
                    <td> <?=$arr_requester['name']?> </td>
                    <td> <?=$data['date']?></td>
                    <td> <?=$data['revision']?> </td>
                    <td>   
                            <?php
                                if($data['status'] == 'N'){
                                    echo '<span class="badge badge-pill badge-warning"> Request 
                                    </span>';
                                }
                                if($data['status'] == 'R'){
                                    echo '<span class="badge badge-pill badge-danger"> Not Accepted 
                                    </span>';
                                }
                            ?>
                    </td>
                    <td style="width: 250px"><?=$data['comment']?></td>
                    <td class="text-center">
                        <a href="show.php?hal=show&id=<?=$data['id']?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

                        <?php
                            if($_SESSION['position'] == 'staff'){
                        ?>
                        <a href="input_wi.php?hal=edit&id=<?=$data['id']?>" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i></a>
                        <a href="request.php?hal=req&id=<?=$data['id']?>" class="btn btn-success btn-sm"><i class="fas fa-arrow-alt-circle-right"></i></a>
                        <?php
                            }
                        ?>
                        <?php
                            if($_SESSION['position'] == 'super' && $data['status'] !== "R"){
                                
                        ?>
                        <a href="request.php?hal=accept&id=<?=$data['id']?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                        <a href="request.php?hal=reject&id=<?=$data['id']?>" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                        

                            </div>
                        </form>
                        <?php
                            }
                        ?>
                    </td>
                </tr>
                <?php }} 
                
                        endwhile; ?>
                                <?php
                                
                                ?>
                </tbody>
            </table>
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
                            <input type="text" class="form-control" name="new_password" placeholder="Input New Password">
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

    <!-- Modal ATASAN BERI KOMENTAR -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header general_color text-white">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Remark</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                    <textarea class="form-control" name="comment"></textarea>
                        
                </div>
                <div class="modal-footer">
                    <button type="submit" name="b_reject" class="btn general_color text-white"> <i class=""></i> <b>OK</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal KONFIRMASI REQUEST -->
    <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header general_color text-white">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Alert </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="">
                    <h3>Are You Sure ?</h3>
                    <p>Continue this process !</p>
                    <button type="submit" name="b_req" class="btn general_color text-white"> <i class=""></i> <b>OK</b></button>
                    <a href="request.php" class="btn btn-danger text-white" > <b> Cancel</b> </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal KONFIRMASI ACCEPT -->
    <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header general_color text-white">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-times"></i> Alert </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="">
                    <h3>Are You Sure ?</h3>
                    <p>Accepted this document !</p>
                    <button type="submit" name="b_accept" class="btn general_color text-white"> <i class=""></i> <b>OK</b></button>
                    <a href="request.php" class="btn btn-danger text-white" > <b> Cancel</b> </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>

$(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

<script>
console.log(save);
    if(save) {
        Swal.fire({
                icon: 'success',
                title: 'Save Success !',
                showConfirmButton: false,
                timer: 1700
            });
            setTimeout(function(){
            window.location.replace('request.php');
        }, 1700);
    }
</script>

<script>
if (modal) {
    $(document).ready(function(){
        $('#exampleModal3').modal();
    });
}
</script>

<script>
if (req) {
    $(document).ready(function(){
        $('#exampleModal4').modal();
    });
}
</script>

<script>
if (accept) {
    $(document).ready(function(){
        $('#exampleModal5').modal();
    });
}
</script>

</html>