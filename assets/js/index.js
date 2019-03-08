var definitions = {
    title: '',
    name: '',
    job: ''
};

var squares = [];

getPageDefinitions = (lang) => {
    $.get(lang+'/home', function(response) {
        definitions = response;
    });

    $.get(currentLang+'/squares', (response) => {
        squares = response;
    });
}
