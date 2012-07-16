/* Author:

 */

$(function($) {
	//Elements init
	$('.loading').fadeOut(0);
	$("#collapsable_add_page").hide();
	$("#collapsable_add_action").hide();
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
	$("#collapse_add_action").click(function() {
		$("#collapsable_add_action").toggle("fast");
	});
});

$(function($) {
	$("select:#page_icon").change(function() {
		$("select:#page_icon option:selected").each(function() {
			$("img:#preview-icon-mini").attr("src", "img/icon/" + $(this).val());
			$("img:#preview-icon-maxi").attr("src", "img/icon/bigIcon/" + $(this).val());
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
			dataType : "html",
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

	$("#form_add_page").ajaxSuccess(function(event, request, settings) {
		$('#collapsable_add_page').html("Request Complete.");
	});

	$("#form_add_page").ajaxError(function(jqXHR, textStatus) {
		alert("Request failed: " + textStatus);
	});

	$("#form_add_action").submit(function() {

		$.ajax({
			url : "test.php",
			type : "POST",
			data : $(this).serialize(),
			dataType : "html",
		});

		//cancel the submit button default behaviours
		return false;
	});

	$("#form_add_action").ajaxSuccess(function(event, request, settings) {
		$('#collapsable_add_action').html("Request Complete.");
	});

	var btnValidCancel = '<button class="btn btn-success btn-mini modify"><i class="icon-edit icon-white"></i> OK</button> ';
	btnValidCancel += '<button class="btn btn-warning btn-mini modify"><i class="icon-edit icon-white"></i> Cancel</button>';

	//SUPPRESS
	$(".btn.modify").click(function() {

		$(this).parents("tr").children("td.editable").each(function() {
			if(!$(this).children().is('input'))
				$(this).html('<input type="text" value="' + $(this).html() + '" />');
		});
		$(this).replaceWith(btnValidCancel);
		/*$.ajax({
		url : "test.php",
		type : "POST",
		data : $(this).serialize(),
		dataType : "html",
		});*/

		//cancel the submit button default behaviours
		//return false;
	});

	$(".btn.delete").click(function() {
		var rowToDelete = $(this).parents("tr");
		var rowToDelete_ID = rowToDelete.children("td:first").html();
		var request = $.ajax({
			url : "test.php",
			type : "POST",
			data : {
				id : rowToDelete_ID,
				formAction : "Delete"
			},
			dataType : "html",
		});

		request.done(function(msg) {
			rowToDelete.remove();
		});

		//cancel the submit button default behaviours
		//return false;
	})
});
