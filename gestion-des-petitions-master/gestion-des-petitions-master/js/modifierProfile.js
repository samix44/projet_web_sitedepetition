function verif(){
    var nom = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;
    var mdp = document.getElementById('mdp').value;
    var cmdp = document.getElementById('cmdp').value;
    var etudiant = document.getElementById('etd');
    var prof = document.getElementById('prof');
    var admin = document.getElementById('pa');
    var email = document.getElementById('email').value;

    if ((nom !='') && (!isNaN(nom))){
        alert("le nom doit etre alphabitique !");
        return false;
    }else if ((prenom != '') && (!isNaN(prenom))){
        alert("le prenom doit etre alphabitique !");
        return false;
    }else if ((email != '') && ( (email.indexOf('@') == -1) || (email.indexOf('.') == -1) )){
        alert("erreur au niveau de email");
        return false;
    }else if ((mdp != '') && (mdp != '') && (mdp.length < 8)){
        alert("mot de passe doit etre au minimum composé de 8 caractére !");
        return false;
    }else 
    var testA = false;
    var testN = false;
    for (let i =0 ; i<mdp.length;i++){
        if ((mdp.charAt(i) >= 0) && (mdp.charAt(i) <= 9)){
            testA = true;
        }
    }
    for (let i =0 ; i<mdp.length;i++){
        if (((mdp.charAt(i) >= 'a') && (mdp.charAt(i) <= 'z')) || ((mdp.charAt(i) >= 'A') && (mdp.charAt(i) <= 'Z'))){
            testN = true;
        }
    }
    if (((testA == false) || (testN == false)) && (mdp != '')){
        alert("mot de passe doit etre composé d'au moins un lettre et un numéro !");
        return false;
    }else if ((mdp != cmdp) && (cmdp != '')){
        alert("confirmation de mot de passe erroné !");
        return false;
    }else if ((! etudiant.checked) && (! prof.checked) && (! admin.checked)){
        alert("choisissez un fonction");
        return false;
    }
    
}


function file_selected() {
    var upload = document.getElementById('upl');
    var file = document.getElementById('file').files;
    if(file.length == 1){
        upload.style.backgroundColor = "#2691d9";
        upload.style.borderColor = "#fff";
        upload.style.color = "#fff";
    }
}