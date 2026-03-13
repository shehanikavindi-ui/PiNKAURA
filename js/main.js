//  button actions
function gotoIndex() {
    window.location = "index.php";
}
function gotoHome() {
    window.location = "home.php";
}
function gotoAdminRegister() {
    window.location = "adminSignIn.php";
}
function gotoAdminPanel() {
    window.location = "adminPanel.php";
}


// customer login & registration
function showRegister() {
    const login = document.getElementById('loginCard');
    const reg = document.getElementById('registerCard');
    login.classList.add('slide-out-left');
    setTimeout(() => {
        login.classList.add('hidden');
        login.classList.remove('slide-out-left');
        reg.classList.remove('hidden');
        reg.classList.add('slide-in-right');
        setTimeout(() => reg.classList.remove('slide-in-right'), 450);
    }, 300);
}

function showLogin() {
    const login = document.getElementById('loginCard');
    const reg = document.getElementById('registerCard');
    reg.classList.add('slide-out-right');
    setTimeout(() => {
        reg.classList.add('hidden');
        reg.classList.remove('slide-out-right');
        login.classList.remove('hidden');
        login.classList.add('slide-in-left');
        setTimeout(() => login.classList.remove('slide-in-left'), 450);
    }, 300);
}
function login() {

    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("em", email.value);
    form.append("pw", password.value);
    form.append("rm", rememberMe.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    }

    request.open("POST", "signInProcess.php", true);
    request.send(form);

}
function register() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("reg_email");
    var password = document.getElementById("reg_password");
    var repeatpw = document.getElementById("reg_rpassword");

    var form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("em", email.value);
    form.append("pw", password.value);
    form.append("rpw", repeatpw.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
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
                    title: "Saving User Details"
                });
                setTimeout(function () {
                    gotoIndex();
                }, 1500);

            } else {
                document.getElementById("msg_r").innerHTML = response;
                document.getElementById("msgdiv_r").className = "d-block";
            }
        }
    }

    request.open("POST", "registerProcess.php", true);
    request.send(form);

}




//  forgot password?
var forgotPasswordModal;
function forgotPassword() {

    var email = document.getElementById("email");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-start",
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
                    title: "verification coding sending",
                    text: "check your mail box"
                });
                setTimeout(function () {
                    var modal = document.getElementById("fpmodal");
                    forgotPasswordModal = new bootstrap.Modal(modal);
                    forgotPasswordModal.show();
                }, 1500);

            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    }
    request.open("GET", "forgotPasswordProcess.php?email=" + email.value, true);
    request.send();
}
function resetPassword() {

    var email = document.getElementById("email");
    var newPw = document.getElementById("np");
    var retypedPw = document.getElementById("rp");
    var vcode = document.getElementById("vcode");

    var form = new FormData();
    form.append("em", email.value);
    form.append("np", newPw.value);
    form.append("rp", retypedPw.value);
    form.append("vc", vcode.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.response;
            if (response == "success") {
                Swal.fire({
                    title: "Good job!",
                    text: "Password Updated Successfully",
                    icon: "success"
                });
                forgotPasswordModal.hide();
            } else {
                document.getElementById("msg2").innerHTML = response;
                document.getElementById("msgdiv2").className = "d-block";
            }
        }
    }

    request.open("POST", "resetPasswordProcess.php", true);
    request.send(form);
}

//  show password buttons
function sp1() { // login
    var pw = document.getElementById("password");
    var pwicon = document.getElementById("spi1");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}
function sp2() { // fp modal
    var pw = document.getElementById("np");
    var pwicon = document.getElementById("spi2");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}
function sp3() { //fp modal
    var pw = document.getElementById("rp");
    var pwicon = document.getElementById("spi3");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}
function sp4() { //user profile
    var pw = document.getElementById("pwd");
    var pwicon = document.getElementById("spi4");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}
function sp5() { //register
    var pw = document.getElementById("password");
    var pwicon = document.getElementById("spi5");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}
function sp6() { //register
    var pw = document.getElementById("repeatpw");
    var pwicon = document.getElementById("spi6");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash";
    }
}
function sp7() { //admin-signin
    var pw = document.getElementById("pw");
    var pwicon = document.getElementById("spi7");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye text-light";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash text-light";
    }
}
function sp8() { //admin-reg
    var pw = document.getElementById("pw");
    var pwicon = document.getElementById("spi8");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye text-light";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash text-light";
    }
}
function sp9() { //admin-reg
    var pw = document.getElementById("rpw");
    var pwicon = document.getElementById("spi9");

    if (pw.type == "password") {
        pw.type = "text";
        pwicon.className = "bi bi-eye text-light";
    } else {
        pw.type = "password";
        pwicon.className = "bi bi-eye-slash text-light";
    }
}

