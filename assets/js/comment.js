$(function(){
	$('#postComment').click(function(){
		var comment = $('#commentField').val();
		var tweet_id = $('#commentField').data('tweet');

		$.post('http://localhost/zietnam_club_php/core/ajax/comment.php', {comment:comment,tweet_id:tweet_id}, function(data){
			$('#comments').html(data);
			$('#commentField').val('');
		});
	});
});