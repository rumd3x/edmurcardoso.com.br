var definitions = {
    title: '',
    name: '',
    job: '',
    age: 0
};

var squares = [];

getPageDefinitions = (lang) => {
    $.get(lang + '/home', function (response) {
        definitions = response;
    });

    $.get(currentLang + '/squares', (response) => {
        squares = response;
    });
}
