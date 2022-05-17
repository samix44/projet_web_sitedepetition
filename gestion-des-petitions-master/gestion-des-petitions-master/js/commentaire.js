function verif() {
    
    comnt = document.getElementById('comnt').value;

    if (comnt == ""){
        alert("commentaire vide !!");
        return false;
    }else if (comnt.length > 250){
        alert("votre commentaire ne doit pas dépasser 250 caractère !");
        return false;
    }
}