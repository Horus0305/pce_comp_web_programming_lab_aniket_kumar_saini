document.addEventListener("DOMContentLoaded", function() {
  const heartIcons = document.querySelectorAll(".like-button .heart-icon");

  heartIcons.forEach(heartIcon => {
      heartIcon.addEventListener("click", () => {
          heartIcon.classList.toggle("liked");
      });
  });
});
