<div id="center-popup">
	<div id="overPage" style="display: none; background: black; z-index: 800; position: absolute; left: 0; top: 0; opacity: 0.7; filter: alpha(opacity=70);" >
		<a href="javascript:closeMe();" style="color: #fff;float: left;"><?php echo $close; ?></a></div>
	<div id="floating" style="text-align: right; background: transparent; display: none; z-index: 900; position: absolute;">
		<a href="javascript:closeMe();" style="color: #fff;float:right;"><?php echo $close; ?></a><br />
		<a href="<?php echo $image_link; ?>" target="_blank"><img src="<?php echo $image_url; ?>"  alt="<?php echo $image_title; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" /></a></div>
	<script type="text/javascript">// <![CDATA[
var lastScroll;
var delay = 30;
var speed = 50;
var img_w = <?php echo $image_width; ?>;
var img_h = <?php echo $image_height; ?>;
function centerIt() {
$("#overPage").css("width", $(window).width());
$("#overPage").css("height", $(document).height() );
$("#floating").css("left", $(window).width() / 2 - (img_w / 2));
$("#floating").css("top", $(window).height() / 2 - img_h / 2 + $(document).scrollTop());}
$(document).ready(function() {
$("#overPage").css("opacity", 0.7);
$("#overPage,#floating").show();
centerIt();
});
$(window).scroll(function() {
setTimeout(function() { ani(); }, delay);
lastScroll = new Date().getTime();
});
$(window).resize(function() {
centerIt();
});
function ani() {
if ((new Date().getTime() - lastScroll) >= (delay - 10)) {
$("#floating").animate({ top: ($(window).height() / 2 - img_h / 2 + $(document).scrollTop()) }, speed);
}
}
function closeMe() {
$("#overPage,#floating").hide();
}
// ]]></script>
</div>