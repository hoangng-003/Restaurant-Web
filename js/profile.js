$(document).ready(function () {
    const openProfileModal = document.getElementById('open-profile-modal');

    const profileModal = document.getElementById('profile-modal');
    const closeProfileModal = document.querySelector('.profile-modal .close');

    const contentProfileModal = document.querySelector('.profile-modal .modal-content');


    openProfileModal.addEventListener('click', function (e) {
        profileModal.style.display = 'flex';
    });

    closeProfileModal.addEventListener('click', function () {
        setTimeout(function () {
            profileModal.style.display = 'none';
        }, 10);
    });

    contentProfileModal.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    profileModal.onclick = function (){
        profileModal.style.display = 'none';
    }
});

