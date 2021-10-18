// Swiper slider initialization
// Popup functions

function checkModal(){
  const date = new Date();
  date.setTime(date.getTime() + (1*24*60*60*1000));
  let expires = "expires="+ date.toUTCString();
  document.cookie = "sawModal=true;"+expires;
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function openModal(popupId) {
  let popup = document.getElementById(popupId);
  popup.style.display = 'block';
}

function closeModal(popupId) {
  let popup = document.getElementById(popupId);
  popup.style.display = 'none';
}

var backgroundImageUrl;

function previewFile() {
  var preview = document.querySelector('img#preview');
  var backgroundImg = document.querySelector('#background-img');
  var file    = document.querySelector('#couse_img').files[0];
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

function previewFileUser() {
  var preview = document.querySelector('img#previewUser');
  var backgroundImg = document.querySelector('#background-img-user');
  var file    = document.querySelector('#user_img').files[0];
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

