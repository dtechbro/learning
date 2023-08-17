var preloader = document.querySelector('.loader');
window.addEventListener('load', function() {
    preloader.classList.add('loader-hidden');
    // loader.style.display = "none";
    preloader.addEventListener("transitionend", () =>{
        document.body.removeChild(document.querySelector(".loader"));
    });
});
let profile = document.querySelector('.profile');

document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}
window.onscroll = () => {
    profile.classList.remove('active');
    navbar.classList.remove('active');
}
