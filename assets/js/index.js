var definitions = {
    title: '',
    name: '',
    job: '',
    age: 0
};

var squares = [];
var isCookieBannerClosed = getCookie('cookieBannerAcknowledged', '0');

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

closeCookieBanner = () => {
    setCookie('cookieBannerAcknowledged', '1');
    isCookieBannerClosed = '1';
}
