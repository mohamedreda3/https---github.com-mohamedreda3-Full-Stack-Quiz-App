let navbar = document.querySelector(".navbar");
let barsBtn = navbar.querySelector(".head .bars");

barsBtn.addEventListener("click", () => {
    navbar.classList.toggle("active");
});

let accoutContainer = document.querySelectorAll('.account__container') ?? null;

accoutContainer != null ?
    accoutContainer.forEach(item => item.onmouseover = function (e) {
        console.log("ClientX ", e.layerX);
        let offsetx = e.clientX;
        let offsetY = e.clientY;
        let width = e.currentTarget.clientWidth;
        let height = e.currentTarget.clientHeight;
        e.currentTarget.style.transform = `perspective(1000px) rotateX(${(+1*25*(offsetx - ((width/2)+e.currentTarget.offsetLeft))/(width/2))}deg) rotateY(${(-1*25*(offsetY - ((height/2)+e.currentTarget.offsetTop)))/(height/2)}deg) scale(1.1)`;
    })
    : null

accoutContainer != null ?
    accoutContainer.forEach(item => item.onmouseleave = function (e) {
        e.currentTarget.style.transform = `rotateX(0deg) scale(1)`;
    })
    : null