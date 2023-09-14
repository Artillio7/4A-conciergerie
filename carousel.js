const items = document.querySelectorAll('img.img-carousel');
let img1 = 0;
let img2 = 1;
let img3 = 2;

setInterval(slideSuivante1, 5000);

function slideSuivante1(){

    items[img1].classList.remove('premiere');
    items[img1].classList.add('troisieme');
    items[img2].classList.remove('deuxieme');
    items[img2].classList.add('premiere');
    items[img3].classList.remove('troisieme');
    items[img3].classList.add('deuxieme');

    img1 = img1+1;
    img2 = img2+1;
    img3 = img3+1;

    if(img1 > 2){
        img1 = 0;
    }
    if(img2 > 2){
        img2 = 0;
    }
    if(img3 > 2){
        img3 = 0;
    }

}
