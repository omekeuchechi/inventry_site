const cashierBtns = document.querySelectorAll('#c-btn');
const cashierIcons = document.querySelectorAll('.ci');
const bounceAnimation = 'bounce';

cashierBtns.forEach(e => {
    e.addEventListener('mouseover', () => {
        cashierIcons.forEach(c => {
            c.classList.toggle(bounceAnimation);
        });
    });
});