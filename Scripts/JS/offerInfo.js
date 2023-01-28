function offerInfo(id) {
    id = id.getAttribute("data-id");
    const focusItem = document.querySelector(`#offerInfo-${id} > .data_item_content`);
    const focusItem_icon = document.querySelector(`#offerInfo-${id} > .data_item_icon`);

    for (let i=1; i<4; i++) {
        if (i != id) {
            document.querySelector(`#offerInfo-${i} > .data_item_content`).style.display = 'none';
            document.querySelector(`#offerInfo-${i} > .data_item_icon`).innerHTML = '<i class="bi bi-chevron-down"></i>';
        }
    }

    if (focusItem.style.display == 'flex') {
        focusItem.style.display = 'none';
        focusItem_icon.innerHTML = '<i class="bi bi-chevron-down"></i>';
    } else {
        focusItem.style.display = 'flex';
        focusItem_icon.innerHTML = '<i class="bi bi-chevron-up"></i>';
    }
}