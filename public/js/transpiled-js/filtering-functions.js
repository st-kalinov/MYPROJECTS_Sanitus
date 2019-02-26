"use strict";

var brandBlockClass = "js-brand";
var priceBlockClass = "js-prices";
var promotionBlockClass = "js-promotion";
var paginationBlockClass = "js-pagination";
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
    $("." + parentElement + " " + element + ':eq(' + (elementNumber - 1) + ')').addClass(classNameToAdd);
}

function clear_filters() {
    $('#productFilterSection input:checkbox').each(function (index, element) {
        $(element).prop('checked', false);
    });
    $(".js-range-slider").data('ionRangeSlider').update({ from: 0, to: 300 });
}
//# sourceMappingURL=filtering-functions.js.map