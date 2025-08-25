document.getElementById("btn-login").addEventListener("click", function() {
    document.querySelector('.buttons-container').style.display = "none";
    document.getElementById("form-login").style.display = "block";
    document.getElementById("form-registro").style.display = "none";
});

document.getElementById("btn-registro").addEventListener("click", function() {
    document.querySelector('.buttons-container').style.display = "none";
    document.getElementById("form-login").style.display = "none";
    document.getElementById("form-registro").style.display = "block";
});
