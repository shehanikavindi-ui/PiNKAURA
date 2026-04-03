// Go to
function gotoHome(){
    window.location = 'home.html';
}

// ========== Switch Contents ==============
function showRegister() {  // (index.html)
    document.querySelector('.login-sec-container').classList.add('d-none');
    document.querySelector('.verification-sec-container').classList.add('d-none');
    document.querySelector('.register-sec-container').classList.remove('d-none');
}
function showLogin() {  // (index.html)
    document.querySelector('.register-sec-container').classList.add('d-none');
    document.querySelector('.verification-sec-container').classList.add('d-none');
    document.querySelector('.login-sec-container').classList.remove('d-none');
}


// ======== Show Passowrd btns ===============
function showPwLogin(){ // customer login
    var pw = document.getElementById("l_password");
    var pwicon = document.getElementById("l_password_icon");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}
function showPwReg1(){ // customer register
    var pw = document.getElementById("r_password");
    var pwicon = document.getElementById("r_password_icon");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}
function showPwReg2(){ // customer register
    var pw = document.getElementById("r_repassword");
    var pwicon = document.getElementById("r_repassword_icon");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}
function showPwFp1(){ // forogot pw modal
    var pw = document.getElementById("fp_password");
    var pwicon = document.getElementById("fp_password_icon");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}
function showPwFp2(){ // forogot pw modal
    var pw = document.getElementById("fp_repassword");
    var pwicon = document.getElementById("fp_repassword_icon");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}


// =================== (index.html) =====================

// Customer Registration
function customerRegister(){
    var fname = document.getElementById("r_fname");
    var lname = document.getElementById("r_lname");
    var email = document.getElementById("r_email");
    var password = document.getElementById("r_password");
    var repeatPassword = document.getElementById("r_repassword");

    var form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("em", email.value);
    form.append("pw", password.value);
    form.append("rpw", repeatPassword.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "Account Created Successfully ❀˖°"
                });
                setTimeout(function() {
                    showVerify(email.value);
                }, 1500);
            }else{
                document.getElementById("msg2").innerHTML = response;
                document.getElementById("msgdiv2").className = "d-block";
            }
        }
    }
    request.open("POST", "customerRegisterProcess.php", true);
    request.send(form);
}
// Customer Account Verification
function showVerify(email) {
    document.querySelector('.register-sec-container').classList.add('d-none');
    document.querySelector('.login-sec-container').classList.add('d-none');
    document.querySelector('.verification-sec-container').classList.remove('d-none');

    document.getElementById("verify_email").value = email;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4){
            var response = request.responseText;
            if (response == "success") {
                
            }else {
                document.getElementById("msg2").innerHTML = response;
                document.getElementById("msgdiv2").className = "d-block";
            }
        }
    }
    request.open("GET", "customerVcodeProcess.php?email=" + email, true);
    request.send();
}
function verifyAccount() {

    var email = document.getElementById("verify_email");
    var vcode = document.getElementById("vcode");

    var form = new FormData();
    form.append("em", email.value);
    form.append("vc", vcode.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "Account Verified ❀˖°"
                });
                setTimeout(function() {
                    gotoHome();
                }, 1500);
            } else {
                document.getElementById("msg3").innerHTML = response;
                document.getElementById("msgdiv3").className = "d-block";
            }
        }
    }
    request.open("POST", "customerVerifyProcess.php", true);
    request.send(form);
}
// Customer Login
function customerLogin(){

    var email = document.getElementById("l_email");
    var password = document.getElementById("l_password");
    var rememberMe = document.getElementById("l_rememberMe");

    var form = new FormData();
    form.append("em", email.value);
    form.append("pw", password.value);
    form.append("rm", rememberMe.checked);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4){
            var response = request.responseText;
            if (response == "success") {
                gotoHome();
            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    }
    request.open("POST", "customerLoginProcess.php", true);
    request.send(form);
}
// forogot password modal
var forgotPasswordModal;
function forgotPassword(){
    var email = document.getElementById("l_email");
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "verification code sending",
                    text: "check your mail box"
                });
                setTimeout(function() {
                    var modal = document.getElementById("fpModal");
                    forgotPasswordModal = new bootstrap.Modal(modal);
                    forgotPasswordModal.show();
                }, 1500);

            } else {
                document.getElementById("msg4").innerHTML = response;
                document.getElementById("msgdiv4").className = "d-block";
            }
        }
    }
    request.open("GET", "forgotPasswordProcess.php?email=" + email.value, true);
    request.send();
}
// Customer password reset
function PasswordReset(){  
    var email = document.getElementById("l_email");
    var newPw = document.getElementById("fp_password");
    var rePw = document.getElementById("fp_repassword");
    var vcode = document.getElementById("fp_vcode");

    var form = new FormData();
    form.append("em", email.value);
    form.append("pw", newPw.value);
    form.append("rpw", rePw.value);
    form.append("vc", vcode.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Your Password has been reset!",
                    text: "Login with your new password",
                    icon: "success"
                });
                forgotPasswordModal.hide();
            } else {
                document.getElementById("msg4").innerHTML = response;
                document.getElementById("msgdiv4").className = "d-block";
            }
        }
    }
    request.open("POST", "customerPasswordResetPwProcess.php", true);
    request.send(form);
}
// =================== (index.html) =====================
