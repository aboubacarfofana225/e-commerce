(function ($) {
    $(document).ready(function () {
        $(".mo-open-link-fancybox").click(function (e) {
            e.preventDefault();
            $.fancybox.open({
                href: $(this).attr("href"),
                type: 'iframe',
                padding: 0
            });
        });
    });
})(jQuery);