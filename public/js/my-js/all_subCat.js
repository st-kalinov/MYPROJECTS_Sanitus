$(document).ready(function () {
    const mainCategorySlug = $('#Options').find('h2.main-category:first').data('slug');
    const subCategorySlug = $('#Options').find('h2.main-category:first').data('sub-slug');
    const route = Routing.generate('app_products_main_subcategory_filtered', {slug: mainCategorySlug, slugSub: subCategorySlug}, true);

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
                setPreviousPage_dataPage(paginationBlockClass, "ul li", previousPageClass, page - 1);
                setNextPage_dataPage(paginationBlockClass, "ul li", nextPageClass, page + 1);
            },
            error: function () {
                $('.ajax-gif').hide();
            }
        });
    }

    toggleArrowIcon();
});
const brandBlockClass = "js-brand";
const priceBlockClass = "js-prices";
const promotionBlockClass = "js-promotion";
const paginationBlockClass = "js-pagination";
const previousPageClass = ".page-previous-item";
const nextPageClass = ".page-next-item";

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
    $(`.${parentElement} ${element}` + ':eq(' + (elementNumber) + ')').addClass(classNameToAdd);
}

function setPreviousPage_dataPage(parentElement, element, className, dataValueToAdd) {
    if(dataValueToAdd >= 1) {
        $(`.${parentElement} ${element}${className}`).data('page', dataValueToAdd);
    }
}

function setNextPage_dataPage(parentElement, element, className, dataValueToAdd) {
    let $element = $(`.${parentElement} ${element}${className}`);
    let $prevElementDataPage = $element.prev().data('page');

    if(dataValueToAdd <= $prevElementDataPage) {
        $element.data('page', dataValueToAdd);
    }
    else {
        $element.data('page', $prevElementDataPage);
    }
}

function clear_filters() {
    $('#productFilterSection input:checkbox').each((index, element) => {
        $(element).prop('checked', false);
    });
    $(".js-range-slider").data('ionRangeSlider').update({from: 0, to: 300});
}

(function collapseFilterBlocks()
{
    $(window).resize(() => {
        let windowWidth = $( window ).width();
        if(windowWidth < 1000) {
            $('#collapse1').removeClass('show');
            $('#collapse2').removeClass('show');
            $('#collapse3').removeClass('show');

        }
        else {
            $('#collapse1').addClass('show');
            $('#collapse2').addClass('show');
            $('#collapse3').addClass('show');
        }
    });
}());


function toggleArrowIcon() {
    $('h2.attribute-name').on('click', function (e) {
        $(e.target).children('i').toggleClass('fas fa-chevron-circle-up fas fa-chevron-circle-down');
    });
    $('h2.attribute-name i').on('click', function (e) {
        $(e.target).toggleClass('fas fa-chevron-circle-up fas fa-chevron-circle-down');
    });
}

