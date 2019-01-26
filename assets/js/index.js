var languages = [];
var currentLang = '';

var language = {
    title: '',
    name: '',
    job: '',
};

var squares = [];

$(document).ready(function() {

	$.get('squares', (response) => {
        squares = response;
    });

    $.get('langs', (response) => {
        languages = response;
        currentLang = languages.filter(lang => lang.default)[0].id;
        language = translate(currentLang);
    });

});

translate = (lang) => {
    $.get('lang/'+lang, function(response) {
        currentLang = lang;
        language = response;
    });
}
