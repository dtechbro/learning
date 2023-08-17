var preloader = document.querySelector('.loader');
window.addEventListener('load', function() {
    preloader.classList.add('loader-hidden');
    // loader.style.display = "none";
    preloader.addEventListener("transitionend", () =>{
        document.body.removeChild(document.querySelector(".loader"));
    });
});
