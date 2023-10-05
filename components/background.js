window.addEventListener("load", () => {
    let startTime = Date.now(),
        frames = 0;

    function refreshFrame(){
        frames++;
        let elapsed = Date.now() - startTime;

        if (elapsed > 200){
            // Calculate current fps, show on screen, then reset everything
            let fps = frames*(1000/elapsed);
            document.getElementById("fps-counter").innerHTML = fps.toFixed(2) + " fps";
            frames = 0;
            startTime = Date.now();
        }
        requestAnimationFrame(refreshFrame);
    }
    requestAnimationFrame(refreshFrame);
});