var definitions = {
    title: '',
    name: '',
    job: '',
    age: 0
};

var squares = [];

getPageDefinitions = (lang) => {
    let homeResponse = $.get(lang + '/home', function (response) {
        definitions = response;
    });

    let squaresResponse = $.get(currentLang + '/squares', (response) => {
        squares = response;
    });

    return [
        homeResponse,
        squaresResponse
    ];
}
