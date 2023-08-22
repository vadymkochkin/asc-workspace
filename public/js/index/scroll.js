var dataSection = ['intro', 'media', 'distribution', 'realmlist', 'news'];
var videoList = ['bg_vid', 'laughingskull', 'distribution', 'Tavern', 'Ship'];

$(function () {
    $.scrollify({
        scrollSpeed: 1300,
        updateHash: true,
        touchScroll: true,
        section: ".panel",
        scrollbars: false,
        interstitialSection:"footer",
        before: function (i, panels) {

            var ref = panels[i].attr("data-section-name");

            $(".pagination .active").removeClass("active");

            $(".pagination").find("a[href=\"#" + ref + "\"]").addClass("active");

            /**
             *
             * @Description: Insert Background Video When user scroll on Home
             * @since: 5/31/2019 14:38
             * @author: Jingwei Chen
             * */
            if (i > 0) {
                var prev_bg_vid = $("#" + dataSection[i - 1]).find('.bg-vid');
                if (!prev_bg_vid.length) {
                    insertBgVideo(videoList[i - 1], dataSection[i - 1]);
                }
            }

            var current_bg_vid = $("#" + dataSection[i]).find('.bg-vid');
            console.log(current_bg_vid);
            if (!current_bg_vid.length) {
                insertBgVideo(videoList[i], dataSection[i]);
            }

            var next_bg_vid = $("#" + dataSection[i + 1]).find('.bg-vid');
            if (!next_bg_vid.length) {
                insertBgVideo(videoList[i + 1], dataSection[i + 1]);
            }
            /** End Insert Background Part */
        },
        after: function (i, panels) {
            var ref = panels[i].attr("data-section-name");
        },
        afterRender: function () {
            var pagination = "<ul class=\"pagination\">";
            var activeClass = "";
            $(".panel").each(function (i) {
                activeClass = "";
                if (i === 0) {
                    activeClass = "active";
                }
                pagination += "<li><a class=\"" + activeClass + "\" href=\"#" + $(this).attr("data-section-name") + "\"><span class=\"hover-text\">" + $(this).attr("data-section-name").charAt(0).toUpperCase() + $(this).attr("data-section-name").slice(1) + "</span></a></li>";
            });

            pagination += "</ul>";

            $(".home").append(pagination);
            /*

            Tip: The two click events below are the same:

            $(".pagination a").on("click",function() {
              $.scrollify.move($(this).attr("href"));
            });

            */
            $(".pagination a").on("click", $.scrollify.move);
            $(".scroller-item").on("click", $.scrollify.move);
        }
    });
});

/**
 * @Description: Insert Background Video Element On Container
 * @since: 5/31/2019 14:42
 * @author: Jingwei Chen
 *
 * @param {string}  filename     Background Video file name
 * @param {string}  elementId    Container ID
 * */
function insertBgVideo(filename, elementId) {
    var vid_html = '<video ' +
        'class="bg-vid" ' +
        'src="/media/video/' + filename + '.mp4" ' +
        'type="video/mp4" ' +
        'loop="loop" ' +
        'autoplay="autoplay" ' +
        'playsinline="playsinline" ' +
        'muted="muted">' +
        '</video>';
    $("#" + elementId).prepend(vid_html);
}
