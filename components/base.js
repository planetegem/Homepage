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
history.scrollRestoration = "manual";
window.addEventListener("load", () => {
    setTimeout(() => {
        animationAllowed = true;
        checkInView(200);
    }, 2200);
    window.scrollTo(0, 0);
});
window.addEventListener("scroll", checkInView);