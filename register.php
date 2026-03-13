<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pink Aura By Dracilla</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/beercss@3.7.0/dist/cdn/beer.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="assets/logo.jpg"/>
</head>
<body>

<?php
    include "connection.php";

?>

    <div class="reg-page" id="registration_box">
        <fieldset class="reg-container col-lg-6 col-md-7 col-sm-10 col-9">
            <h4>Create New Account</h4>
            <div class="col-12 d-none" id="msgdiv">
                <div class="alert alert-danger" role="alert" id="msg">

                </div>
            </div>
            
                <div class="row">
                    <div class="max">
                        <div class="field label border small">
                            <input type="text"  required id="fname">
                            <label>First Name</label>
                        </div>  
                    </div>
                    <div class="max">
                        <div class="field label border small">
                            <input type="text"  required id="lname">
                            <label>Last Name</label>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="max">
                        <div class="field border label small">
                            <select id="g">
                            <option value="0">select</option>
                                <?php
                                $gender_rs = Database::search("SELECT * FROM `gender` ");
                                for ($x=0; $x < $gender_rs->num_rows; $x++) { 
                                $gender_data = $gender_rs->fetch_assoc();
                                ?>
                            <option value="<?php echo $gender_data["gender_id"]; ?>">
                                <?php echo $gender_data["gender_name"]; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                            <label>Gender</label>
                        </div>
                    </div>
                    <div class="max">
                        <div class="field border label small">
                            <select id="cc" >
                            <option value="0">select</option>
                                <?php
                                $country_rs = Database::search("SELECT * FROM `country` ORDER BY `country_name` ASC ");
                                for ($x=0; $x < $country_rs->num_rows; $x++) { 
                                $country_data = $country_rs->fetch_assoc();
                                ?>
                            <option value="<?php echo $country_data["country_id"]; ?>">
                                <?php echo $country_data["country_name"]; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                            <label>Country</label>
                        </div> 
                    </div>
                </div>
                <div class="field label border small col-10">
                    <input type="email" required id="email">
                    <label>Email</label>
                </div>
                <h6 style="font-size: 0.8rem; text-align:center; color:brown;"> * Password Must be atleast 6 characters *</h6>
                <nav class="field no-space small col-11">
                    <div class="max field label border suffix ">
                        <input type="password" id="password" required>
                        <label>Password</label>
                    </div>
                    <button class="medium square round tertiary ms-1" onclick="sp5();">
                        <i id="spi5" class="bi bi-eye-slash"></i>
                    </button>
                </nav>
                <nav class="field no-space small col-11">
                    <div class="max field label border suffix ">
                        <input type="password" id="repeatpw" required>
                        <label>Re-type Password</label>
                    </div>
                    <button class="medium square round tertiary ms-1" onclick="sp6();">
                        <i id="spi6" class="bi bi-eye-slash"></i>
                    </button>
                </nav>
                
            <p style="font-size: 0.8rem; margin-left:10%;">by logging in, you agree for our <a href="#">privacy policy</a></p>
            <button class="responsive tertiary medium-elevate large" onclick="register();">Create Account</button>
            <p style="text-align:center;">already have an account ? <a href="index.php">Log in</a></p>
            
        </fieldset>
    </div>

    <!-- js files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/beercss@3.7.0/dist/cdn/beer.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/material-dynamic-colors@1.1.2/dist/cdn/material-dynamic-colors.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
