function passwordConfirmation(pass1, pass2){
    active =  pass1==pass2?true:false;
    if(active == false){
        document.getElementById("regbut").setAttribute("disabled", "true");
        document.getElementById("pass2check").style.display = "flex";
    }else{
        document.getElementById("regbut").removeAttribute("disabled");
        document.getElementById("pass2check").style.display = "none";
    }
}