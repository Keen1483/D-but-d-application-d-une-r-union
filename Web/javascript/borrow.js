if(document.getElementById('borrow')) {
    
    var menu = document.querySelector('.dropdown'),
    membre = document.querySelectorAll('.dropdown-item'),
    membreLength = membre.length;

    var form = document.getElementById('form');

    var name = document.getElementsByName('nom'),
        surname = document.getElementsByName('prenom');

    let sentence = document.createElement('p'),
        text;
        
    var nom, prenom;
    var nameSurname =  (e) => {

        if(/\?nom=([a-z0-9._-]+)(?:%20)?([a-z0-9._-]+)?&prenom=([a-z0-9._-]+)(?:%20)?([a-z0-9._-]+)?/gi.test(e.target.href)) { 

            nom = RegExp.$1;
            if(RegExp.$2) { nom += ' '+ RegExp.$2; }
            prenom = RegExp.$3;
            if(RegExp.$4) { prenom += ' '+ RegExp.$4; }

            console.log(name, surname);
            text = document.createTextNode(nom +' '+ prenom);
            sentence.appendChild(text);
            let ret = document.getElementById('borrow').insertBefore(sentence, menu);
            if(ret) {
                document.querySelector('.dropdown-toggle').hidden = true;
            }

            form.addEventListener('submit', () => {
                name.value = nom;
                surname.value = prenom;
                console.log(name, surname);
            });
        }

        e.preventDefault();
    };
    
    for(let i = 0; i < membreLength; i++) {

        membre[i].addEventListener('click', nameSurname);
    }

}