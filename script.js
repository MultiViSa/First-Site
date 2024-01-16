const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-Link');

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});