document.addEventListener('DOMContentLoaded', function() {
  if (window.innerWidth <= 992) {
      var groups = document.querySelectorAll('.acf-group');

      groups.forEach(function(group) {
          var groupClass = group.classList[1]; // Assuming the class is group_1, group_2, etc.
          var images = acfImageUrls[groupClass] || [];

          var items = group.querySelectorAll('.acf-item');

          items.forEach(function(item, index) {
              var imageElement = item.querySelector('.acf-image');
              if (images[index]) {
                  imageElement.style.backgroundImage = 'url("' + images[index] + '")';
                  imageElement.style.backgroundSize = 'cover';
                  imageElement.style.backgroundPosition = 'center';
                  imageElement.innerHTML = ''; // Clear the <img> tag if it exists
              }
          });
      });
  }
});




// document.addEventListener("DOMContentLoaded", () => {
//     const flexOne = document.querySelector(".one");
//     const flexTwo = document.querySelector(".two");
//     document.addEventListener("scroll", () => {
//       lastKnownScrollPosition = window.scrollY;
//       console.log(lastKnownScrollPosition);
//       if (lastKnownScrollPosition > 800) {
//         flexOne.style.display = "none";
//         flexTwo.style.display = "flex";
//       } else {
//         flexOne.style.display = "flex";
//         flexTwo.style.display = "none";
//       }
//     });
//   });

