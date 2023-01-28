// Offers in index.php

const OffersBtnLeft = document.getElementById('OffersBtnLeft');
const OffersBtnRight = document.getElementById('OffersBtnRight');
const carsCount = document.getElementById('carsCount').value;

let item = 1;


OffersBtnLeft.addEventListener('click',function() {
    if (item-3 > 0) {
        document.getElementById('offer_item'+item).style.display = 'none';
        document.getElementById('offer_item'+(item+1)).style.display = 'none';
        document.getElementById('offer_item'+(item+2)).style.display = 'none';
        
        item = item-3;

        document.getElementById('offer_item'+item).style.display = 'flex';
        document.getElementById('offer_item'+(item+1)).style.display = 'flex';
        document.getElementById('offer_item'+(item+2)).style.display = 'flex';
    } else if (item-2 > 0) {
        document.getElementById('offer_item4').style.display = 'none';
        document.getElementById('offer_item5').style.display = 'none';

        item = item-2;

        document.getElementById('offer_item1').style.display = 'flex';
        document.getElementById('offer_item2').style.display = 'flex';
    } else if (item-1 > 0) {
        document.getElementById('offer_item4').style.display = 'none';

        item = item-1;

        document.getElementById('offer_item1').style.display = 'flex';
    }
})


OffersBtnRight.addEventListener('click',function() {
    if (item+6 <= carsCount) {
        document.getElementById('offer_item'+item).style.display = 'none';
        document.getElementById('offer_item'+(item+1)).style.display = 'none';
        document.getElementById('offer_item'+(item+2)).style.display = 'none';
        
        item = item+3;

        document.getElementById('offer_item'+item).style.display = 'flex';
        document.getElementById('offer_item'+(item+1)).style.display = 'flex';
        document.getElementById('offer_item'+(item+2)).style.display = 'flex';

    } else if (item+4 <= carsCount) {
        document.getElementById('offer_item'+item).style.display = 'none';
        document.getElementById('offer_item'+(item+1)).style.display = 'none';

        item = item+2;

        document.getElementById('offer_item'+(item+1)).style.display = 'flex';
        document.getElementById('offer_item'+(item+2)).style.display = 'flex';
    } else if (item+3 <= carsCount) {
        document.getElementById('offer_item'+item).style.display = 'none';

        item = item+1;

        document.getElementById('offer_item'+(item+2)).style.display = 'flex';
    }
})