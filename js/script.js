/* Author:

 */

$(function($) {
	//Elements init
	$('.loading').fadeOut(0);
});

$(function($) {
	var options = {
		format : '%A %d %B %Y - %H:%M:%S',
		utcOffset : 2,
		utc : true
	}
	$('#jclock').jclock(options);
});

$(function($) {
	$("#collapse_add_page").click(function() {
		$("#collapsable_add_page").toggle("fast");
	});
});

$(function($) {
	$("select:#icon_select").change(function() {
		$("select:#icon_select option:selected").each(function() {
			$("#preview-icon-mini").attr("src", "img/icon/" + $(this).val());
			$("#preview-icon-maxi").attr("src", "img/icon/bigIcon/" + $(this).val());
		})
	}).change();
	return false;
});

$(function($) {
	$("#form_add_page").submit(function() {

		$.ajax({
			url : "test.php",
			type : "POST",
			data : $(this).serialize(),
			dataType : "html"
		});

		//cancel the submit button default behaviours
		return false;
	});

	$("#form_add_page").ajaxStart(function() {
		$('#collapsable_add_page').animate({
			opacity : 0.25,
			left : '+=50',
			height : '128px'
		}, 800, function() {
			$('#collapsable_add_page').html('<span class="loading">&nbsp;</span>').fadeIn("slow");
		});
	});

	$("#form_add_page").ajaxComplete(function(msg) {
		$("#collapsable_add_page").html(msg);
	});

	$("#form_add_page").ajaxError(function(jqXHR, textStatus) {
		alert("Request failed: " + textStatus);
	});

});
