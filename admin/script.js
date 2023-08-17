let mainImage = document.querySelector('.main');
let subImages = document.querySelectorAll('.sub');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});