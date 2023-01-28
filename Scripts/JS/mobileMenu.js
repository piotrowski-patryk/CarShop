const burgerIcon = document.getElementById('burgerIcon');
const menu = document.querySelector('.nav_menu');

burgerIcon.addEventListener('click',function() {
    burgerIcon.classList.toggle('burgerActive');
    menu.classList.toggle('burgerActive');
})

menu.addEventListener('click',function() {
    burgerIcon.classList.remove('burgerActive');
    menu.classList.remove('burgerActive');
})

//Zwijanie po zwiększeniu okna
window.addEventListener('resize', function() {
	if (window.innerWidth > 1240) {
        burgerIcon.classList.remove('burgerActive');
        menu.classList.remove('burgerActive');
	}
})