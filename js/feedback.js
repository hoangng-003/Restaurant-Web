$(document).ready(function () {
    const openFeedbackModal = document.getElementsByClassName('show-feedback');
    const feedbackModal = document.getElementById('feedback-modal');
    const closeFeedbackModal = document.querySelector('.feedback-modal .btn-group .btn.cancel');
    const contentFeedbackModal = document.querySelector('.feedback-modal .modal-content');

    const allStar = document.querySelectorAll('.feedback-modal .rating .star');
    const ratingValue = document.querySelector('.feedback-modal .rating input');
    const d_idElement = document.querySelector('.feedback-modal .d_id input');

    $('.show-feedback').click(function () {
        let d_id = this.attributes['d_id'].nodeValue;
        d_idElement.value = d_id;
    });

    allStar.forEach((item, idx) => {
        item.addEventListener('click', function () {
            let click = 0
            ratingValue.value = idx + 1

            allStar.forEach(i => {
                i.classList.replace('bxs-star', 'bx-star')
                i.classList.remove('active')
            })
            for (let i = 0; i < allStar.length; i++) {
                if (i <= idx) {
                    allStar[i].classList.replace('bx-star', 'bxs-star')
                    allStar[i].classList.add('active')
                } else {
                    allStar[i].style.setProperty('--i', click)
                    click++
                }
            }
        })
    })

    for (const element of openFeedbackModal) {
        element.addEventListener('click', function () {
            feedbackModal.style.display = 'flex';
            setTimeout(function () {
                feedbackModal.classList.add('show');
                // let d_id = openModalElement.attributes['d_id'].value.toString();
                // modal.querySelector('.modal-content p').innerText="Đây là món có u_id= "+ d_id;
            }, 10);
        });
    }

    closeFeedbackModal.addEventListener('click', function () {
        feedbackModal.classList.remove('show');
        feedbackModal.style.display = 'none';
    });

    contentFeedbackModal.addEventListener('click', function (e){
        e.stopPropagation();
    });

    feedbackModal.addEventListener('click', function (){
        feedbackModal.classList.remove("show");
        feedbackModal.style.display = 'none';
    })
});

function validateFormFeedBack() {
    let opinion = document.forms["feedback-form"]["opinion"].value;
    let rating = document.forms["feedback-form"]["rating"].value;
    if (opinion == "" && rating == "") {
        alert("Data should not be empty!");
        return false;
    }
}

