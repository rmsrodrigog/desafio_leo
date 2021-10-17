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

function getCourses(){
  let coursesDiv = document.getElementById('courses-grid');

  // ajax
  let request = new XMLHttpRequest();

  request.open('GET',`/sys/get-instagram-feed.php`);

  request.onload = function(){
    if(request.status >= 200 && request.status <400){
      let res = request.response;
      // Fazer foreach / map aqui;
      course = `
      <div class="course-card">
            <div class="course-img">
              <img src="${/*path image*/}">
            </div>
            <div class="course-desc">
              <h2>
                ${/*course name*/}
              </h2>
              <p>
                ${/*course desc*/}
              </p>
            </div>
            <div class="course-view-more">
              <button class="course-view-more-button">
                VER CURSO
              </button>
            </div>
          </div>
          `;

      coursesDiv.insertAdjacentHTML('beforeend',course)

    }else{
      console.log('CONNECTED TO THE SERVER, BUT, GOT AN ERROR');
    }
  };

  request.onerror = () => {
    console.log('CONNECTION ERROR');
  };

  request.send();
}

