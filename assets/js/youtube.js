var definitions = {
    project: '',
    description: ''
};

translate = (lang) => {
    currentLang = lang;
    setCookie('lastLang', lang);
    getGeneralDefinitions(currentLang);

    $.get(lang+'/youtube', function(response) {
        definitions = response;
    });
}
