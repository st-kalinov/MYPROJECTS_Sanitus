$(document).ready(function () {
    const mainCategorySlug = $('#mainCatOptions').find('h2.main-category:first').data('slug');
    const route = Routing.generate('app_products_maincategory_filtered', {slug: mainCategorySlug}, true);
    const brandBlockClass = "js-brand";
    const priceBlockClass = "js-prices";
    const promotionBlockClass = "js-promotion";
    const paginationBlockClass = "js-pagination";
    var activePage = 1;
    //-------------------------PRICE SLIDER ------------------------
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
            activePage = 1;
            makeAJAX();
        },
        onUpdate: (data) => {
            $('.js-price[name="minPrice"]').val(data.from);
            $('.js-price[name="maxPrice"]').val(data.to);
            activePage = 1;
            makeAJAX();
        }
    });
    //--------------------PRICE SLIDER END---------------------------


    $('#productFilterSection input:checkbox').on('click', () => {
        activePage = 1;
        makeAJAX();
    });

    $('body').on('click', `div.${paginationBlockClass} ul li`, (e) => {
        e.preventDefault();
        activePage = $(e.currentTarget).data("page");
        makeAJAX(activePage);

    });

    $('.clear-filters').on('click', () => {
        clear_filters();
    });

    function makeAJAX(page = 1) {
        let brand = get_filter(brandBlockClass, 'input:checkbox:checked');
        let prices = get_filter(priceBlockClass, 'input');
        let promotion = get_filter(promotionBlockClass, 'input:checkbox:checked');
        console.log(prices);
        $.ajax({
            url: route,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({brand: brand, price: prices, promotion: promotion, page: page}),
            beforeSend: () => {
                $('.ajax-gif').show();
            },
            success: function (data) {
                $('.ajax-gif').hide();
                $('.products').html(data);
                removeActivePageClass();
                setActivePageClass(paginationBlockClass, "ul li", activePage,"current-page");
            },
            error: function () {
                $('.ajax-gif').hide();
            }
        });
    }

    function get_filter(className, inputType) {
        let values = [];
        $(`.${className} ${inputType}`).each((index, element) => {
            values.push($(element).val());
        });

        return values;
    }

    function removeClassFromElements(parentElement, element, classNameForRemove) {
        $(`.${parentElement} ${element}`).each((index, element) => {
           $(element).removeClass(classNameForRemove);
        });
    }

    function removeClassFromElement(parentElement, element, classNameForRemove) {
        $(`.${parentElement} ${element}`).removeClass(classNameForRemove);
    }

    function removeActivePageClass() {
        removeClassFromElement(paginationBlockClass, "ul li", "default-page");
        removeClassFromElements(paginationBlockClass, "ul li", "current-page");
    }

    function setActivePageClass(parentElement, element, elementNumber, classNameToAdd) {
        $(`.${parentElement} ${element}`+':eq('+(elementNumber-1)+')').addClass(classNameToAdd);
    }

    function clear_filters() {
        $('#productFilterSection input:checkbox').each((index, element) => {
            $(element).prop('checked', false);
        });
        $(".js-range-slider").data('ionRangeSlider').update({from: 0, to: 300});
    }

});


