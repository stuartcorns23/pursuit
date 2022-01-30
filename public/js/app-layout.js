"use strict";

const sidebar = document.querySelector(".sidebar-wrapper");
const topbar = document.querySelector(".topbar");
const page = document.querySelector(".page-wrapper");
const footer = document.querySelector(".page-footer");

if (window.innerWidth < 568) {
    sidebar.style.width = "100vw";
    sidebar.style.left = "-100%";
    page.style.marginLeft = 0;
    topbar.style.left = 0;
    footer.style.left = 0;
}
