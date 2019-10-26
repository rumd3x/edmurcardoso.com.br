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

    let promises = [];
    promises = promises.concat(generalPromises);
    promises = promises.concat(pagePromises);

    $.when.apply($, promises).then(() => {
        $("#preloader").fadeOut(500);
    });
}

getGeneralDefinitions = (lang) => {
    let response = $.get(lang + '/general', (response) => {
        general = response;
    });

    return [response];
}
