'use strict';

$(document).ready(function () {
    var mainCategorySlug = $('#Options').find('h2.main-category:first').data('slug');
    var subCategorySlug = $('#Options').find('h2.main-category:first').data('sub-slug');
    var route = Routing.generate('app_products_main_subcategory_filtered', { slug: mainCategorySlug, slugSub: subCategorySlug }, true);

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
        onFinish: function onFinish(data) {
            $('.js-price[name="minPrice"]').val(data.from);
            $('.js-price[name="maxPrice"]').val(data.to);
            activePage = 1;
            makeAJAX();
        },
        onUpdate: function onUpdate(data) {
            $('.js-price[name="minPrice"]').val(data.from);
            $('.js-price[name="maxPrice"]').val(data.to);
            activePage = 1;
            makeAJAX();
        }
    });
    //--------------------PRICE SLIDER END---------------------------


    $('#productFilterSection input:checkbox').on('click', function () {
        activePage = 1;
        makeAJAX();
    });

    $('body').on('click', 'div.' + paginationBlockClass + ' ul li', function (e) {
        e.preventDefault();
        activePage = $(e.currentTarget).data("page");
        makeAJAX(activePage);
    });

    $('.clear-filters').on('click', function () {
        clear_filters();
    });

    function makeAJAX() {
        var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;

        var brand = get_filter(brandBlockClass, 'input:checkbox:checked');
        var prices = get_filter(priceBlockClass, 'input');
        var promotion = get_filter(promotionBlockClass, 'input:checkbox:checked');

        $.ajax({
            url: route,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ brand: brand, price: prices, promotion: promotion, page: page }),
            beforeSend: function beforeSend() {
                $('.ajax-gif').show();
            },
            success: function success(data) {
                $('.ajax-gif').hide();
                $('.products').html(data);
                removeActivePageClass();
                setActivePageClass(paginationBlockClass, "ul li", activePage, "current-page");
            },
            error: function error() {
                $('.ajax-gif').hide();
            }
        });
    }
});
var brandBlockClass = "js-brand";
var priceBlockClass = "js-prices";
var promotionBlockClass = "js-promotion";
var paginationBlockClass = "js-pagination";
var activePage = 1;

function get_filter(className, inputType) {
    var values = [];
    $('.' + className + ' ' + inputType).each(function (index, element) {
        values.push($(element).val());
    });

    return values;
}

function removeClassFromElements(parentElement, element, classNameForRemove) {
    $('.' + parentElement + ' ' + element).each(function (index, element) {
        $(element).removeClass(classNameForRemove);
    });
}

function removeClassFromElement(parentElement, element, classNameForRemove) {
    $('.' + parentElement + ' ' + element).removeClass(classNameForRemove);
}

function removeActivePageClass() {
    removeClassFromElement(paginationBlockClass, "ul li", "default-page");
    removeClassFromElements(paginationBlockClass, "ul li", "current-page");
}

function setActivePageClass(parentElement, element, elementNumber, classNameToAdd) {
    $('.' + parentElement + ' ' + element + ':eq(' + (elementNumber - 1) + ')').addClass(classNameToAdd);
}

function clear_filters() {
    $('#productFilterSection input:checkbox').each(function (index, element) {
        $(element).prop('checked', false);
    });
    $(".js-range-slider").data('ionRangeSlider').update({ from: 0, to: 300 });
}
//# sourceMappingURL=all_subCat.js.map