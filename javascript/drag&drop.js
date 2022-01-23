"use strict";

/* ---###---###--- Drag And Drop ---###---###--- */
function allowDrop(ev) {
    ev.preventDefault();
}

// 
function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

// 
function drop(ev) {
    ev.preventDefault();
    let data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
    console.log(data);    // Id img drag
    console.log(ev);      // Elem drag
    
    //createDiv();
}

// Création Div supplémentaire 
function createDiv(){
    let expo = document.querySelector(".expo"); 
    console.log(expo);

    let newDiv = document.createElement("div");
    newDiv.setAttribute('id', 'div1');
    newDiv.setAttribute('ondrop', 'drop(event)');
    newDiv.setAttribute('ondragover', 'allowDrop(event)');
    console.log(newDiv);

    console.log(newDiv);
    expo.appendChild(newDiv);
    
    // if image deja dans section 1 alors pas de new div
    
    // if div deja remplit alors impossible de drag dedans --> Pb peut etre resolu grace a supprAttribute() 
}


// Suppression Attribut Drag & Drop
function supprAttribute(){
    //elem.removeAttribute('id');   Pour éviter de superposer elem une fois div remplit
}











