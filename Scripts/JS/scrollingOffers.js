// pobieramy referencje do elementów DOM
const offersPictures = document.querySelector('.offers_pictures');
const leftButton = document.getElementById('OffersBtnLeft');
const rightButton = document.getElementById('OffersBtnRight');

// wczytujemy plik JSON
fetch('Scripts/dataCars.json')
.then(response => response.json())
.then(data => {
  let currentIndex = 0;
  const cars = data.cars;

  // funkcja wyświetlająca trzy parametry dla danego samochodu
  const showCars = index => {
    let html = '';
    for (let i = index; i < index + 3; i++) {
      const car = cars[i % cars.length];
      html += `
        <a href="Oferta?id=${car.ID}" class="offers_pictures_item">
            <img src="Images/Offers/${car.Picture}" alt="${car.Mark} ${car.Model}">
            <h1>${car.Mark}, ${car.Model}</h1>
            <div><i class="fa-solid fa-angle-right"></i></div>
        </a>
      `;
    }
    offersPictures.innerHTML = html;
  };

  // wyświetlamy pierwsze trzy samochody
  showCars(currentIndex);

  // obsługa kliknięcia w przycisk 'right'
  rightButton.addEventListener('click', () => {
    currentIndex += 3;
    showCars(currentIndex);
  });

  // obsługa kliknięcia w przycisk 'left'
  leftButton.addEventListener('click', () => {
    currentIndex -= 3;
    if (currentIndex < 0) {
      currentIndex = cars.length - (cars.length % 3);
    }
    showCars(currentIndex);
  });
})
.catch(error => console.error(error));