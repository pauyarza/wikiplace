var nav = document.getElementById('main_nav');

nav.addEventListener('click', function (){
    nav.classList.toggle('nav-items-show');
})

window.ityped.init(document.querySelector('.ityped'),{
    strings: ['parkour','climbing','xavi handsome'],
    loop: true
})


function openMenu(){

    $("#menu").toggleClass("d-none");
}