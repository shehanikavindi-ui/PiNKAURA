<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiNK AURA — Admin</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/admin_style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="assets/logo.jpg" />
    
</head>
<body>

<!-- back to store -->
<a href="home.php" class="adm-back-link">
    <i class="bi bi-arrow-left"></i> back to store
</a>

<div class="adm-auth-page">

    <!-- ── LEFT BRAND PANEL ── -->
    <div class="adm-auth-brand">
        <p class="adm-auth-brand__pre">✦ admin portal ✦</p>
        <h1 class="adm-auth-brand__name">PiNK<br>AURA</h1>
        <p class="adm-auth-brand__tagline">by dracilla</p>

    </div>

    <!-- ── RIGHT FORM PANEL ── -->
    <div class="adm-auth-panel">

        <!-- ===== LOGIN CARD ===== -->
        <div class="adm-auth-card" id="adm-loginCard">
            <div class="adm-auth-card__deco">✿ ✦ ✿</div>
            <h2 class="adm-auth-card__title">Admin Login</h2>
            <p class="adm-auth-card__sub">restricted access</p>

            <div class="col-12 d-none" id="adm_msgdiv">
                <div class="alert alert-danger" role="alert" id="adm_msg"></div>
            </div>

            <!-- email -->
            <div class="adm-inp-wrap">
                <input type="email" id="adm_email" class="adm-inp-field" placeholder=" " required>
                <label class="adm-inp-label">Email</label>
            </div>

            <!-- password -->
            <div class="adm-inp-wrap">
                <input type="password" id="adm_password" class="adm-inp-field" placeholder=" " required>
                <label class="adm-inp-label">Password</label>
                <button type="button" class="adm-inp-eye" onclick="admTogglePw('adm_password','adm_spi1');">
                    <i id="adm_spi1" class="bi bi-eye-slash"></i>
                </button>
            </div>

            <!-- remember + forgot -->
            <div class="adm-auth-row">
                <label class="adm-auth-check">
                    <input type="checkbox" id="adm_rememberMe">
                    <span>Remember me</span>
                </label>
                <a href="#" class="adm-auth-link" onclick="admForgotPassword();">forgot password?</a>
            </div>

            <button class="adm-auth-btn" onclick="adminLogin();">Log In</button>

            <p class="adm-auth-small">
                by logging in, you agree to our
                <a href="privacypolicy.php" class="adm-auth-link">privacy policy</a>
            </p>

            <div class="adm-auth-divider"><span>or</span></div>

            <p class="adm-auth-switch">
                want to join the team?
                <a href="#" class="adm-auth-link bold" onclick="admShowRegister();">Request Access</a>
            </p>
        </div>
        <!-- /login -->


        <!-- ===== REGISTER CARD ===== -->
        <div class="adm-auth-card hidden" id="adm-registerCard">
            <div class="adm-auth-card__deco">✿ ✦ ✿</div>
            <h2 class="adm-auth-card__title">Request Access</h2>
            <p class="adm-auth-card__sub">admin registration</p>

            <!-- approval notice -->
            <div class="adm-auth-notice">
                <i class="bi bi-info-circle"></i>
                your account will be <b style="color:rgba(245,217,221,0.85);">reviewed by the super admin</b>
                before you can log in
            </div>

            <div class="col-12 d-none" id="adm_msgdiv_r">
                <div class="alert alert-danger" role="alert" id="adm_msg_r"></div>
            </div>

            <!-- name row -->
            <div class="adm-inp-row">
                <div class="adm-inp-wrap">
                    <input type="text" id="adm_fname" class="adm-inp-field" placeholder=" " required>
                    <label class="adm-inp-label">First Name</label>
                </div>
                <div class="adm-inp-wrap">
                    <input type="text" id="adm_lname" class="adm-inp-field" placeholder=" " required>
                    <label class="adm-inp-label">Last Name</label>
                </div>
            </div>

            <!-- email -->
            <div class="adm-inp-wrap">
                <input type="email" id="adm_reg_email" class="adm-inp-field" placeholder=" " required>
                <label class="adm-inp-label">Email</label>
            </div>

            <!-- password -->
            <div class="adm-inp-wrap">
                <input type="password" id="adm_reg_password" class="adm-inp-field" placeholder=" " required>
                <label class="adm-inp-label">Password</label>
                <button type="button" class="adm-inp-eye" onclick="admTogglePw('adm_reg_password','adm_spi2');">
                    <i id="adm_spi2" class="bi bi-eye-slash"></i>
                </button>
            </div>

            <!-- re-type password -->
            <div class="adm-inp-wrap">
                <input type="password" id="adm_reg_rpassword" class="adm-inp-field" placeholder=" " required>
                <label class="adm-inp-label">Re-type Password</label>
                <button type="button" class="adm-inp-eye" onclick="admTogglePw('adm_reg_rpassword','adm_spi3');">
                    <i id="adm_spi3" class="bi bi-eye-slash"></i>
                </button>
            </div>

            <button class="adm-auth-btn" onclick="adminRegister();">Submit Request</button>

            <p class="adm-auth-small">
                by registering, you agree to our
                <a href="privacypolicy.php" class="adm-auth-link">privacy policy</a>
            </p>

            <div class="adm-auth-divider"><span>or</span></div>

            <p class="adm-auth-switch">
                already have an account?
                <a href="#" class="adm-auth-link bold" onclick="admShowLogin();">Log In</a>
            </p>
        </div>
        <!-- /register -->

    </div>
    <!-- /adm-auth-panel -->

