const downArrows = document.querySelectorAll(".downarrow");
const allNotif = document.querySelector(".allnotif");

downArrows.forEach((arrow, index) => {
    prompt("H")
    arrow.addEventListener("click", () => {
        const scrollAmount = index === 0 ? allNotif.scrollWidth : -allNotif.scrollWidth;
        allNotif.scrollBy({
            left: scrollAmount,
            behavior: "smooth"
        });
    });
});