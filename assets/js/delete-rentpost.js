$(function() {
    $(document).on('click', '.deletePostRent', function() {
        var rent_id = $(this).data('rent');
        console.log("rent_id:", rent_id);

        if (confirm('Bạn có chắc chắn muốn xóa?')) {
            $.post('http://localhost/zietnam_club_php/core/ajax/deletePostRent.php', {rent_id}, function() {
                window.location = window.location.href;
            });
        }
    });

	$(document).on('click', '.acceptPostRent', function() {
        var rent_id = $(this).data('rent');
        console.log("rent_id:", rent_id);

        if (confirm('Xác nhận tin đăng này?')) {
            $.post('http://localhost/zietnam_club_php/core/ajax/acceptPostRent.php', {rent_id}, function() {
                window.location = window.location.href;
            });
        }
    });
});

