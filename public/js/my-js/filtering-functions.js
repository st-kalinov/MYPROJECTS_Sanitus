const brandBlockClass = "js-brand";
const priceBlockClass = "js-prices";
const promotionBlockClass = "js-promotion";
const paginationBlockClass = "js-pagination";
var activePage = 1;

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
    $(`.${parentElement} ${element}` + ':eq(' + (elementNumber - 1) + ')').addClass(classNameToAdd);
}

function clear_filters() {
    $('#productFilterSection input:checkbox').each((index, element) => {
        $(element).prop('checked', false);
    });
    $(".js-range-slider").data('ionRangeSlider').update({from: 0, to: 300});
}
