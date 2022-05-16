// var divLoginWraper = document.getElementById("divLoginWraper");
// var divRegisternWraper = document.getElementById("divRegisternWraper");
// var divLogin = document.getElementById("divLoginWraper");
// var divRegister = document.getElementById("divRegisternWraper");

//classe d-none = display: none;

// function openLogin(){
//     divRegisternWraper.classList.add("d-none");
//     divLoginWraper.classList.remove("d-none");
// }

// function openRegister(){
//     divLoginWraper.classList.add("d-none");
//     divRegisternWraper.classList.remove("d-none");
// }

// document.divLoginWrapper.onclick = function (e) {
//     if (e.target != document.getElementById('content-area')) {
//         console.log('You clicked outside');
//     } else {
//         console.log('You clicked inside');
//     }
// }

var nav = document.getElementById('main_nav');

nav.addEventListener('click', function (){
    nav.classList.toggle('nav-items-show');
})

window.ityped.init(document.querySelector('.ityped'),{
    strings: ['parkour,','climbing,','xavi handsome'],
    loop: true
})