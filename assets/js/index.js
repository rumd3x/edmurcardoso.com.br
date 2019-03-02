var definitions = {
    title: '',
    name: '',
    job: ''
};

var squares = [];
var projects = [];

getPageDefinitions = (lang) => {
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
