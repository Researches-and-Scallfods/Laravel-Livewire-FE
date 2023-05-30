function loadImage (el, fn) {
    var img = new Image()
    , src = el.getAttribute('data-src');
    img.onload = function() {
        if (!! el.parent)
        el.parent.replaceChild(img, el)
        else
        el.src = src;
        
        fn? fn() : null;
    }
    img.src = src;
}

function elementInViewport(el) {
    var rect = el.getBoundingClientRect()
    
    return (
        rect.top    >= 0
        && rect.left   >= 0
        && rect.top <= (window.innerHeight || document.documentElement.clientHeight)
        )
    }
    
    var images = new Array()
    , query = $('.lazy')
    , processScroll = function(){
        console.log(query);
        for (var i = 0; i < images.length; i++) {
            console.log(i);
            if (elementInViewport(images[i])) {
                loadImage(images[i], function () {
                    images.splice(i, i);
                });
            }
        };
    }
    ;
    // Array.prototype.slice.call is not callable under our lovely IE8 
    for (var i = 0; i < query.length; i++) {
        images.push(query[i]);
    };
    
    processScroll();
    addEventListener('scroll',processScroll);