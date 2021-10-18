// Swiper slider initialization
// Popup functions

function openModal(popupId){
  let popup = document.getElementById(popupId);
  popup.style.display = 'block';
}

function closeModal(popupId){
  let popup = document.getElementById(popupId);
  popup.style.display = 'none';
}

var backgroundImageUrl;

function previewFile() {
  var preview = document.querySelector('img#preview');
  var backgroundImg = document.querySelector('#background-img');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    backgroundImg.value = reader.result;
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}

