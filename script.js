function validateLogin() {
    if (document.getElementById("email").value === "") {
        alert("Please enter email");
        return false;
    }
    if (document.getElementById("password").value === "") {
        alert("Please enter password");
        return false;
    }
    return true;
}

function validateReward() {
    if (document.getElementById("description").value === "") {
        alert("Enter reward description");
        return false;
    }
    if (document.getElementById("points").value === "") {
        alert("Enter points");
        return false;
    }
    return true;
}
