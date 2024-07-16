document.addEventListener("DOMContentLoaded", () => {
    const flexOne = document.querySelector(".one");
    const flexTwo = document.querySelector(".two");
    document.addEventListener("scroll", () => {
      lastKnownScrollPosition = window.scrollY;
      console.log(lastKnownScrollPosition);
      if (lastKnownScrollPosition > 800) {
        flexOne.style.display = "none";
        flexTwo.style.display = "flex";
      } else {
        flexOne.style.display = "flex";
        flexTwo.style.display = "none";
      }
    });
  });