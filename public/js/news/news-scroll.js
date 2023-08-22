
/* Called whenever the user scrolls */
$(window).scroll(function() {
    updateScrollProgress();
    newsTransition();
});


/* Quickly retrieve information on how far the user has scrolled */
function getScrollPercentage(){
    var scrollPercent = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());
    return scrollPercent;
}

/* Used to update the scroll progress bar */
function updateScrollProgress(){
    var scrollPercent = getScrollPercentage();
    var convertedPercent = scrollPercent.toFixed(1) + '%';
    //console.log('Converted Percent: ' + convertedPercent);
    $('.progress-bar').css('width', convertedPercent);
}

function newsTransition(){
    var scrollPercent = getScrollPercentage();
    var intro = $('.intro');
    var widget = $('.article-widget');

    if(scrollPercent < 3){
        intro.css('opacity', '1');
        widget.css('opacity', '0');
    }
    else{
        intro.css('opacity', '0');
        widget.css('opacity', '1');
    }
}
