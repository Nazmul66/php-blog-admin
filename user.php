
<?php include "./inc/Sidebar.php" ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               
 
               <?php 
               
                    $do = isset( $_GET['do']) ? $_GET['do'] : 'manage';

                    if($do == 'manage'){
                    ?>
                       <div class="card-header bg-primary">
                           <h3 class="card-title">All user's Information</h3>
                       </div>

                       <table class="table table-rounded table-striped mt-3">
                          <thead class="table-dark">
                             <tr>
                                  <th scope="col">#Sl</th>
                                  <th scope="col">Image</th>
                                  <th scope="col">Full Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Address</th>
                                  <th scope="col">Phone</th>
                                  <th scope="col">Role</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Action</th>
                             </tr>
                          </thead>

                          <?php 
                            
                            $sqli = "SELECT * FROM userinfo ORDER BY name ASC";
                            $userData = mysqli_query($db, $sqli);
                            $totalNumRows = mysqli_num_rows($userData);
                            $s = 0;
                            if($totalNumRows == 0){
                              echo "<div class='badge badge-danger'>There is no data</div> ";
                            }
                            else{
                              while($row = mysqli_fetch_assoc($userData)){
                                    $id         = $row['id'];
                                    $name       = $row['name'];
                                    $email      = $row['email'];
                                    $password   = $row['password'];
                                    $phone      = $row['phone'];
                                    $address    = $row['address'];
                                    $role       = $row['role'];
                                    $status     = $row['status'];
                                    $image      = $row['image'];
                                    $s++;
                           ?>
                              <tbody>
                              <tr>
                                  <td><?php echo $s; ?></td>
                                  <td><?php 
                                      if( !empty($image) ) {
                                      ?>
                                       <img src="dist/img/users/<?php echo $image; ?>" width="50" alt="">
                                    <?php
                                      }

                                      else{
                                        ?>
                                        <img src="dist/img/users/avatar2.png" width="50" alt="">
                                     <?php 
                                      }
                                     ?>
                                  </td>
                                  <td><?php echo $name ?></td>
                                  <td><?php echo $email ?></td>
                                  <td><?php echo $phone ?></td>
                                  <td><?php echo $address ?></td>
                                  <td><?php 
                                      if($role == 1){
                                        echo "<div class='badge badge-success'>Admin</div>";
                                      }
                                      else if($role == 2){
                                        echo "<div class='badge badge-danger'>User</div>";
                                      }
                                   ?>
                                   </td>
                                  <td><?php 
                                      if($status == 1){
                                        echo "<div class='badge badge-success'>Active</div>";
                                      }
                                      else if($status == 0){
                                        echo "<div class='badge badge-danger'>Inactive</div>";
                                      }
                                   ?></td>
                                   <td>
                                      <ul class="d-flex p-0">
                                        <li style="list-style: none" class="mr-2">
                                            <a href="user.php?do=edit&id=<?php echo $id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </li>
                                        <li style="list-style: none">
                                             <a href="user.php?do=delete"><i class="fa-solid fa-trash text-danger"></i></a>
                                        </li>
                                      </ul>
                                   </td>
                              </tr>
                          </tbody>
                    
                          <?php
                              }
                            }  
  
                         ?>

                    </table>

                <?php
                    }


                else if($do == 'add'){
                    ?>

                    <div class="container">
                            <div class="card-header bg-primary mb-3">
                              <h3 class="card-title">Add user's Information</h3>
                            </div>

                        <form action="user.php?do=store" method="POST" enctype="multipart/form-data">
                            <div class="row">
                              <div class="col-lg-4">
                                 <div class="form-group">
                                      <label for="">Full Name</label>
                                      <input type="text" class="form-control" name="name" placeholder="Write Your Name" id="exampleInputPassword1">
                                  </div>

                                 <div class="form-group">
                                      <label for="">Email address</label>
                                      <input type="email" class="form-control" name="email" placeholder="Write Your Email" id="exampleInputEmail1">
                                  </div>

                                  <div class="form-group">
                                          <label for="exampleInputEmail1">Password</label>
                                          <input type="password" class="form-control" name="password" placeholder="Enter password" id="exampleInputEmail1">
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputPassword1">Re-Type Password</label>
                                          <input type="password" class="form-control" name="repassword" placeholder="Enter re-type password" id="exampleInputPassword1">
                                      </div>

                              </div>
                              <div class="col-lg-4">
                                  <div class="form-group">
                                          <label for="exampleInputEmail1">Phone No</label>
                                          <input type="text" class="form-control" name="phone" placeholder="Enter re-type phone" id="exampleInputEmail1">
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputPassword1">Address</label>
                                          <input type="text" class="form-control" name="address" placeholder="Enter your address" id="exampleInputPassword1">
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleFormControlSelect1">User Role</label>
                                          <select class="form-control" name='role' id="exampleFormControlSelect1">
                                            <option>please Select the user role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">User</option>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label for="exampleFormControlSelect1">Account Status</label>
                                          <select class="form-control" name='status'  id="exampleFormControlSelect1">
                                            <option>please Select the account status</option>
                                            <option value="1">active</option>
                                            <option value="0">Inactive</option>
                                          </select>
                                        </div>
                                  </div>
                                   <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="exampleFormControlSelect1">Image</label>
                                        <input type="file" id="image" class="form-control" name="image" >
                                      </div>
                                    <button type="submit" name="add_btn" class="btn btn-primary">Register New User</button>
                              </div>
                            </div>
                        <form>
                    </div>

                  <?php
                    }


                    else if($do == 'store'){
                      
                      if( isset( $_POST["add_btn"] ) ){
                           $name          = mysqli_real_escape_string($db, $_POST["name"]);
                           $email         = mysqli_real_escape_string($db, $_POST["email"]);
                           $password      = mysqli_real_escape_string($db, $_POST["password"]);
                           $repassword    = mysqli_real_escape_string($db, $_POST["repassword"]);
                           $phone         = mysqli_real_escape_string($db, $_POST["phone"]);
                           $address       = mysqli_real_escape_string($db, $_POST["address"]);
                           $role          = mysqli_real_escape_string($db, $_POST["role"]);
                           $status        = mysqli_real_escape_string($db, $_POST["status"]);

                           if( $password == $repassword ){
                                $hassedPass = sha1($password);


                                $image         = $_FILES['image']['name'];
                                $image_tmp     = $_FILES['image']['tmp_name'];
                                
                              if( !empty('image') ) {

                                 $img = rand(1,999999) . '-pimages-' . $image;

                                 move_uploaded_file($image_tmp, "/dist/img/users/" . $img );
                              }
                              else{
                                  $img = "";
                              }
                             
                             $sql = "INSERT INTO userinfo (name, email, password, phone, address, role, status, image) VALUES ('$name', '$email', '$hassedPass', '$phone', '$address', '$role', '$status', '$img')";

                             $addUser = mysqli_query($db, $sql);

                             if($addUser){
                                  header("Location: user.php?do=manage");
                              }
                              else{
                                  die("mysqli_error" . mysqli_error($db));
                              }
                             
                           }
                           else{
                            echo "login fail";
                           }
                      }
                      else{

                      }

                    }

                    else if($do == 'edit'){
                    ?>

                    <div class="container">
                        <div class="card-header bg-primary mb-3">
                           <h3 class="card-title">Add user's Information</h3>
                        </div>

                      <?php

                           if( isset ($_GET['id']) ){
                               $userID = $_GET['id'];

                               $sql = "SELECT * FROM userinfo WHERE id = '$userID'";
                               $data = mysqli_query($db, $sql);

                               while( $row = mysqli_fetch_array($data) ){
                                    $id              = $row['id'];
                                    $name            = $row['name'];
                                    $email           = $row['email'];
                                    $phone           = $row['phone'];
                                    $address         = $row['address'];
                                    $role            = $row['role'];
                                    $status          = $row['status'];
                                    $image           = $row['image'];

                            ?>
                              <form action="user.php?do=update" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                      <div class="col-lg-4">
                                         <div class="form-group">
                                              <label for="">Full Name</label>
                                              <input type="hidden" class="form-control" name="name" value="<?php echo $id ?>" >
                                              <input type="text" class="form-control" name="name" placeholder="Write Your Name" value="<?php echo $name ?>" id="exampleInputPassword1">
                                          </div>
        
                                         <div class="form-group">
                                              <label for="">Email address</label>
                                              <input type="email" class="form-control" name="email" placeholder="Write Your Email" value="<?php echo $email ?>" id="exampleInputEmail1">
                                          </div>
        
                                          <div class="form-group">
                                                  <label for="exampleInputEmail1">Password</label>
                                                  <input type="password" class="form-control" name="password" placeholder="***********" id="exampleInputEmail1">
                                              </div>
        
                                              <div class="form-group">
                                                  <label for="exampleInputPassword1">Re-Type Password</label>
                                                  <input type="password" class="form-control" name="repassword" placeholder="***********" id="exampleInputPassword1">
                                              </div>
        
                                      </div>
                                      <div class="col-lg-4">
                                          <div class="form-group">
                                                  <label for="exampleInputEmail1">Phone No</label>
                                                  <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>" placeholder="Enter your phone" id="exampleInputEmail1">
                                              </div>
        
                                              <div class="form-group">
                                                  <label for="exampleInputPassword1">Address</label>
                                                  <input type="text" class="form-control" name="address" placeholder="Enter your address" value="<?php echo $address ?>" id="exampleInputPassword1">
                                              </div>
        
                                              <div class="form-group">
                                                  <label for="exampleFormControlSelect1">User Role</label>
                                                  <select class="form-control" name='role' id="exampleFormControlSelect1">
                                                    <option>please Select the user role</option>
                                                    <option value="1" <?php if($role == 1){
                                                      echo "selected";} ?> >Admin</option>
                                                    <option value="2" <?php if($role == 2){
                                                      echo "selected";} ?> >User</option>
                                                  </select>
                                                </div>
        
                                                <div class="form-group">
                                                  <label for="exampleFormControlSelect1">Account Status</label>
                                                  <select class="form-control" name='status'  id="exampleFormControlSelect1">
                                                    <option>please Select the account status</option>
                                                    <option value="1" <?php if($status == 1){
                                                      echo "selected";} ?> >active</option>
                                                    <option value="0" <?php if($status == 0){
                                                      echo "selected";} ?> >Inactive</option>
                                                  </select>
                                                </div>
                                          </div>
                                           <div class="col-lg-4">
                                              <div class="form-group">
                                                <label for="exampleFormControlSelect1">Image</label>
                                                <br />
                                              <?php
                                                  if( !empty($image) ){
                                                    ?>
                                                   <img src="./dist/img/users/<?php echo $image; ?>" alt="" width="50">
                                                <?php
                                                  }
                                                ?>
                                                <br />
                                                <input type="file" class="form-control" name="image" >
                                              </div>
                                            <button type="submit" name="register_btn" class="btn btn-primary">Register New User</button>
                                      </div>
                                    </div>
                                <form>

                            <?php
                               }
                           }    
 
                       ?>

                    </div>

                    <?php
                    }

                    else if($do == 'update'){
                      echo "we will update it";
                    }

                    else if($do == 'delete'){
                      echo "we will delete it";
                    }

                    else{
                      echo "user has not found the page 404";
                    }
               
               ?>
   

            </div>
         </div>
      </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


 <?php include "./inc/Footer.php"  ?>