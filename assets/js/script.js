//partie personalisation du curseur 
const cursorIn = document.querySelector(".cursor-in");
const cursorOut = document.querySelector(".cursor-out");

document.getElementById("first-view").addEventListener("mousemove", e =>{
    cursorIn.style.visibility  = "visible";
    cursorOut.style.visibility = "visible";

    /*e.pageY la valeur de px du curseur a partir du haut
    e.pageX la valeur de px du curseur a partir du droit*/
    cursorIn.style.top   = e.pageY + "px";
    cursorIn.style.left  = e.pageX + "px";

    cursorOut.style.top  = e.pageY + "px";
    cursorOut.style.left = e.pageX + "px";
})
document.getElementById("first-view").addEventListener("mouseleave",e =>{
    cursorIn.style.visibility  = "hidden";
    cursorOut.style.visibility = "hidden";
})

//partie form sign in/ sign up
document.getElementById("btn-slide").addEventListener("click",()=>{
    let slideTitle = document.querySelector("#slide-title");
    let slideForm = document.querySelector(".slide-form");
    let btnSlide = document.querySelector("#btn-slide");

    if(btnSlide.innerHTML == "s'inscrire")
        btnSlide.innerHTML = "se connecter";
    else 
        btnSlide.innerHTML = "s'inscrire"

    if(slideTitle.innerHTML == "Avez vous deja un compte ?")
        slideTitle.innerHTML = "Creer un compte";
    else
    slideTitle.innerHTML = "Avez vous deja un compte ?"

    if(slideForm.style.left == "0px")
        slideForm.style.left = "50%";
    else
        slideForm.style.left = "0px"
})
document.querySelector(".close").addEventListener("click",()=>{
    document.querySelector(".popup-form").style.display = "none";
})
document.querySelector(".sinscrire").addEventListener("click",()=>{
    if(document.querySelector("#btn-slide").innerHTML=="s'inscrire")
    document.getElementById("btn-slide").click();

    document.querySelector(".popup-form").style.display = "flex";
})
document.querySelector(".seconnecter").addEventListener("click",()=>{
    if(document.querySelector("#btn-slide").innerHTML=="se connecter")
    document.getElementById("btn-slide").click();

    document.querySelector(".popup-form").style.display = "flex";
})

// form validation using Parsley
$('#formSignup').parsley();