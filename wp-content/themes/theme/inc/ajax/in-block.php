<script>
    jQuery(document).ready(function ($) {
        const btn = $('#name-block .btn');
        const parent = $('#name-block .parent');

        btn.click(function () {
            $(this).hide();

            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'load_something',
                },
                beforeSend: function (xhr) {
                    parent.addClass('loading');
                },
                success: function (response) {
                    parent.html(response);
                    parent.removeClass('loading');
                }
            });
        })
    });
</script>