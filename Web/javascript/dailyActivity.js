if (document.getElementById('dailyActivity')) {

    let entrjr = document.querySelectorAll('.entrjr');

    for (let i = 0; i < entrjr.length; i++) {
        entrjr[i].style.display = 'none';
    }

    function deactiveEntree() {
        let entrees = document.querySelectorAll('.entrjr'),
            entreesLength = entrees.length;

        for (let i = 0; i < entreesLength; i++) {
            entrees[i].style.display = 'none';
            
        }
    }

    function activeEntree(element) {
        element.style.display = 'block';
    }
    // FIARE APPARÎTRE UNE ENTREE
    let entree = document.querySelectorAll('.dropdown-item'),
        entreeLength = entree.length,
        formId;
    for (let i = 0; i < entreeLength; i++) {

        entree[i].addEventListener('click', (e) => {
            formId = document.getElementById(entree[i].classList[1]);
            formId.className += ' ' +'d-flex';
            formId.className += ' ' +'flex-row';
            //formId.style.display = 'block';
        
            e.preventDefault();
        });
    }

    // MASQUE UNE ENTREE PARTICULIERE
    let icons = document.querySelectorAll('.material-icons'),
    iconsLength = icons.length;

    for (let j = 0; j < iconsLength; j++) {

        icons[j].addEventListener('click', () => {
            if (getComputedStyle(icons[j].parentNode).display === 'flex') {
                icons[j].parentNode.classList.remove('d-flex', 'flex-row');
                icons[j].parentNode.style.display = 'none';
            }
        });
    }

    
}