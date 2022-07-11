
// Toggling navbar visibility

//const navbarToggle = document.querySelector('#navbar-toggle');
// let isNavbarExpanded = navbarToggle.getAttribute('aria-expanded') === 'true';

// const toggleNavbarVisibility = () => {
//   isNavbarExpanded = !isNavbarExpanded;
//   navbarToggle.setAttribute('aria-expanded', isNavbarExpanded);
// }

// navbarToggle.addEventListener('click', toggleNavbarVisibility);

// -----------
// const navbarMenu = document.querySelector('#navbar-menu');
// const navbarLinksContainer = navbarMenu.querySelector('.navbar-links');

// navbarLinksContainer.addEventListener('click', (e) => e.stopPropagation());
// navbarMenu.addEventListener('click', toggleNavbarVisibility);
const menu = document.querySelector("#navbar-menu");
const button = document.querySelector('#toggle-icon');
button.addEventListener("click", () => {
  button.classList.toggle("rotate-icon");
  menu.classList.toggle("visible");
})





// const toggler = document.querySelector('#navbar-toggle');
// const menu = document.querySelector("#navbar-menu");
// menu.classList = "invisible";
// toggler.addEventListener("click", () => {
//   menu.classList.toggle("invisible");
// });



// TOGGLE MENU
// let toggler = document.querySelector(".toggle-btn");
// let menu = document.querySelector(".vertical-nav-container");
// menu.classList = "invisible";
// toggler.addEventListener("click", () => {
//   menu.classList.toggle("invisible");
// });