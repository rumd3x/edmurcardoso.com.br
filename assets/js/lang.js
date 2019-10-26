var general = {
    myProjects: "",
    comingSoon: "",
    goBack: "",
}

var languages = [];
var currentLang = getCookie('lastLang', '');

$(document).ready(function () {

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

    let generalPromises = getGeneralDefinitions(currentLang);
    let pagePromises = getPageDefinitions(currentLang);

    $.when(pagePromises, generalPromises).done(() => {
        $("#preloader").fadeOut(875);
    });
}

getGeneralDefinitions = (lang) => {
    let response = $.get(lang + '/general', (response) => {
        general = response;
    });

    return [response];
}
