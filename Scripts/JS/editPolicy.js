const btnOpen = document.getElementById('btn-openForm');
const btnClose = document.getElementById('btn-closeForm');
const btnSave = document.getElementById('btn-save');

const policyText = document.getElementById('policyText');
const policyForm = document.getElementById('policyForm');

btnOpen.addEventListener('click', function() {
    btnOpen.style.display = 'none';
    policyText.style.display = 'none';
    policyForm.style.display = 'block';
})

btnClose.addEventListener('click', function() {
    btnOpen.style.display = 'inline';
    policyText.style.display = 'block';
    policyForm.style.display = 'none';
})

btnSave.addEventListener('click', function() {
    btnOpen.style.display = 'inline';
    policyText.style.display = 'block';
    policyForm.style.display = 'none';
})