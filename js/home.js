
function assistir(url){
    let modal = document.querySelector(".modal");
    modal.style.display = "flex";
    let video = document.querySelector(".video");
    video.src = url;
    video.autoplay = true;

    video.addEventListener("timeupdate",() => {
        if(video.currentTime>10){
            video.currentTime = 0;
            video.src = "";
            modal.style.display = "none";
            alert("Compre o video para continuar");
        }
    })
   
}

let audio = new Audio();
function tocar(url){
    audio.src = url;
    audio.play();

    setTimeout(() => {
        audio.pause();
        alert("compre o audio para escutar");
    },10000)
}