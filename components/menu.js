// MENU INTERACTIONS
let animationStart, currentFrame;

function toggleMenu(){
    if (document.getElementById("filter-menu").classList.contains("active") && !document.getElementById("filter-menu").classList.contains("closing") ){
        cancelAnimationFrame(currentFrame);
        animationStart = Date.now();
        
        document.getElementById("filter-menu").classList.add("closing");
        currentFrame = requestAnimationFrame(animateClose);
    } else {
        cancelAnimationFrame(currentFrame);
        animationStart = Date.now();
        
        document.getElementById("menu-outline").style.visibility = "visible";
        document.getElementById("filter-menu").classList.add("active");
        currentFrame = requestAnimationFrame(animateOpen);
    }
}
function animateOpen(){
    let duration = 200,
        elapsed = Date.now() - animationStart,
        progress = elapsed/duration;
        
    document.getElementById("menu-outline").style.maxHeight = document.getElementById("menu-outline").scrollHeight*progress + "px";

    if (elapsed <= duration){
        currentFrame = requestAnimationFrame(animateOpen);
    } else {
        document.getElementById("menu-outline").style.maxHeight = document.getElementById("menu-outline").scrollHeight + "px";
        cancelAnimationFrame(currentFrame);
    }
}
function animateClose(){
    let duration = 200,
        elapsed = Date.now() - animationStart,
        progress = elapsed/duration;
        
    document.getElementById("menu-outline").style.maxHeight = document.getElementById("menu-outline").scrollHeight*(1-progress) + "px";
    
    
    if (elapsed <= duration){
        currentFrame = requestAnimationFrame(animateClose);
    } else {
        document.getElementById("filter-menu").classList.remove("closing");
        document.getElementById("filter-menu").classList.remove("active");
        document.getElementById("menu-outline").style.maxHeight = "0px";
        document.getElementById("menu-outline").style.visibility = "hidden";
    }
}