var definitions = {
    title: '',
    name: '',
    job: ''
};

var currentBox = getCookie('lastBox', 'squares');
var squares = [];
var projects = [];

translate = (lang) => {
    currentLang = lang;
    setCookie('lastLang', lang);
    getGeneralDefinitions(currentLang);

    $.get(lang+'/home', function(response) {
        definitions = response;
    });

    $.get(currentLang+'/squares', (response) => {
        squares = response;
    });

    $.get(currentLang+'/projects', (response) => {
        projects = response;
    });
}

changeCurrentBox = (newBox) => {
    currentBox = newBox;
    setCookie('lastBox', newBox);
}
