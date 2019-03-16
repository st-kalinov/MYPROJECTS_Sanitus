"use strict";

var brandBlockClass = "js-brand";
var priceBlockClass = "js-prices";
var promotionBlockClass = "js-promotion";
var paginationBlockClass = "js-pagination";
var previousPageClass = ".page-previous-item";
var nextPageClass = ".page-next-item";

var activePage = 1;

function get_filter(className, inputType) {
    var values = [];
    $("." + className + " " + inputType).each(function (index, element) {
        values.push($(element).val());
    });

    return values;
}

function removeClassFromElements(parentElement, element, classNameForRemove) {
    $("." + parentElement + " " + element).each(function (index, element) {
        $(element).removeClass(classNameForRemove);
    });
}

function removeClassFromElement(parentElement, element, classNameForRemove) {
    $("." + parentElement + " " + element).removeClass(classNameForRemove);
}

function removeActivePageClass() {
    removeClassFromElement(paginationBlockClass, "ul li", "default-page");
    removeClassFromElements(paginationBlockClass, "ul li", "current-page");
}

function setActivePageClass(parentElement, element, elementNumber, classNameToAdd) {
    $("." + parentElement + " " + element + ':eq(' + elementNumber + ')').addClass(classNameToAdd);
}

function setPreviousPage_dataPage(parentElement, element, className, dataValueToAdd) {
    if (dataValueToAdd >= 1) {
        $("." + parentElement + " " + element + className).data('page', dataValueToAdd);
    }
}

function setNextPage_dataPage(parentElement, element, className, dataValueToAdd) {
    var $element = $("." + parentElement + " " + element + className);
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
//# sourceMappingURL=filtering-functions.js.map