$(function() {
    $(document).on('click', '.deleteUser', function() {
        var user_id = $(this).data('user');
        console.log("user_id:", user_id);

        if (confirm('Delete this account?')) {
            $.post('http://localhost/zietnam_club_php/core/ajax/deleteUser.php', {user_id}, function() {
                window.location = window.location.href;
            });
        }
    });
	$(document).on('click', '.resetPass', function() {
        var user_id = $(this).data('user');
        console.log("user_id:", user_id);

        if (confirm('Reset this account password?')) {
            $.post('http://localhost/zietnam_club_php/core/ajax/resetPassword.php', {user_id}, function() {
                window.location = window.location.href;
            });
        }
    });
});
