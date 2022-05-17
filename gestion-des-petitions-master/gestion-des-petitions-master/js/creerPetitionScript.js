function verif() {

    titre = document.f.titre.value;
    des = document.f.text.value;
    file = document.f.image.value;


    if (titre == ""){
        alert("le titre de pétition vide!");
        return false;
    }else if (des == ""){
        alert("la decription de la pétition vide !");
        return false;
    }else if (des.length >700){
        alert("la description doit etre au maximum de 700 caractère");
        return false;
    }else if (file.trim() == ""){
        alert("choisissez une image pour la pétition");
        return false;
    }
    
    

}