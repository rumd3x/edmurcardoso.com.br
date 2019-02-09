var general = {
    myProjects: "",
    comingSoon: "",
    goBack: "",
}

var languages = [];
var currentLang = getCookie('lastLang', '');

$(document).ready(function() {

    $.get('langs', (response) => {
        languages = response;

        if (currentLang === '') {
            currentLang = languages.filter(lang => lang.default)[0].id;
        }

        language = translate(currentLang);
    });

});

translate = (lang) => {
    currentLang = lang;
    setCookie('lastLang', lang);
    getGeneralDefinitions(currentLang);
    getPageDefinitions(currentLang);
}

getGeneralDefinitions = (lang) => {
    $.get(currentLang+'/general', (response) => {
        general = response;
    });
}
