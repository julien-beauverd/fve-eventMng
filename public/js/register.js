function detectIfregisterOK() {
    var register = document.getElementById('registerOK');
    if (register.innerHTML.indexOf("OK") !== -1) {
        $("#Modalregister").modal();
    }
}

window.onload = function () {
    detectIfregisterOK();
};

$(document).ready(function () {

    $("#password").on("change keyup paste", function () {

        if (this.value.match(/[a-z]/g) &&
            this.value.match(/[0-9]/g) &&
            this.value.match(/[A-Z]/g) &&
            this.value.length >= 8) {
            this.style.backgroundColor = '#28a745';
            this.style.border = 0;
        } else if (this.value == '') {
            this.style.backgroundColor = '#FFFFFF';
        } else {
            this.style.backgroundColor = '#dc3545';
            this.style.border = 0;
        }
    })

    $("#password_confirm").on("change keyup paste", function () {

        if (this.value.match(/[a-z]/g) &&
            this.value.match(/[0-9]/g) &&
            this.value.match(/[A-Z]/g) &&
            this.value.length >= 8 &&
            this.value == document.getElementById('password').value) {
            this.style.backgroundColor = '#28a745';
            this.style.border = 0;
        } else if (this.value == '') {
            this.style.backgroundColor = '#FFFFFF';
        } else {
            this.style.backgroundColor = '#dc3545';
            this.style.border = 0;
        }
    })


});
