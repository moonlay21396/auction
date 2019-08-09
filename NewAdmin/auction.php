<?php include_once "include_admin/admin_header.php" ?>
  <!-- Sidenav -->
  <?php include_once"include_admin/admin_nav.php" ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="auction.php">Auction</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" action="../leveinshtein/leveinshteinstemer.php" method="post">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text" name="searchbox">
            </div>
          </div>
          <input type="submit" name="search" class="btn btn-success" value="Search">
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
<?php
$email=$_SESSION['email'];
  $sql="SELECT * FROM user WHERE email='$email'";
  $res=mysqli_query($conn,$sql);
  confirm_query($res);
  while ($prorow=mysqli_fetch_assoc($res)) {
    $user_id=$prorow['user_id'];
    $fullname=$prorow['fullname'];
    $user_image=$prorow['user_image'];
  } 
?>
                  <img alt="Image placeholder" src="../images/user_image/<?php echo $user_image; ?>" style="width: 36px;height:36px; border-radius: 50%">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION['fullname']; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="" class="dropdown-item">
                <i class="ni ni-box-2"></i>
                <span>Inbox</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary  pt-md-7">
    </div>
    <div>
      <div class="row mt-3" style="width: 100%;">
        <div class="col-md-12">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Auction Lists</h3>
                </div>
              </div>
            </div>
            <?php 
              if(isset($_GET['delete'])){
                  $auction_id=$_GET['delete'];
                  $query="DELETE FROM auction WHERE auction_id=$auction_id";
                  $result=mysqli_query($conn,$query);
                  confirm_query($result);
              }
            ?>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Number</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Last Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no=1;
                    $query="SELECT * FROM auction";
                    $result=mysqli_query($conn,$query);
                    if(!$result){
                        die("Query Failed".mysqli_error($result));
                    }
                    while ($row=mysqli_fetch_assoc($result)) {
                        $auction_id=$row['auction_id'];
                        $user_name=$row['user_name'];
                        $product_name=$row['product_name'];
                        $last_price=$row['last_price'];

                  ?>
          
                  <tr>
                    <td>
                      <?php echo $no; ?>
                    </td>
                    <td>
                      <?php echo $user_name ?>
                    </td>
                    <td>
                      <?php echo $product_name ?>
                    </td>
                    <td>
                      <?php echo $last_price ?>
                    </td>
                    <td>
                      <a onclick="javaScript: return confirm('Are You Sure To Delete?')" href="auction.php?delete=<?php echo $auction_id ?>" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  <?php
                  $no++;
                      }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
          
      </div>
    </div>
    <!-- Page content -->
   
  <!-- Argon Scripts -->
  <!-- Core -->
  <?php include_once "include_admin/admin_footer.php" ?>