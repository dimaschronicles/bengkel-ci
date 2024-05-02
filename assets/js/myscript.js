function showPassLogin() {
    var pass = document.getElementById("password");
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}

function showPassReg() {
    var pass = document.getElementById("password");
    var passConf = document.getElementById("password_conf");
    if (pass.type === "password" || passConf.type === "password") {
        pass.type = "text";
        passConf.type = "text";
    } else {
        pass.type = "password";
        passConf.type = "password";
    }
}