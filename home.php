<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pink Aura By Dracilla</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="assets/logo.jpg" />

</head>

<body onload="hideLoader()">

<!-- Loader -->
<div id="loader">
<!-- From Uiverse.io by Nawsome -->

    <section class="loader">

    <div class="slider" style="--i:0">
    </div>
    <div class="slider" style="--i:1">
    </div>
    <div class="slider" style="--i:2">
    </div>
    <div class="slider" style="--i:3">
    </div>
    <div class="slider" style="--i:4">
    </div>
    </section>

    <style>
        /* From Uiverse.io by Nawsome */ 
    .loader {
    position: absolute;
    left: 40%;
    top: 50%;
    z-index: 999;
    display: flex;
    }

    .slider {
    overflow: hidden;
    background-color: white;
    margin: 0 15px;
    height: 80px;
    width: 20px;
    border-radius: 30px;
    box-shadow: 15px 15px 20px rgba(0, 0, 0, 0.1), -15px -15px 30px #fff,
        inset -5px -5px 10px rgba(0, 0, 255, 0.1),
        inset 5px 5px 10px rgba(0, 0, 0, 0.1);
    position: relative;
    }

    .slider::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    border-radius: 100%;
    box-shadow: inset 0px 0px 0px rgba(0, 0, 0, 0.3), 0px 420px 0 400px #2697f3,
        inset 0px 0px 0px rgba(0, 0, 0, 0.1);
    animation: animate_2 2.5s ease-in-out infinite;
    animation-delay: calc(-0.5s * var(--i));
    }

    @keyframes animate_2 {
    0% {
        transform: translateY(250px);
        filter: hue-rotate(0deg);
    }

    50% {
        transform: translateY(0);
    }

    100% {
        transform: translateY(250px);
        filter: hue-rotate(180deg);
    }
}
    </style>

</div>

    <?php

    include "header.php";
    include "connection.php";

    ?>
