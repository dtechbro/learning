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

let mainImage = document.querySelector('.main');
let subImages = document.querySelectorAll('.sub');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});