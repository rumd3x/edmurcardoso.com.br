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

        setTimeout(() => {
            $('.flags img').click(function() {
                translate($(this).data('lang'));
            });
        }, 1000);
    });

});

translate = (lang) => {
    currentLang = lang;
    $.get('lang/'+currentLang, function(response) {
        language = response;
    });
}
