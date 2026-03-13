<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- stylesheets -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/style.css" />

  <link rel="icon" href="assets/logo.jpg" />
</head>

<body>
  <header class="header" id="main-header">
    <div class="page-top" >
      <p style="font-size:0.8rem; text-align:center;">Free shipping with orders over $40</p>
      <!-- <p style="font-size:0.8rem; text-align:center;">Just dropped "product name"  <a href="" style="color: black; margin-left:1rem;">Shop now</a></p> -->
    </div>
    <div class="row sec_nav_bar" style="min-height: 3rem;">
      <div class="acc col-4" style="text-align:center; font-size:0.8rem; ">
        
        <!-- <button class="user_acc ms-1"> <?php echo $data["email"]; ?></button>
        <span data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: underline; color:brown; letter-spacing:1px; 
          font-weight:bold; cursor:pointer; margin-left:4px;"> not you ?</span>
        <div class="dropdown2" >
          <ul class="dropdown-menu" style="background-color: rgb(245, 217, 221);">
            <li><a class="dropdown-item" href="index.php ">Login </a></li>
            <li><a class="dropdown-item" onclick="signout();">Sign Out</a></li>
            <li><a class="dropdown-item" href="register.php">Register</a></li>
          </ul>
        </div> -->
      
      <!-- <button class="home_login_button" onclick="gotoIndex();">Login to your account</button> -->

      </div>
      <div class="col-12 col-md-4" style=" text-align:center;">
        <span class="brand-name" onclick="gotoHome();">PiNK AURA</span>
      </div>
      <div class="btns col-12 col-md-4" style="text-align:center;">
        <div class="icons">
          <!-- toggle -->
          <div class="dropdown user_img">
            <img src="assests/user.png" data-bs-toggle="dropdown" aria-expanded="false" style="height: 1.8rem;" />
            <ul class="dropdown-menu" style="background-color: rgb(253, 245, 246);">
              <?php
             

              if(isset($_SESSION["u"])){
                $customer = $_SESSION["u"];
                ?>
                <li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="# ">My Orders</a></li>
                <li><a class="dropdown-item" href="# ">Purchase history</a></li>
                <li><a class="dropdown-item" href="# ">Contact Admin</a></li>
                <li><a class="dropdown-item" href="# " onclick="signout();">Log Out&nbsp;<i class="bi bi-box-arrow-right"></i></a></li>
                <?php
              }else{
                ?>
                <li><a class="dropdown-item" href="index.php">Log In</a></li>
                <li><a class="dropdown-item" href="register.php">Register</a></li>
                <?php
              }
              ?>
              
            </ul>
          </div>
          <img src="assests/search.png" class="search_img" onclick="gotosearch();"/>
          <img src="assests/wishlist.png" class="wishlist_img" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling2" aria-controls="offcanvasScrolling2"/>
          <img src="assests/cart.png" class="cart_img" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling1" aria-controls="offcanvasScrolling1"/>
          <img src="assests/menu-regular-24.png" class="tg" style="height: 1.6rem; margin-left:1.5rem; margin-top:5px;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" />
        </div>
      </div>
    </div>
    <div class="row third_nav_bar d-flex" >
      <button class="category-btns fw-bold" >Sale</button>
      <button class="category-btns" onclick="gotoCosmetics();">Cosmetics</button>
      <button class="category-btns"><a style="text-decoration: none; color:black;" href="category.php?cid=2">Skincare</a></button>
      <button class="category-btns"><a style="text-decoration: none; color:black;" href="category.php?cid=3">Fragrance</a></button>
      <button class="toolbtn category-btns"><a style="text-decoration: none; color:black;" href="category.php?cid=5">Tools & Accessories</a></button>
      <button class="category-btns"><a style="text-decoration: none; color:black;" href="category.php?cid=4">Hair</a></button>
      <button class="category-btns"><a style="text-decoration: none; color:black;" href="discover.php">Discover</a></button>
    </div>

    <!--offcanvas-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" >
      <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <h5 class="cat_title">Shop By Categories</h5>
        <div class="category_sec_container row">
            <div class="cat">
                <img src="assests/cosmetic.jpg" class="w-100" alt="">
                <h3>Cosmetics</h3>
            </div>
            <div class="cat">
                <img src="assests/skincare.jpg" class="w-100" alt="">
                <h3>Skincare</h3>
            </div>
            <div class="cat">
                <img src="assests/fragrance.jpg" class="w-100" alt="">
                <h3>Fragrance</h3>
            </div>
            <div class="cat">
                <img src="assests/haircare.jpg" class="w-100" alt="">
                <h3>Hair</h3>
            </div>
            <div class="cat">
                <img src="assests/tools.jpg" class="w-100" alt="">
                <h3>Tool & Accessories</h3>
            </div>
        </div>
        <div class="category-headings">
          <a>Sale</a>
        </div>
        <div class="category-headings">
          <a>Discover</a>
        </div>
        <div class="category-headings">
          <a>Gift Cards</a>
        </div>
      </div>
    </div>
  </header>
  

  
  <!-- js files -->
  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/main.js"></script>

</body>

</html>

<style>

.category-headings{
  width: 18rem;
  margin-left: 2rem;
  border-bottom: 1px solid black;
  margin-top: 1rem;
  height: 8vh;
  align-items: center;
  
}
.category-headings a{
  margin-left: 2rem;
  text-decoration: none;
  font-size: 1.2rem;
  font-family: "KalniyaGlaze";
}
.category-headings a:hover{
  cursor: pointer;
}

</style>

<script>
    document.addEventListener('scroll', function() {
        const header = document.getElementById('main-header');

        if (window.scrollY > 0) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
</script>