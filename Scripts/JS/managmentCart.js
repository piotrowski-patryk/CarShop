const container = document.querySelector('.managment_right_container');

fetch('Scripts/dataCars.json').then(response => response.json()).then(data => {
    for (let i = 0; i < data.cars.length; i++) {
        container.innerHTML += `
            <div class="managment_right_item">
                <span>#${data.cars[i].ID}</span>
                <input type="hidden" value="${data.cars[i].ID}" name="ID[]">
                <input type="text" placeholder="Marka" value="${data.cars[i].Mark}" name="Mark[]">
                <input type="text" placeholder="Model" value="${data.cars[i].Model}" name="Model[]">
                <label><i class="fa-solid fa-camera" id="inputFileName"></i> <input type="file" name="Picture[]" id="inputFile"></label>
                <div><input type="checkbox" name="checkbox[]"></div>
            </div>
        `;
    }
});