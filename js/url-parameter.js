function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

// console.log (getParameterByName('cuid'));
const urlparam = getParameterByName('cuid');
if(urlparam != ""){
    console.log(urlparam);
    urlparam.replace("");
}