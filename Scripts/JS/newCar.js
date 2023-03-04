const btn = document.getElementById('btn-newCar');
const containerCars = document.querySelector('.managment_right_container');

btn.addEventListener('click',function() {

    containerCars.innerHTML += `
        <div class="managment_right_item">
            <span>##</span>
            <input type="text" placeholder="Marka" name="Mark[]">
            <input type="text" placeholder="Model" name="Model[]">
            <label><i class="fa-solid fa-camera" id="inputFileName"></i> <input type="file" name="Picture[]" id="inputFile"></label>
            <div><input type="checkbox"></div>
        </div>
    `;
})