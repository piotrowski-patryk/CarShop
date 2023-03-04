function innerCarData(id) {
    const vehicleData = document.getElementById('vehicleData');
    const vehicleEquipment = document.getElementById('vehicleEquipment');
    const vehicleOtherData = document.getElementById('vehicleOtherData');
    const img = document.querySelector('.offer_top_img');

    fetch('Scripts/dataCars.json').then(response => response.json()).then(data => {

        // image
        img.setAttribute('src',`Images/Offers/${data.cars[id-1].Picture}`);

        // cars
        const car = data.cars.find(car => car.ID == id);
        vehicleData.innerHTML += `
            <div>
                <span>Marka:</span>
                <H1>${car.Mark}</H1>
            </div>

            <div>
                <span>Model:</span>
                <H1>${car.Model}</H1>
            </div>
        `;


        // cars data
        const cars_data = data.cars_data.filter(car => car.Car_ID == id);
        if (cars_data.length > 0) {

            cars_data.forEach(car => {
                vehicleData.innerHTML += `
                    <div>
                        <span>${car.Title}:</span>
                        <H1>${car.Description}</H1>
                    </div>
                `;
            });
        }


        // cars equipment
        const cars_equipment = data.cars_equipment.filter(car => car.Car_ID == id);
        if (cars_equipment.length > 0) {
            
            cars_equipment.forEach(car => {
                vehicleEquipment.innerHTML += `
                    <div>
                        <span>${car.Title}:</span>
                        <H1>${car.Description}</H1>
                    </div>
                `;
            });
        }


        // cars other
        const cars_other = data.cars_other.filter(car => car.Car_ID == id);
        if (cars_other.length > 0) {
            
            cars_other.forEach(car => {
                vehicleOtherData.innerHTML += `
                    <div>
                        <span>${car.Title}:</span>
                        <H1>${car.Description}</H1>
                    </div>
                `;
            });
        }

    });
}



function formCarData(type) {
    
}