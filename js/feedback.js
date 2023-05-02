$(document).ready(function () {
    const openModal = document.getElementsByClassName('show-feedback');
    const modal = document.getElementById('modal');
    const closeModal = document.querySelector('.btn-group .btn.cancel');

    const allStar = document.querySelectorAll('.rating .star');
    const ratingValue = document.querySelector('.rating input');
    const d_idElement = document.querySelector('.modal .d_id input');

    $('.show-feedback').click(function () {
        let d_id = this.attributes['d_id'].nodeValue;
        d_idElement.value = d_id;
        console.log(d_idElement.value);
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

    for (const openModalElement of openModal) {
        openModalElement.addEventListener('click', function () {
            modal.style.display = 'flex';
            setTimeout(function () {
                modal.classList.add('show');
                // let d_id = openModalElement.attributes['d_id'].value.toString();
                // modal.querySelector('.modal-content p').innerText="Đây là món có u_id= "+ d_id;
            }, 10);
        });
    }

    closeModal.addEventListener('click', function () {
        modal.classList.remove('show');
        modal.style.display = 'none';
    });


    window.onclick = function (event) {
        if (event.target == modal) {
            modal.classList.remove("show");
            modal.style.display = 'none';
        }
    };

});

