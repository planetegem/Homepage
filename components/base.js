function toggleCoding(element){
    element.parentElement.classList.add("opened");

    let next = element.parentElement.parentElement.getElementsByClassName("coding-field")[0];
    next.style.maxHeight = next.scrollHeight + "px";
    next.scrollIntoView({behavior: "smooth", block: "center"});
}

let animationAllowed = false;
function checkInView(delay = 0){
    let hiddenEntries = document.getElementsByClassName("hidden"),
        amountHidden = hiddenEntries.length;
    if (animationAllowed){
        if (amountHidden > 0){
            // Consider revealing entry
            for (let i = 0; i < amountHidden; i++){
                let currentElement = hiddenEntries[i],
                    yPos = currentElement.getBoundingClientRect().top;
                if (yPos < window.innerHeight*0.90){
                    setTimeout(() => {
                        currentElement.classList.add("visible");
                    }, i*delay);
                }
            }
        }
        // Clean classes
        for (let i = amountHidden -1; i >= 0; i--){
            if (hiddenEntries[i].classList.contains("visible")){
                hiddenEntries[i].classList.remove("hidden");
            }
        }
    }
}
// Wait for bg animation to finish, then start considering inventory items
setTimeout(() => {
    animationAllowed = true;
    checkInView(200);
}, 2200);
window.addEventListener("scroll", checkInView);

// Reset scroll after reload (for F5ers)
history.scrollRestoration = "manual";
window.scrollTo(0, 0);

