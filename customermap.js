const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.iconclose');

registerLink.addEventListener('click', () => {
    wrapper.classList.add('active');
});
loginLink.addEventListener('click', () => {
    wrapper.classList.remove('active');
});
btnPopup.addEventListener('click', () => {
    wrapper.classList.add('active-popup');
});
iconClose.addEventListener('click', () => {
    wrapper.classList.remove('active-popup');
});

//////////////////////////////3dlogo
document.addEventListener('DOMContentLoaded', function () {
    // Get the model-viewer element
    var modelViewer = document.getElementById('myModelViewer');

    // Set autoplay attribute to trigger rotation
    modelViewer.setAttribute('autoplay', '');
});
