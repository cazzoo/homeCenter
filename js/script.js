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
		utc : true,
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
		//Get the data from all the fields
		var title = $('input[name=page_title]');
		var content = $('textarea[name=page_content]');
		var icon = $('select[name=icon_select]');
		var link = $('input[name=page_link]');
		var formName = $(this).attr('name');

		//organize the data properly
		var data = 'title=' + title.val() + '&content=' + encodeURIComponent(content.val()) + '&icon=' + icon.val() + '&link=' + link.val() + '&formName=' + formName.val();

		//show the loading sign
		$('#collapsable_add_page').animate({
			opacity : 0.25,
			left : '+=50',
			height : '128px'
		}, 800, function() {
			$('#collapsable_add_page').html('<span class="loading">&nbsp;</span>').fadeIn("slow");
		});

		var request = $.ajax({
			url : "test.php",
			type : "POST",
			data : data,
			dataType : "html"
		});

		request.done(function(msg) {
			$("#collapsable_add_page").html(msg);
		});

		request.fail(function(jqXHR, textStatus) {
			alert("Request failed: " + textStatus);
		});

		//cancel the submit button default behaviours
		return false;
	})
});
