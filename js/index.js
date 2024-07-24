// search button ek ganna
 let searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
}
 
// login page ek
let loginForm = document.querySelector('.login-form-container');

// login page ek visible wenna
document.querySelector('#login-btn').onclick=()=>{
    loginForm.classList.toggle('active');
}
// login ek cut krnna
document.querySelector('#close-login-btn').onclick=()=>{
  window.location.href = 'home_page.php';
    loginForm.classList.toggle('active');
}


window.onscroll = () =>{
    searchForm.classList.remove('active');
    if(window.scrollY > 80)
    {
        document.querySelector('.header .header-2').classList.add('active');
    }
    else
    {
        document.querySelector('.header .header-2').classList.remove('active');
    }
}
//onload function eka
window.onload = () =>{
    if(window.scrollY > 80)
    {
        document.querySelector('.header .header-2').classList.add('active');
    }
    else
    {
        document.querySelector('.header .header-2').classList.remove('active');
    }
 fadeOut();
}

// loader fuction
function loader(){
    document.querySelector('.loader-container').classList.add('active');
}
function fadeOut(){
    setTimeout(loader,500);
}


// swiper
var swiper = new Swiper(".stationery-slider", {
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:2000,
        disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });

//   featured slide swiper
var swiper = new Swiper(".featured-slider", {
    spaceBetween: 10,
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:2000,
        disableOnInteraction: false,
    },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      450: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 4,
      },
    },
  });

//   arrivals slide swipper
var swiper = new Swiper(".arrivals-slider", {
    spaceBetween: 10,
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:2000,
        disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });

//   reviews slider swiper
var swiper = new Swiper(".reviews-slider", {
    spaceBetween: 10,
    grabCursor: true,
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:7000,
        disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });

//   blogs swiper section
  var swiper = new Swiper(".blogs-slider", {
    spaceBetween: 10,
    grabCursor: true,
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:7000,
        disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });