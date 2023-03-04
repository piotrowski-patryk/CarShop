const btn = document.getElementById('btn-addCarItem');
const newCarTitle = document.getElementById('newCarTitle');
const newCarDescription = document.getElementById('newCarDescription');
const content = document.querySelector('.form-editCar__content');

btn.addEventListener('click',function() {
    content.innerHTML += `
        <div class="form-editCar__item">
            <input type="hidden" name="id[]">
            <input type="text" value="${newCarTitle.value}" name="title[]" placeholder="Tytuł">
            <input type="text" value="${newCarDescription.value}" name="description[]" placeholder="Opis">
            <input type="checkbox" id="${newCarTitle.value}-checkbox">

            <label for="${newCarTitle.value}-checkbox">
                <i class="fa-solid fa-trash-can"></i>
            </label>
        </div>
    `;

    newCarTitle.value = '';
    newCarDescription.value = '';
})