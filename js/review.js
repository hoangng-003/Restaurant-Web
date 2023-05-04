const openModal = document.getElementsByClassName('openModal');
const modal = document.getElementById('modal');
const closeModal = document.querySelector('.close');

for (const openModalElement of openModal) {
    openModalElement.addEventListener('click', function () {
        modal.style.display = 'flex';
        for (const element of modal.querySelectorAll('[d_id]')) {
            if (element.attributes['d_id'].nodeValue == openModalElement.attributes['d_id'].nodeValue) {
                element.style.display = 'flex';
            }
        }
    });
}
closeModal.addEventListener('click', function () {
    setTimeout(function () {
        modal.style.display = 'none';
        for (const element of modal.querySelectorAll('[d_id]')) {
            element.style.display = 'none';
        }
        ;
    }, 10);
});

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = 'none';
        for (const element of modal.querySelectorAll('[d_id]')) {
            element.style.display = 'none';
        }
    }
};

