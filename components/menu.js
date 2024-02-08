// MENU INTERACTIONS
let animationStart, currentFrame;

function toggleMenu(){
    if (document.getElementById("filter-menu").classList.contains("active") && !document.getElementById("filter-menu").classList.contains("closing")){
        // Check if anything has changed in the form: if so, submit
        let form = document.getElementById("menu-outline").querySelector("form");
        form.submit();

    } else if (!document.getElementById("filter-menu").classList.contains("closing")){
        cancelAnimationFrame(currentFrame);
        animationStart = Date.now();
        
        document.getElementById("menu-outline").style.visibility = "visible";
        document.getElementById("menu-overlay").style.visibility = "visible";
        document.getElementById("filter-menu").classList.add("active");
        currentFrame = requestAnimationFrame(animateOpen);
    }
}
function animateOpen(){
    let duration = 300,
        elapsed = Date.now() - animationStart,
        progress = elapsed/duration;
        
    document.getElementById("menu-outline").style.maxHeight = document.getElementById("menu-outline").scrollHeight*progress + "px";

    if (elapsed <= duration/2){
        document.getElementById("menu-overlay").style.opacity = 0.4*progress;
    } else {
        document.getElementById("menu-overlay").style.opacity = 0.2;
    }
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
        document.getElementById("menu-overlay").style.opacity = 0.2*(1-progress);
    } else {
        document.getElementById("menu-overlay").style.opacity = 0;
        document.getElementById("menu-overlay").style.visibility = "hidden";
    }
    if (elapsed <= duration){
        currentFrame = requestAnimationFrame(animateClose);
    } else {
        document.getElementById("filter-menu").classList.remove("closing");
        document.getElementById("filter-menu").classList.remove("active");
        document.getElementById("menu-outline").style.maxHeight = "0px";
        document.getElementById("menu-outline").style.visibility = "hidden";
    }
}
document.addEventListener("scroll", (e) => {
    if (document.getElementById("filter-menu").classList.contains("active") && !document.getElementById("filter-menu").classList.contains("closing")){
        cancelAnimationFrame(currentFrame);
        animationStart = Date.now();
            
        document.getElementById("filter-menu").classList.add("closing");
        currentFrame = requestAnimationFrame(animateClose);
    }
});
document.getElementById("menu-overlay").addEventListener("click", (e) => {
    if (document.getElementById("filter-menu").classList.contains("active") && !document.getElementById("filter-menu").classList.contains("closing")){
        cancelAnimationFrame(currentFrame);
        animationStart = Date.now();
            
        document.getElementById("filter-menu").classList.add("closing");
        currentFrame = requestAnimationFrame(animateClose);
    }
});

document.getElementById("close-filter-menu").addEventListener("click", (e) => {
    if (document.getElementById("filter-menu").classList.contains("active") && !document.getElementById("filter-menu").classList.contains("closing")){
        cancelAnimationFrame(currentFrame);
        animationStart = Date.now();
            
        document.getElementById("filter-menu").classList.add("closing");
        currentFrame = requestAnimationFrame(animateClose);
    }
});