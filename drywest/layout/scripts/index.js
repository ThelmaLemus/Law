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

function validDesc(e){
    if (e.value.length > 500) {
        e.value = e.value.substr(0, 500);
        alert("Favor escribir un máximo de 500 caracteres");
    }
}


function fillUserInfo(info){
    console.log(info);
    var dpi_p = /\d{4} \d{5} \d{4}/g;
    var dpi = info.match(dpi_p);
    var findpi = info.search(dpi[0]) + 15;
    info = info.substring(findpi);
    info = info.substring(info.search("BRE"));
    var name = info.match(/[A-Z]+ [A-Z]+/g);
    document.getElementById('inputDPI').value = dpi[0];
    document.getElementById('inputName').value = name[0];
    // debugger
}