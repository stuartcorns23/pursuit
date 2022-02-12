"use strict";

const menuBtn = document.querySelector(".menuBtn");
const sidebar = document.querySelector(".sidebar-wrapper");
const closeMenu = document.querySelector(".closeMenu");

menuBtn.addEventListener("click", (item) => {
    sidebar.classList.remove("d-none");
});

closeMenu.addEventListener("click", (item) => {
    sidebar.classList.add("d-none");
});
