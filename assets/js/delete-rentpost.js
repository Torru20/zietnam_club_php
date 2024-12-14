$(function() {
    $(document).on('click', '.deletePostRent', function() {
        var rent_id = $(this).data('rent');
        console.log("rent_id:", rent_id);

        if (confirm('Do you sure to delete this post?')) {
            $.post('http://localhost/zietnam_club_php/core/ajax/deletePostRent.php', {rent_id}, function() {
                window.location = window.location.href;
            });
        }
    });

	$(document).on('click', '.acceptPostRent', function() {
        var rent_id = $(this).data('rent');
        console.log("rent_id:", rent_id);

        if (confirm('Accept this post?')) {
            $.post('http://localhost/zietnam_club_php/core/ajax/acceptPostRent.php', {rent_id}, function() {
                window.location = window.location.href;
            });
        }
    });
    //rentedPostRent
    $(document).on('click', '.rentedPostRent', function() {
        var rent_id = $(this).data('rent');
        console.log("rent_id:", rent_id);

        if (confirm('Change this post status to rented?')) {
            $.post('http://localhost/zietnam_club_php/core/ajax/rentedPostRent.php', {rent_id}, function() {
                window.location = window.location.href;
            });
        }
    });
});

