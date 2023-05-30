const setTheme = (newTheme = null) => {
    let _newTheme = newTheme;

    if(newTheme == null){
        _newTheme = getTheme() == "muzlim" ? "satie" : "muzlim"
    }

    localStorage.setItem('web-theme', _newTheme)
    document.documentElement.id = _newTheme

    if(newTheme == null){
        window.location.reload()
    }
}
const getTheme = () => {
    return localStorage.getItem('web-theme') || 'satie';
}

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
    setTheme(event.matches ? "muzlim" : "satie")
});


(function () {
    setTheme(getTheme())
})();

$(document).ready(function(){
    $("#theme-toggle").text(getTheme() == "muzlim" ? "Mode Terang" : "Mode Gelap")
})