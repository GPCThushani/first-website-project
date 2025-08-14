
let currentIndex = 0;

function moveCarousel(direction) {
  const cardContainer = document.querySelector('.card-container');
  const cards = document.querySelectorAll('.card');
  const cardWidth = cards[0].offsetWidth + 20; // Including margin
  const visibleCards = 3; // Adjust based on how many cards should be visible at once
  const maxIndex = cards.length - visibleCards; // Calculate max slide index

  // Update current index within bounds
  currentIndex = Math.min(Math.max(currentIndex + direction, 0), maxIndex);

  // Apply the transform to slide the cards
  cardContainer.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
}
