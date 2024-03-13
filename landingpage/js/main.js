gsap.to("#div1", {
  duration: 0.5,
  x: 1000,
  y: 100,
  scale: 0.2,
  scrollTrigger: {
    trigger: "#div2",
    start: "left right",
    end: "right left",
    scrub: 0.5,
  },
});
gsap.to("#div2", {
  duration: 0.5,
  x: -1000,
  scale: 0.2,
  scrollTrigger: {
    trigger: "#div3",
    start: "left right",
    end: "right left",
    scrub: 0.5,
  },
});
gsap.to("#div3", {
  duration: 0.5,
  x: 1000,
  y: 100,
  scale: 0.2,
  scrollTrigger: {
    trigger: "#div4",
    start: "left right",
    end: "right left",
    scrub: 0.5,
  },
});
gsap.to("#div4", {
  duration: 0.5,
  x: -1000,
  scale: 0.2,
  scrollTrigger: {
    trigger: "#div5",
    start: "left right",
    end: "right left",
    scrub: 1,
  },
});
gsap.to("#div5", {
  duration: 1,
  x: 1000,
  y: 100,
  scale: 0.2,
  scrollTrigger: {
    trigger: "#div6",
    start: "left right",
    end: "right left",
    scrub: 1,
  },
});

let mybutton = document.getElementById("top");
window.onscroll = function () {
  scrollFunction();
};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
