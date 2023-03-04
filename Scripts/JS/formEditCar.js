function openFormEditCar(type, id) {

    const form = document.querySelector('.form-editCar');

    document.querySelector('.form-editCar__content').innerHTML = '';

    fetch('Scripts/dataCars.json').then(response => response.json()).then(data => {

        if (type == 'Dane pojazdu') {
            form.setAttribute('action',`Scripts/php/formEditCar.php?type=cars_data&car_id=${id}`);
            const cars_type = data.cars_data.filter(car => car.Car_ID == id);

            if (cars_type.length > 0) {

                cars_type.forEach(car => {
                    document.querySelector('.form-editCar__content').innerHTML += `
                        <div class="form-editCar__item">
                            <input type="hidden" name="id[]" value="${car.ID}>
                            <input type="text" value="${car.Title}" name="title[]" placeholder="Tytuł">
                            <input type="text" value="${car.Description}" name="description[]" placeholder="Opis">
                            <input type="checkbox" id="checkbox-${car.ID}" name="checkbox[]">

                            <label for="checkbox-${car.ID}">
                                <i class="fa-solid fa-trash-can" id="trash-${car.ID}" onclick="setTrashColor(${car.ID})"></i>
                            </label>
                        </div>
                    `;
                });
            }
        }
    
        if (type == 'Wyposażenie') {
            form.setAttribute('action',`Scripts/php/formEditCar.php?type=cars_equipment&car_id=${id}`);
            const cars_type = data.cars_equipment.filter(car => car.Car_ID == id);

            if (cars_type.length > 0) {

                cars_type.forEach(car => {
                    document.querySelector('.form-editCar__content').innerHTML += `
                        <div class="form-editCar__item">
                            <input type="hidden" name="id[]" value="${car.ID}>
                            <input type="text" value="${car.Title}" name="title[]" placeholder="Tytuł">
                            <input type="text" value="${car.Description}" name="description[]" placeholder="Opis">
                            <input type="checkbox" id="checkbox-${car.ID}" name="checkbox[]">

                            <label for="checkbox-${car.ID}">
                                <i class="fa-solid fa-trash-can" id="trash-${car.ID}" onclick="setTrashColor(${car.ID})"></i>
                            </label>
                        </div>
                    `;
                });
            }
        }
    
        if (type == 'Inne') {
            form.setAttribute('action',`Scripts/php/formEditCar.php?type=cars_other&car_id=${id}`);
            const cars_type = data.cars_other.filter(car => car.Car_ID == id);

            if (cars_type.length > 0) {

                cars_type.forEach(car => {
                    document.querySelector('.form-editCar__content').innerHTML += `
                        <div class="form-editCar__item">
                            <input type="hidden" name="id[]" value="${car.ID}>
                            <input type="text" value="${car.Title}" name="title[]" placeholder="Tytuł">
                            <input type="text" value="${car.Description}" name="description[]" placeholder="Opis">
                            <input type="checkbox" id="checkbox-${car.ID}" name="checkbox[]">

                            <label for="checkbox-${car.ID}">
                                <i class="fa-solid fa-trash-can" id="trash-${car.ID}" onclick="setTrashColor(${car.ID})"></i>
                            </label>
                        </div>
                    `;
                });
            }
        }
    });

    document.querySelector('.form-editCar').style.display = 'flex';
    document.querySelector('.form-editCar__h1').innerHTML = type;
}


function closeFormEditCar() {
    document.querySelector('.form-editCar').style.display = 'none';
}

function setTrashColor(id) {
    const trash = document.getElementById(`trash-${id}`);
    const checkbox = document.getElementById(`checkbox-${id}`);

    if (checkbox.checked == false) {
        trash.style.color = '#e02021';
    }

    if (checkbox.checked == true) {
        trash.style.color = '#ffffff';
    }
}