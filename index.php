<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pink Aura By Dracilla</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="assets/logo.jpg"/>
</head>
<body>

<?php
    include "connection.php";

    // set a cookie to store email & password
    $email = "";
    $password = "";
    if (isset($_COOKIE["email"])) { 
        $email = $_COOKIE["email"]; 
    }
    if (isset($_COOKIE["password"])) { 
        $password = $_COOKIE["password"]; 
    }
?>

<div class="auth-page">

    <!-- ── left brand panel ── -->
    <div class="auth-brand">
        <div class="auth-brand__inner">
            <p class="auth-brand__pre">✦ welcome to ✦</p>
            <h1 class="auth-brand__name">PiNK<br>AURA</h1>
            <p class="auth-brand__tagline">by dracilla</p>
            <div class="auth-brand__pills">
                <span>skincare</span>
                <span>makeup</span>
                <span>haircare</span>
            </div>
        </div>
    </div>

    <!-- ── right form panel ── -->
    <div class="auth-panel">

        <!-- ===== LOGIN FORM ===== -->
        <div class="auth-card" id="loginCard">

            <div class="auth-card__deco">✿ ✦ ✿</div>
            <h2 class="auth-card__title">Login</h2>

            <div class="col-12 d-none" id="msgdiv">
                <div class="alert alert-danger" role="alert" id="msg"></div>
            </div>

            <!-- email -->
            <div class="inp-wrap">
                <input type="email" id="email" class="inp-field" placeholder=" " required value="<?php echo $email; ?>">
                <label class="inp-label">Email</label>
            </div>

            <!-- password -->
            <div class="inp-wrap">
                <input type="password" id="password" class="inp-field" placeholder=" " required value="<?php echo $password; ?>">
                <label class="inp-label">Password</label>
                <button type="button" class="inp-eye" onclick="sp1();">
                    <i id="spi1" class="bi bi-eye-slash"></i>
                </button>
            </div>

            <!-- remember + forgot -->
            <div class="auth-row">
                <label class="auth-check">
                    <input type="checkbox" id="rememberMe">
                    <span>Remember me</span>
                </label>
                <a href="#" class="auth-link sm" onclick="forgotPassword();">forgot password?</a>
            </div>

            <button class="auth-btn" onclick="login();">Log In</button>

            <p class="auth-small">by logging in, you agree to our <a href="privacypolicy.php" class="auth-link">privacy policy</a></p>

            <div class="auth-divider"><span>or</span></div>

            <p class="auth-switch">don't have an account? <a href="#" class="auth-link bold" onclick="showRegister();">Create Account</a></p>
            <p class="auth-admin"><a href="adminSignIn.php" class="auth-link sm">PiNK AURA Admin Login →</a></p>
        </div>
        <!-- /login -->

        <!-- ===== REGISTER FORM ===== -->
        <div class="auth-card hidden" id="registerCard">

            <div class="auth-card__deco">✿ ✦ ✿</div>
            <h2 class="auth-card__title">Create Account</h2>

            <div class="col-12 d-none" id="msgdiv_r">
                <div class="alert alert-danger" role="alert" id="msg_r"></div>
            </div>

            <!-- name row -->
            <div class="inp-row">
                <div class="inp-wrap">
                    <input type="text" id="fname" class="inp-field" placeholder=" " required>
                    <label class="inp-label">First Name</label>
                </div>
                <div class="inp-wrap">
                    <input type="text" id="lname" class="inp-field" placeholder=" " required>
                    <label class="inp-label">Last Name</label>
                </div>
            </div>

            <!-- email -->
            <div class="inp-wrap">
                <input type="email" id="reg_email" class="inp-field" placeholder=" " required>
                <label class="inp-label">Email</label>
            </div>

            <!-- password -->
            <div class="inp-wrap">
                <input type="password" id="reg_password" class="inp-field" placeholder=" " required>
                <label class="inp-label">Password</label>
                <button type="button" class="inp-eye" onclick="sp2();">
                    <i id="spi2" class="bi bi-eye-slash"></i>
                </button>
            </div>

            <!-- re-type password -->
            <div class="inp-wrap">
                <input type="password" id="reg_rpassword" class="inp-field" placeholder=" " required>
                <label class="inp-label">Re-type Password</label>
                <button type="button" class="inp-eye" onclick="sp3();">
                    <i id="spi3" class="bi bi-eye-slash"></i>
                </button>
            </div>

            <button class="auth-btn" onclick="register();">Create Account</button>

            <p class="auth-small">by registering, you agree to our <a href="privacypolicy.php" class="auth-link">privacy policy</a></p>

            <div class="auth-divider"><span>or</span></div>

            <p class="auth-switch">already have an account? <a href="#" class="auth-link bold" onclick="showLogin();">Log In</a></p>
        </div>
        <!-- /register -->

    </div>
    <!-- /auth-panel -->

</div>
<!-- /auth-page -->


<!-- ── forgot password modal ── -->
<div class="modal" tabindex="-1" id="fpmodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" style="font-family: ChakraPetch;">set a new password to your account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fp-modal">
                <div class="col-12 d-none" id="msgdiv2">
                    <div class="alert alert-danger" role="alert" id="msg2"></div>
                </div>
                <div class="inp-wrap">
                    <input type="password" id="np" class="inp-field" placeholder=" " required>
                    <label class="inp-label">New Password</label>
                    <button type="button" class="inp-eye" onclick="sp4();">
                        <i id="spi4" class="bi bi-eye-slash"></i>
                    </button>
                </div>
                <div class="inp-wrap" style="margin-top:1rem;">
                    <input type="password" id="rp" class="inp-field" placeholder=" " required>
                    <label class="inp-label">Re-type Password</label>
                    <button type="button" class="inp-eye" onclick="sp5();">
                        <i id="spi5" class="bi bi-eye-slash"></i>
                    </button>
                </div>
                <div class="inp-wrap" style="margin-top:1rem;">
                    <input type="number" id="vcode" class="inp-field" placeholder=" ">
                    <label class="inp-label">Verification Code</label>
                </div>
                <p style="font-size:0.72rem; color:var(--second-color); margin-top:0.3rem;">( check your email for the verification code )</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="auth-btn" style="width:auto; padding:0.5rem 1.5rem;" onclick="resetPassword();">Reset Password</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/main.js"></script>
</body>
</html>