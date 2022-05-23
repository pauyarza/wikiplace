function checkMenu(){
    var x = window.matchMedia("only screen and (min-width: 801px)");

    if (x.matches) { // If media query matches
        $("#menu").removeClass("d-none");
    }
}

function openMenu(){

    $("#menu-bar").toggleClass("menu-bar-show");
    $("#menu").toggleClass("d-none");
}




