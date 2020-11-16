
//Déclaration de la position de la balle
var posBalleX = 150
var posBalleY = 100
// axeX déplacement en vertical de 3px a chaque rafraichisement 
var axeX = 3;
// axeY déplacement en horizontal de 2px a chaque rafraichisement
var axeY = 2;
//Déclaration de la position de la barre
var posBarre = 500;
function depart() {
    // Récuperation de l'image
    balle = document.getElementById("balle");
    barre = document.getElementById("barre");
    // appel de la fonction "deplacement" toute les 0.01s
    window.setInterval(deplacementBalle, 10);
    //window.setInterval(deplacementbarre, 10);
}

function deplacementBalle() {
//position de la balle plus ajout de la variable de déplacement
    posBalleX += axeX;
    posBalleY += axeY;
// deplacement du "style" de l'image à la nouvelle position
    balle.style.top = posBalleX + "px";
    balle.style.left = posBalleY + "px";
    // si l'image est en position 600pixels sur l'axeX par rapport à la page, alors on inverse axeX 
    if (posBalleX >= 600) {
        axeX = -3;
    } 	// si l'image est en position 150pixels sur l'axeX par rapport à la page, alors on inverse axeX
    if (posBalleX <= 150) {
        axeX = 3;
    }	// si l'image est en position 1100pixels sur l'axeX par rapport à la page, alors on inverse axeY
    if (posBalleY >= 1100) {
        axeY = -2;
    }	// si l'image est en position 90pixels sur l'axeY par rapport à la page, alors on inverse axeY
    if (posBalleY <= 90) {
        axeY = 2;
    }	// si l'image est en position 540pixels sur l'axeX ET que la position de la barre se trouve dans le même champs, alors on inverse axeX
    if (posBalleX >= 540 && ((posBarre - 30) < posBalleY && (posBarre + 150) > posBalleY)) {
        axeX = -3;
    }
}

/*function deplacementbarre(){
 y+=axeY;
 barre.style.left = y + "px";
 if (y>=960){
 axeY=-2;
 }
 if (y<=90) {
 axeY=2;
 }
 }*/

//méthode qui ajoute ajoute une fonction lorsqu'une action est effectué
document.addEventListener('keydown', function (event) {
    if (event.keyCode == 37) {
        if (posBarre >= 100) {
            posBarre -= 10;
            barre.style.left = posBarre + "px";
        }
    } else if (event.keyCode == 39) {
        if (posBarre <= 950) {
            posBarre += 10;
            barre.style.left = posBarre + "px";
        }
    }
});

/*function rebond(){
 
 axeX=(-3);
 }*/

//function collision{

//}
