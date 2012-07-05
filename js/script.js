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
	$("select:#icon_select").change(function() {
		$("select:#icon_select option:selected").each(function () {
		$("#preview-icon-mini").attr("src", "img/" + $(this).val());
		$("#preview-icon-maxi").attr("src", "img/bigIcon/" + $(this).val());
		})
	}).change();
	return false;
});

$(function($) {
	$("#collapse_add_page").click(function(){
		$("#collapsable_add_page").toggle("fast");
	});
});
