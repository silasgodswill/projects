<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mooreadvice</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome/css/brands.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,600,700,900&display=swap"
        rel="stylesheet">
</head>

<body>

<?php require 'process.php';?>

<?php
  if (isset($_SESSION['message'])){; ?>

  <div class="alert alert-<?=$_SESSION['msg_type']?>">

  <?php 
     print $_SESSION['message'];
     unset($_SESSION['message']); 
     ?>
     </div>
<?php  } ?>
<?php 
   $connect = new mysqli($servername, $username, $password, $db);
    $result = mysqli_query($connect, "SELECT * FROM client_info") or die($mysqli->error);

    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        
    }

?>


    <nav class="navbar navbar-expand-sm navbar-dark bg-primary p-0">
        <div class="container">
            <a href="adminpage.php" class="navbar-brand">ADMIN PAGE @</a>
            <button class="navbar-toggler" data-toggle="collapse" data-terget="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav">
                    <li class="nav-item px-2">
                        <a href="index.html" class="nav-link active text-warning">MOOREADVICE LIMITED</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown mr-3">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-user"></i> WELCOME ADMIN
                        </a>
                        <div class="dropdown-menu">
                            <a href="profile.html" class="dropdown-item">
                                <i class="fas fa-user-circle"></i>profile
                            </a>
                            <a href="settings.html" class="dropdown-item">
                                <i class="fas fa-cog"></i>Setting
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2>
        <section id="action" class="py-4 mb-4 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addPostModal">
                            <i class="fa fa-plus"></i>Update
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="btn btn-success btn-block" data-toggle="modal"
                            data-target="#addCategoryModal">
                            </i>Edit
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="trash.php" class="btn btn-danger btn-block" data-toggle="modal"
                            data-target="#addUserModal">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </h2>

    <section class="posts">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="text-align: center;color: mediumblue;">CLIENTS INFORMATION @ MOOREADVICE LIMITED
                            </h4>
                        </div>
                        <table class="table table-straped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Client Email</th>
                                    <th>Client Number</th>
                                    <th>Mode of payment</th>
                                    <th>Date and time</th>
                                    <th>Action</th>
                            </thead>
                            <tbody>
                            <?php
                            $numbering = 1;
                            while($row = $result->fetch_assoc()):?>
                             
                                <tr>
                                    <td><?php print $numbering++; ?></td>
                                    <td><?php print $row['clientName']; ?></td>
                                    <td><?php print $row['clientEmail']; ?></td>
                                    <td><?php print $row['clientNumber']; ?></td>
                                    <td><?php print $row['paymentMode']; ?></td>
                                    <td><?php print $row['dateTime']; ?></td>
                                    <td>
                                        <a href="index.php?edit=<?php print $row['id']; ?>"
                                         class="btn btn-info">Edit</a>
                                         <a href="process.php?delete=<?php print $row['id']; ?>"
                                         class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <form action="process.php" method="POST">
                        <input type="hidden" name="id" value="<?php print $id; ?>">
        
                        <div class="card card-body">
                            <div class="form-group">
                                <label for="exampleInputName" style="color: mediumblue;">Name*</label>
                                    <input type="text" required autocomplete='off' value="<?php print $clientName;?>" name="clientName" id="#"
                                        class="form-control bg-dark text-white" placeholder="Client Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"style="color: mediumblue;" >Client email*</label>
                                    <input type="text" required autocomplete='off' value="<?php print $clientEmail;?>" name="clientEmail" id="#"
                                        class="form-control bg-dark text-white" placeholder="Client email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPhoneNo" style="color: mediumblue;">PhoneNo*</label>
                                    <input type="text" required autocomplete='off' name="clientphoneNumber" id="#"
                                        class="form-control bg-dark text-white" value="<?php print $clientNumber;?>" placeholder="Client Number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPayment" style="color: mediumblue;">Mode of payment*</label>
                                    <input type="text" required autocomplete='off' name="paymentMode" id="#"
                                        class="form-control bg-dark text-white" value="<?php print $paymentMode;?>" placeholder="Transfare/Cash">
                            </div>
                            <div class="form-group">
                                <?php if ($update == true):  ?>
                                    <button type="submit" class="btn btn-primary" name="update" >Update</button>
                                <?php else: ?>
                               <button type="submit" class="btn btn-primary" name="Submit" >Submit</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        </div>
    </section>



    <script src="js/jquery/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="fontawesome/js/fontawesome.js"></script>
    <script src="js/main.js"></script>
</body>

</html>