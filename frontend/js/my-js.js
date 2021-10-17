// Swiper slider initialization
var swiper = new Swiper(".mySwiper", {
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination"
  }
});

// Popup functions

function openModal(popupId){
  let popup = document.getElementById(popupId);
  popup.style.display = 'block';
}

function closeModal(popupId){
  let popup = document.getElementById(popupId);
  popup.style.display = 'none';
}


