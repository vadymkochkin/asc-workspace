$(window).on('load', function() {
  //var href = document.location.href;
  var widgetCSS = "" +
  ".timeline-Widget{border: 1px solid #ECA659; border-radius: 1px;}" +
  ".timeline-Widget a{color: #ECA659;}" +
  ".TweetAuthor-name{color: #ECA659;}" +
  ".TweetAuthor-screenName{color: gray;}" +
  ".timeline-Header{background-image: url('media/image/index/grunge_bg.jpg'); background-size: cover; border-top-left-radius: 30px; border-top-right-radius: 30px;}" +
  ".timeline-Footer{background-image: url('media/image/index/grunge_bg.jpg'); background-size: cover; border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;}" +
  ".timeline-Widget{background-image: url('media/image/index/wood_bg.jpg'); background-size: cover; ::-webkit-scrollbar: width: 0.2rem;}" + 
  "*:not(.asc-default-hover){cursor: url('../media/cursor/Point.PNG'), auto}" +    
  ".timeline-Widget .TweetAuthor-name{cursor: url('../media/cursor/Cast.PNG'), pointer !important}" +
  ".timeline-Widget .PrettyLink .PrettyLink-prefix{cursor: url('../media/cursor/Cast.PNG'), pointer !important}" +
  ".timeline-Widget .PrettyLink .PrettyLink-value{cursor: url('../media/cursor/Cast.PNG'), pointer !important}" +
  ".timeline-Widget .TweetAction-icon{cursor: url('../media/cursor/Cast.PNG'), pointer !important}" + 
  ".timeline-Widget .NaturalImage-image{cursor: url('../media/cursor/Cast.PNG'), pointer !important}" +
  ".timeline-Widget a{cursor: url('../media/cursor/Cast.PNG'), pointer !important}";                                                                                             

  var w = document.getElementById("twitter-widget-0").contentDocument;

  var s = document.createElement("style");
  s.innerHTML = widgetCSS;
  s.type = "text/css";
  w.head.appendChild(s);

  var v = document.getElementById("twitter-widget-1").contentDocument;

  var s = document.createElement("style");
  s.innerHTML = widgetCSS;
  s.type = "text/css";
  v.head.appendChild(s);
});
