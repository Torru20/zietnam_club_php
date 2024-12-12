$(function(){
	$(document).on('click', '.deletePostRent', function() {
		var rent_id = $(this).data('rent');
		console.log("rent_id:", rent_id);
		$.post('http://localhost/zietnam_club_php/core/ajax/deletePostRent.php', {rent_id}, function(){
			window.location = window.location.href;
		});
	});
    
});