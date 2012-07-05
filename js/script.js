/* Author:

 */

$(function($) {
	var options = {
		format : '%A %d %B %Y - %H:%M:%S',
		utcOffset : 2,
		utc : true,
	}
	$('#jclock').jclock(options);
});

$(function($) {
	$("select:#icon_select option").mouseover(function() {
		$("#help-icon").attr("src", "img/" + $(this).val())
	});
	return false;
});
