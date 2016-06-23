window.onscroll = function () {
    var haut = (document.body.clientHeight);
    if (haut > 900) {
        var scroll = (document.documentElement.scrollTop ||
                document.body.scrollTop);
        if (scroll > 190) {
            document.getElementById('bloc').style.position = 'absolute';
            document.getElementById('bloc').style.top = scroll + 'px';
        } else if (scroll < 190 || scroll === 190) {
            document.getElementById('bloc').style.position = 'relative';
            document.getElementById('bloc').style.top = 0 + 'px';
        }
    }
}