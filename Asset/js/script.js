let input = document.getElementById("input");


function validation() {
    if (input.value == "") {
        errorText.innerText = 'Please Input';
        username.classList.remove("valid");
        password.classList.add("valid");
        password.focus();
    } else if (input.value) {
        formlogin.submit();
    }


}