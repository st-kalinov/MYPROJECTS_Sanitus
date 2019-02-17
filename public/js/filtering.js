$(document).ready(function () {
    const mainCategorySlug = $('#mainCatOptions').find('h2.main-category:first').data('slug');
    const route = Routing.generate('app_products_maincategory', {slug: mainCategorySlug}, true);
    $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 300,
        from: 0,
        to: 300,
        postfix: 'лв.',
        grid: true,
        grid_num: 2,
        hide_min_max: true,
        onFinish: (data) => {
            $('.js-price[name="minPrice"]').val(data.from);
            $('.js-price[name="maxPrice"]').val(data.to);
            makeAJAX();
        },
        onUpdate: (data) => {
            $('.js-price[name="minPrice"]').val(data.from);
            $('.js-price[name="maxPrice"]').val(data.to);
            makeAJAX();
        }
    });

    $('#productFilterSection input:checkbox').on('click', () => {
        makeAJAX();
    });

    function makeAJAX() {
        let brand = get_filter('js-brand', 'input:checkbox:checked');
        let prices = get_filter('js-prices', 'input');
        let promotion = get_filter('js-promotion', 'input:checkbox:checked');

        $.ajax({
            url: route,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({brand: brand, price: prices, promotion: promotion[0]}),
            beforeSend: () => {
                $('.ajax-gif').show();
            },
            success: function (data) {
                $('.ajax-gif').hide();
                $('.products').html(data);
            }
        });
    }

    function get_filter(className, inputType) {
        let values = [];
        $(`.${className} ` + inputType).each((index, element) => {
            values.push($(element).val());
        });

        return values;
    }

    function clearFilters() {
        $('#productFilterSection input:checkbox').each((index, element) => {
            $(element).prop('checked', false);
        });
        $(".js-range-slider").data('ionRangeSlider').update({from: 0});
    }

    $('.clear-filters').on('click', () => {
        clearFilters();
    });


});