</div>
<!-- /adm-auth-page -->


<!-- forgot password modal -->
<div class="modal" tabindex="-1" id="adm_fpmodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content fp-modal-content">
            <div class="fp-modal-header">
                <div class="auth-card__deco">✿ ✦ ✿</div>
                <h5 class="fp-modal-title">Reset Password</h5>
                <p class="fp-modal-sub">set a new password for your admin account</p>
                <button type="button" class="fp-close" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="fp-modal-body">
                <div class="inp-wrap">
                    <input type="password" id="adm_np" class="inp-field" placeholder=" " required>
                    <label class="inp-label">New Password</label>
                    <button type="button" class="inp-eye" onclick="admTogglePwModal('adm_np','adm_spi4');"><i id="adm_spi4" class="bi bi-eye-slash"></i></button>
                </div>
                <div class="inp-wrap" style="margin-top:1rem;">
                    <input type="password" id="adm_rp" class="inp-field" placeholder=" " required>
                    <label class="inp-label">Re-type Password</label>
                    <button type="button" class="inp-eye" onclick="admTogglePwModal('adm_rp','adm_spi5');"><i id="adm_spi5" class="bi bi-eye-slash"></i></button>
                </div>
                <div class="inp-wrap" style="margin-top:1rem;">
                    <input type="number" id="adm_vcode" class="inp-field" placeholder=" ">
                    <label class="inp-label">Verification Code</label>
                </div>
                <p class="fp-vcode-hint">✦ check your email for the verification code</p>
            </div>
            <div class="fp-modal-footer">
                <button type="button" class="fp-btn-close" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="auth-btn fp-btn-reset" onclick="admResetPassword();">Reset Password</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/main.js"></script>
<script>

    /* ── card switch ── */
    function admShowRegister() {
        const login = document.getElementById('adm-loginCard');
        const reg   = document.getElementById('adm-registerCard');
        login.classList.add('slide-out-left');
        setTimeout(() => {
            login.classList.add('hidden');
            login.classList.remove('slide-out-left');
            reg.classList.remove('hidden');
            reg.classList.add('slide-in-right');
            setTimeout(() => reg.classList.remove('slide-in-right'), 400);
        }, 280);
    }

    function admShowLogin() {
        const login = document.getElementById('adm-loginCard');
        const reg   = document.getElementById('adm-registerCard');
        reg.classList.add('slide-out-right');
        setTimeout(() => {
            reg.classList.add('hidden');
            reg.classList.remove('slide-out-right');
            login.classList.remove('hidden');
            login.classList.add('slide-in-left');
            setTimeout(() => login.classList.remove('slide-in-left'), 400);
        }, 280);
    }

    /* ── password toggle ── */
    function admTogglePw(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    }

    function admTogglePwModal(inputId, iconId) {
        admTogglePw(inputId, iconId);
    }

    /* ── forgot password → open modal ── */
    function admForgotPassword() {
        const modal = new bootstrap.Modal(document.getElementById('adm_fpmodal'));
        modal.show();
    }

    /* ── placeholders — wire to your backend ── */
    function adminLogin()        { /* your AJAX */ }
    function adminRegister()     { /* your AJAX */ }
    function admResetPassword()  { /* your AJAX */ }

</script>
</body>
</html>