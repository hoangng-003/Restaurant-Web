$(document).ready(function () {
    const openReviewModal = document.getElementsByClassName('openModal');
    const reviewModal = document.getElementById('review-modal');
    const closeReviewModal = document.querySelector('.review-modal .close');
    const contentReviewModal = document.querySelector('.review-modal .modal-content');

    for (const element of openReviewModal) {
        element.addEventListener('click', function () {
            reviewModal.style.display = 'flex';
            for (const reviewElement of reviewModal.querySelectorAll('[d_id]')) {
                if (reviewElement.attributes['d_id'].nodeValue == element.attributes['d_id'].nodeValue) {
                    reviewElement.style.display = 'flex';
                }
            }
        });
    }
    closeReviewModal.addEventListener('click', function () {
        setTimeout(function () {
            reviewModal.style.display = 'none';
            for (const element of reviewModal.querySelectorAll('[d_id]')) {
                element.style.display = 'none';
            }
            ;
        }, 10);
    });

    contentReviewModal.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    reviewModal.addEventListener('click', function (e) {
        reviewModal.style.display = 'none';
        for (const element of reviewModal.querySelectorAll('[d_id]')) {
            element.style.display = 'none';
        }
    });
});


