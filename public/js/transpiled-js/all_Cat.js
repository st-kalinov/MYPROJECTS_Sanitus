'use strict';

$(document).ready(function () {
    var mainCategorySlug = $('#Options').find('h2.main-category:first').data('slug');
    var subCategorySlug = $('#Options').find('h2.main-category:first').data('sub-slug');
    var categorySlug = $('#Options').find('h2.main-category:first').data('cat-slug');
    var route = Routing.generate('app_products_main_sub_category_filtered', { slug: mainCategorySlug, slugSub: subCategorySlug, slugCat: categorySlug }, true);

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
                setPreviousPage_dataPage(paginationBlockClass, "ul li", previousPageClass, page - 1);
                setNextPage_dataPage(paginationBlockClass, "ul li", nextPageClass, page + 1);
            },
            error: function error() {
                $('.ajax-gif').hide();
            }
        });
    }

    toggleArrowIcon();
});
var brandBlockClass = "js-brand";
var priceBlockClass = "js-prices";
var promotionBlockClass = "js-promotion";
var paginationBlockClass = "js-pagination";
var previousPageClass = ".page-previous-item";
var nextPageClass = ".page-next-item";

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
    $('.' + parentElement + ' ' + element + ':eq(' + elementNumber + ')').addClass(classNameToAdd);
}

function setPreviousPage_dataPage(parentElement, element, className, dataValueToAdd) {
    if (dataValueToAdd >= 1) {
        $('.' + parentElement + ' ' + element + className).data('page', dataValueToAdd);
    }
}

function setNextPage_dataPage(parentElement, element, className, dataValueToAdd) {
    var $element = $('.' + parentElement + ' ' + element + className);
    var $prevElementDataPage = $element.prev().data('page');

    if (dataValueToAdd <= $prevElementDataPage) {
        $element.data('page', dataValueToAdd);
    } else {
        $element.data('page', $prevElementDataPage);
    }
}

function clear_filters() {
    $('#productFilterSection input:checkbox').each(function (index, element) {
        $(element).prop('checked', false);
    });
    $(".js-range-slider").data('ionRangeSlider').update({ from: 0, to: 300 });
}

(function collapseFilterBlocks() {
    $(window).resize(function () {
        var windowWidth = $(window).width();
        if (windowWidth < 1000) {
            $('#collapse1').removeClass('show');
            $('#collapse2').removeClass('show');
            $('#collapse3').removeClass('show');
        } else {
            $('#collapse1').addClass('show');
            $('#collapse2').addClass('show');
            $('#collapse3').addClass('show');
        }
    });
})();

function toggleArrowIcon() {
    $('h2.attribute-name').on('click', function (e) {
        $(e.target).children('i').toggleClass('fas fa-chevron-circle-up fas fa-chevron-circle-down');
    });
    $('h2.attribute-name i').on('click', function (e) {
        $(e.target).toggleClass('fas fa-chevron-circle-up fas fa-chevron-circle-down');
    });
}
//# sourceMappingURL=all_Cat.js.map