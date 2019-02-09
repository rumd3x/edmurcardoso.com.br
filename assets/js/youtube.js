var definitions = {
    project: '',
    description: ''
};

getPageDefinitions = (lang) => {
    $.get(lang+'/youtube', function(response) {
        definitions = response;
    });
}