<div class="main-content" style="margin-top: 0;">
    <!-- home -->
    <section class="hero-section">
        <div>B<br>y<br><br>D<br>R<br>A<br>C<br>I<br>L<br>L<br>A</div>
        
    </section>
    <style>
        .hero-section div {
        width: 100px;
        height: 100px;
        position:relative;
        animation-name: font;
        animation-duration: 7s;
        font-size:2.4rem;
        color: white;
        font-weight: 600;
        left: 20px;
        top: 15px;
        }
    </style>

    <!--  -->
    <section class="new-drop">
        <div class="row m-3 gy-3" style="display: flex; justify-content:center;">
            <div class="col col-md-4 col-6 sec">
                <a href="category.php?cid=2">
                <img src="assests/JEFREE STAR SKIN.jpg" class="w-100" style="height: auto;" alt="SKINCARE">
                <h5>SKINCARE</h5></a>
            </div>
            <div class="col col-md-4 col-6 sec">
                <a href="category.php?cid=3">
                <img src="assests/Givenchy for her.jpg" class="w-100" style="height: auto;" alt="fragrances">
                <h5>FRAGRANCE</h5></a>
            </div>
            <div class="col col-md-4 col-6 sec">
                <a href="subcategoryview.php?id=1">
                <img src="assests/eye.jpg" class="w-100" style="height: auto;" alt="eye">
                <h5>EYE</h5></a>
            </div>
        </div>
        
    </section>
    <!--  -->


    <!-- products -->
    <?php

    $newArrivals_rs = Database::search("SELECT * FROM `product` WHERE `product`.`status_status_id`='1'
        ORDER BY `product`.`datetime_added` DESC LIMIT 4 OFFSET 0 ");
    $newArrivals_num = $newArrivals_rs->num_rows;
     
    ?>
    <section class="best-sellings-products"><br>
        <h5 class="ms-4" style="color: grey;">New Arrivals This Week</h5>
        <div class="card-container row d-flex justify-content-center mb-5">

        <?php
        for ($x=0; $x < $newArrivals_num; $x++) { 
            $newArrivals_data = $newArrivals_rs->fetch_assoc();
            ?>

            <div class="card" style="width: 16rem;">
                <a href="singleProductView.php?id=<?php echo $newArrivals_data["product_id"]; ?>">
                <div class="product_img">

                <?php
                $img_rs = Database::search("SELECT * FROM `product_img` WHERE
                    `product_product_id`='".$newArrivals_data["product_id"]."'");
                $img_data = $img_rs->fetch_assoc();
                
                ?>

                    <img src="<?php echo $img_data["img_path"]; ?>" style="width: 100%;">

                    <?php

                    if (isset($_SESSION["u"])) {
                        $wishlist_rs = Database::search("SELECT * FROM `wishlist` WHERE 
                            `wishlist_product_id`='".$newArrivals_data["product_id"]."' AND 
                            `wishlist_user_email`='".$_SESSION["u"]["email"]."' ");
                        $wishlist_num = $wishlist_rs->num_rows;

                        if ($wishlist_num == 1) {
                            ?>
                            <button class="wishlist-btn" onclick="addToWishlist('<?php echo $newArrivals_data['product_id']; ?>');">
                                <i class="bi bi-bookmark-heart text-danger"></i>
                            </button>
                            <?php
                        }else{
                            ?>
                            <button class="wishlist-btn" onclick="addToWishlist('<?php echo $newArrivals_data['product_id']; ?>');">
                                <i class="bi bi-bookmark-heart text-dark"></i>
                            </button>
                            <?php
                        }
                    }
                    ?>
                    
                
                </div></a>
                <div class="product_details ms-2 mb-4">
                    <p class="card-title">
                        <?php
                        $clr_rs = Database::search("SELECT * FROM `inventory` INNER JOIN `clr` ON
                            inventory.clr_clr_id=clr.clr_id WHERE `product_product_id`='".$newArrivals_data["product_id"]."' ");
                        $clr_data = $clr_rs->fetch_assoc();
                        $tone_rs = Database::search("SELECT * FROM `inventory` INNER JOIN `skin_tone` ON
                            inventory.skin_tone_tone_id=skin_tone.tone_id WHERE `product_product_id`='".$newArrivals_data["product_id"]."' ");
                        $tone_data = $tone_rs->fetch_assoc();

                        if (isset($clr_data["clr_clr_id"])) {
                            echo $clr_data["clr_name"];
                        }else if(isset($tone_data["skin_tone_id"])){
                            echo $newArrivals_data["product_title"]; ?>
                            <span style="font-size: 0.9rem;"> | for <?php echo $tone_data["tone_name"]; ?> skin</span><?php
                        }else{
                            echo $newArrivals_data["product_title"];
                        }
                        ?>
                    </p>
                    <h6 class="card-text mt-3">$ <?php echo $newArrivals_data["product_price"]; ?></h6>
                </div>
                <button class="cart-btn" style="width: 100%; height: 2.8rem;" onclick="addToCart('<?php echo $newArrivals_data['product_id']; ?>','<?php echo $newArrivals_data['product_qty']; ?>');">Add to cart</button>
            </div>
            
            <?php
        }
        ?>
            
        </div>
    </section>

    <!-- cart -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling1"
             aria-labelledby="offcanvasScrollingLabel" style="background-color: rgb(253, 245, 246);">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" style="font-size: 2rem; font-family:'oleo'; letter-spacing:3px; color:rgb(161, 109, 116);">Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

        <?php

        if (isset($_SESSION["u"])) {

            $user_email = $_SESSION["u"]["email"];

            $cart_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON
                cart.cart_product_id=product.product_id WHERE `cart_user_email`='".$user_email."' ");
            $cart_num = $cart_rs->num_rows;

            ?>
            <p style="text-align: end; color:rgb(161, 109, 116);"><span class="fw-bold text-dark"><?php echo $cart_num; ?></span> items</p>
            <?php

            $total = 0;

            if ($cart_num == 0) {
                ?>
                <h5>nothing to see bitch</h5>
                <?php
            }else{

                for ($c=0; $c < $cart_num; $c++) { 

                    $cart_data = $cart_rs->fetch_assoc();

                    $total = $total + ($cart_data["product_price"] * $cart_data["cart_qty"]);

                    ?>

                    <div class="cart_product_container">
                        <div class="cart_product_image">
                        <?php
                        $cart_img_rs = Database::search("SELECT * FROM `product_img` WHERE
                            `product_product_id`='".$cart_data["cart_product_id"]."'");
                        $cart_img_data = $cart_img_rs->fetch_assoc();
                        
                        ?>
                            <img src="<?php echo $cart_img_data["img_path"]; ?>" />
                        </div>
                        <div class="cart_product_description col-5 ms-2">
                            <p class="cart_product_title"><?php echo $cart_data["product_title"]; ?></p>
                            <p class="cart_product_price">$ <?php echo $cart_data["product_price"]; ?></p>
                        </div>
                        <div class="cart_product_buttons col-3">
                            <button class="cart_remove_btn mb-3" onclick="removeFromCart('<?php echo $cart_data['product_id']; ?>');">Remove</button>
                            <div class="input-group">
                                <button class="minus">-</button>
                                <button class="num"><?php echo $cart_data["cart_qty"]; ?></button>
                                <button class="plus">+</button>
                            </div>
                        </div>
                    </div>
                        
                    <?php

                }

                ?>
                
                <div class="cart_total d-flex">
                    <h5 class="subtotal col-6">Subtotal</h5>
                    <h5 class="total_price col-6">$<?php echo $total; ?></h5>
                </div>
                <button class="checkout-btn" onclick="checkout();">check out</button>
                <?php  
            }
                 
        }else{
            echo("Login First");
        }
        
        ?>


        </div>
    </div>


    <!-- wishlist -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling2"
             aria-labelledby="offcanvasScrollingLabel" style="background-color: rgb(253, 245, 246);">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" style="font-size: 2rem; font-family:'oleo'; letter-spacing:3px; color:rgb(161, 109, 116);">Wishlist</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            
        <?php
        
        if (isset($_SESSION["u"])) {

            $wishlist_rs = Database::search("SELECT * FROM `wishlist` INNER JOIN `product` ON
                wishlist.wishlist_product_id=product.product_id WHERE `wishlist_user_email`='".$user_email."' ");
            $wishlist_num = $wishlist_rs->num_rows;

            if ($wishlist_num == 0) {
                echo("nothing to see bitch");
            }else{

                for ($w=0; $w < $wishlist_num; $w++) { 

                    $wishlist_data = $wishlist_rs->fetch_assoc();
                    ?>

                    <div class="wishlist_product_container">
                        <div class="wishlist_product_image">
                            <?php
                            $wishlist_img_rs = Database::search("SELECT * FROM `product_img` WHERE
                                `product_product_id`='".$wishlist_data["wishlist_product_id"]."'");
                            $wishlist_img_data = $wishlist_img_rs->fetch_assoc();
                            ?>
                            <img src="<?php echo $wishlist_img_data["img_path"]; ?>" />
                        </div>
                        <div class="wishlist_product_description col-5 ms-2">
                            <p class="wishlist_product_title"><?php echo $wishlist_data["product_title"]; ?></p>
                            <p class="wishlist_product_price">$ <?php echo $wishlist_data["product_price"]; ?></p>
                        </div>
                        <div class="wishlist_product_buttons col-3">
                            <button class="wishlist_btns mb-3" onclick="removeFromWishlist('<?php echo $wishlist_data['product_id']; ?>');">Remove</button>
                            <button class="wishlist_btns mb-3" onclick="addToCart('<?php echo $wishlist_data['product_id']; ?>','<?php echo $wishlist_data['product_qty']; ?>');">Add to cart</button>
                        </div>
                    </div>
                    
                    <?php

                }


            }
        ?>
            
        <?php           
        }else{
            echo("Login First");
        }
        
        ?>

        </div>
    </div>

    <!-- discover poster -->
    <!-- <section class="discover_poster row">
        <p class="col-8">Unlock the secrets to timeless beauty with <b>Pink Aura</b>. Embrace the art of self-care with 
            <b>Dracilla</b>'s curated advice for glowing, healthy skin.</p>
        <div class="col-6 d-flex justify-content-center" >
            <button class="discover_poster_btn mt-4">Discover us</button>
        </div>
    </section> -->

    <!-- special prdct -->
    <section class="special">
        <div class="row" style="display: flex; justify-content:center; align-items:center;">
            <div class="col-md-8 ptxt">
                <h3 style="font-family: 'title'; text-align:center; font-size:3rem;"><Span style="color: rgb(161, 109, 116);">PiNK AURA</Span> Sakura Skin Care Set
                    <br><br><button class="btn btn-light col-3"><a style="color:black; text-decoration:none;" href="singleProductView.php?id=64">Shop Now</a></button>
                </h3>
            </div>
            <div class="col-md-4 pimg" >
                <img src="assests/sakura.jpg" alt="">
                <h5 class="p-txt" style=" font-family: 'title'; font-size:2.6rem; text-align:center;"><Span style="color: rgb(161, 109, 116);">PiNK AURA</Span> Sakura Skin Care Set
                    <br><br><button class="btn btn-light"><a href="singleProductView.php?id=64" style="color:black; text-decoration:none;">Shop Now</a></button>
                </h5>
            </div>
        </div>
    </section>

    <style>
        .special{
            width: 100%;
            min-height: 20vh;
            background-color: #fbd8df;
            background: linear-gradient(to bottom, #faeef1, #fbd8df);
        }
        
        @media(max-width: 750px){
            .ptxt{
                display: none;
            }
            .pimg {
            position: relative;
            }

            .pimg img {
                border-radius: 1rem;
                background-color: rgba(58, 58, 58, 0.521);
                transition: opacity 0.3s ease;
                width: 100%;
                height: auto;
            }

            .pimg img:hover {
                opacity: 0.7;
            }

            .pimg h5 {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: white;
                font-size: 2.2rem;
                z-index: 2;
                text-shadow: 0 0 5px grey;
                font-family: "title";
            }
            .p-txt{
                display: block;
            }
        }
        @media(min-width: 750px){
            .pimg img{
                width: 100%;
                
            }
            .p-txt{
                display: none;
            }
        }
    </style>
    <!-- special prdct -->


    <!-- categories -->
    <!-- <section class="categories_sec">
        <div class="row carousel slide carousel-fade" id="carouselExampleFade" data-bs-ride="carousel" >
            <div class="col-2 col-md-3" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev" style="display: flex; align-items:center;">
                <img src="assests/arrow_back_icon.png" class="col-7 col-md-4" alt="">
            </div>
            <div class="col-8 col-md-5" >
                <div class="cat_img col-11 carousel-item active">
                    <img src="assests/cosmetic.jpg" class="w-100" alt="">
                    <h3 class="cat_name">Cosmetics</h3>
                </div>
                <div class="cat_img col-11 carousel-item">
                    <img src="assests/skincare.jpg" class="w-100" alt="">
                    <h3 class="cat_name">Skin Care</h3>
                </div>
                <div class="cat_img col-11 carousel-item">
                    <img src="assests/fragrance.jpg" class="w-100" alt="">
                    <h3 class="cat_name">Fragrance</h3>
                </div>
                <div class="cat_img col-11 carousel-item">
                    <img src="assests/haircare.jpg" class="w-100" alt="">
                    <h3 class="cat_name">Hair Care</h3>
                </div>
                <div class="cat_img col-11 carousel-item">
                    <img src="assests/tools.jpg" class="w-100" alt="">
                    <h3 class="cat_name" style="font-size: 2rem;">Tools & Accessories</h3>
                </div>
            </div>
            <div class="col-2 col-md-3" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next" style="display: flex; align-items:center;">
                <img src="assests/arrow_next_icon.png" class="col-7 col-md-4" alt="">
            </div>
        </div>
    </section> -->

    <section style="width: 100%; min-height:60vh;">
        <div class="row mt-4 mb-4">
            <div class="col-md-3 col-6 " style="position: relative;">
                <h5 class="tt" style="top: 40%; left: 50%; transform: translate(-50%, -50%);">Accessories<br>
                <a href="subcategoryview.php?id=2" class="d-flex justify-content-center mt-4"><button class="btn btn-outline-light">shop</button></a>
                </h5>
                <video class="border rounded" src="assests/acccc.mp4" style=" width: 100%; height:auto;" muted autoplay loop></video>
            </div>
            <div class="col-md-3 col-6 " style="position: relative;">
                <h5 class="tt" style="top: 40%; left: 50%; transform: translate(-50%, -50%);">Lip Tints<br>
                <a href="subcategoryview.php?id=2" class="d-flex justify-content-center mt-4"><button class="btn btn-outline-light">shop</button></a>
                </h5>
                <video class="border rounded" src="assests/36e9fe19a0dc899233bc74485c335135.mp4" style=" width: 100%; height:auto;" muted autoplay loop></video>
            </div>
            <div class="col-md-3 col-6" style="position: relative;">
                <h5 class="tt" style="top: 40%; left: 50%; transform: translate(-50%, -50%);">Foundation<br>
                <a href="subcategoryview.php?id=9" class="d-flex justify-content-center mt-4"><button class="btn btn-outline-light">shop</button></a>
                </h5>
                <video class="border rounded" src="assests/fff.mp4" style="width: 100%; height:auto;" muted autoplay loop></video>
            </div>
            <div class="col-md-3 col-6" style="position: relative;">
                <h5 class="tt" style="top: 40%; left: 50%; transform: translate(-50%, -50%);">Blush<br>
                <a href="subcategoryview.php?id=9" class="d-flex justify-content-center mt-4"><button class="btn btn-outline-light">shop</button></a>
                </h5>
                <video class="border rounded" src="assests/pinterestdownloader.com-1726653054.935865.mp4" style="width: 100%; height:auto;" muted autoplay loop></video>
            </div>
        </div>
        <style>
            
@media(max-width: 1016px){
    .tt{
            position: absolute;
            color: white;
            font-size: 2rem;
            z-index: 2;
            opacity: 1;
            font-weight: 800;
        }
}
@media(min-width: 1016px){
    .tt{
            position: absolute;
            color: white;
            font-size: 2.5rem;
            z-index: 2;
            opacity: 1;
            font-weight: 800;
        }
}
        </style>
    </section>

    
    <!-- Photo Grid -->
     <!-- <section class="photo_grid">
        <div class="row">
            <div class="column">
                <img src="assests/v2.jpg" style="width:100%">
                <img src="assests/h2.jpg" style="width:100%">
            </div>
            <div class="column">
                <img src="assests/h1.jpg" style="width:100%">
                <img src="assests/v1.jpg" style="width:100%">
            </div>
            <div class="column">
                <img src="assests/v3.jpg" style="width:100%">
                <img src="assests/h3.jpg" style="width:100%">
            </div>
            <div class="column">
                <img src="assests/v4.jpg" style="width:100%">
                <img src="assests/h4.jpg" style="width:100%">
            </div>
        </div>
    </section> -->

    <br>
    <?php
    include "footer.php";
    ?>

</div>

    <!-- js files -->
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/main.js"></script>
</body>

</html>

<style>
.home p{
    transform: translateY(-10px);
    transition-duration: 1s;
}
.follow-us{
    transform: translateY(-10px);
    transition-duration: 1s;
    transition-delay: 1s;
}
.social-media-btns{
    transform: translateY(-10px);
    transition-duration: 1s;
    transition-delay: 1s;
}

</style>
