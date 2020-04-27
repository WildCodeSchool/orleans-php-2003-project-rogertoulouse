window.onscroll = function() {scrollFunction()};
const title = document.getElementById("titleBanner");
function scrollFunction() {
    if (document.body.scrollTop > 110 || document.documentElement.scrollTop > 110) {
        title.style.fontSize = "30px";
        title.style.position = "fixed";
        title.style.top = "10px";
        title.style.zIndex = "4";
    } else {
        title.style.fontSize = "90px";
    }
}