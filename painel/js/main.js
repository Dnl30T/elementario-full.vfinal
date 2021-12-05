const open_aside = document.querySelector("div.open_aside");
const close_aside = document.querySelector("div.close_aside");
const aside = document.querySelector("aside");

open_aside.addEventListener("click",()=>{ aside.style.left = "0%"; });
close_aside.addEventListener("click",()=>{ aside.style.left = "-100%"; });