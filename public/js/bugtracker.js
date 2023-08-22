$(document).ready(function () {

    $(document).on('click', '#add-link, #add-img', function () {
        var el = $(this);
        var lastSiblingInputValue = el.siblings('input:last').val();
        if (lastSiblingInputValue.length <= 0 || el.is(':disabled') || el.siblings('input:last').hasClass('not-legit')) {
            return;
        }

        var valueLength = 0;
        el.siblings('input').each(function (index, input) {
            valueLength += $(input).val().length;
        });

        if (valueLength >= 240) {
            Swal.fire({
              title: "Limit reached",
              text: "you are not allowed to add more.. sorry",
              type: "warning",
            });
            return;
        }

        var toAppend = '<input class="form-control image-upload" type="text" name="img[]" placeholder="https://i.imgur.com/Dokbyyd.jpg" style="margin-top:5px;">' +
            '<span class="not-legit-explanation" style="display: none">Make sure its imgur link and ends with valid image extension (jpg,jpeg,png)</span>';
        if (el.attr('id') === 'add-link') {
            toAppend = '<input class="form-control" type="text" name="link[]" style="margin-top:5px;">';
        }

        $(toAppend).insertAfter(el.siblings('input:last'));
    });


    $(document).on('change', 'input.image-upload', function () {
        var el = $(this);
        if (el.val().length === 0) {
            el.siblings('span.not-legit-explanation:last').fadeOut();
            el.removeClass('not-legit');
            return;
        }
        var value = el.val();
        var substring = 'https://i.imgur.com/';
        var jpg = '.jpg';
        var png = '.png';
        var jpeg = '.jpeg';
        if (!value.includes(substring)) {
            el.addClass('not-legit');
            el.siblings('span.not-legit-explanation:last').fadeIn();
            return;
        }

        if (!value.includes(jpg) && !value.includes(png) && !value.includes(jpeg)) {
            el.siblings('span.not-legit-explanation:last').fadeIn();
            el.addClass('not-legit');
            return;
        }

        var valueAsArray = value.split('.');
        value = valueAsArray[valueAsArray.length - 1];
        if (value !== 'jpg' && value !== 'png' && value !== 'jpeg') {
            el.siblings('span.not-legit-explanation:last').fadeIn();
            el.addClass('not-legit');
            return;
        }

        el.siblings('span.not-legit-explanation:last').fadeOut();
        el.removeClass('not-legit');
    });

    $(document).on('click', '.save-btn', function (e) {
        $('input.not-legit').each(function (index, element) {
            $(element).fadeOut();
            $(element).fadeIn();
            e.preventDefault();
        })
    });



    $(document).on('change', '#category', function (e) {
        updateSubcategories();
    });

    function updateSubcategories(load) {
        if (typeof load === 'undefined') {
            load = false;
        }
        var categoriesSelect = $('#category');
        var el = $('#subcategory');
        var selectedCategoryOption = categoriesSelect.find(":selected");
        var categoryId = selectedCategoryOption.attr('data-category');
        var shouldSelectFirst = true;
        var visibleElementsCount = 0;
        $.each(el.children(), function (index, element) {
            element = $(element);
            if (element.attr('data-category') !== categoryId) {
                element.hide();
            } else {
                if (shouldSelectFirst && !load) {
                    shouldSelectFirst = false;
                    el.val(element.val());
                }
                element.show();
                visibleElementsCount++;
            }
        });
        if (!load) {
            hideOrShowSelectBlock(el, visibleElementsCount);
        }
    }

    function hideOrShowSelectBlock(el, count) {
        if (count === 0) {
            el.parent().fadeOut();
            el.attr('disabled', 'disabled');
        } else {
            el.parent().fadeIn();
            el.removeAttr('disabled');
        }
    }

    $(document).on('change', '#expansion', function (e) {
        var el = $(this);
        if (el.val() === '0') {
            var area = $('#area');
            area.attr('disabled', 'disabled');
            area.parent().fadeOut();
            var zone = $('#zone');
            zone.attr('disabled', 'disabled');
            zone.parent().fadeOut();
            return;
        }
        updateAreas();
    });

    function updateAreas(load) {
        if (typeof load === 'undefined') {
            load = false;
        }
        var expansionSelect = $('#expansion');
        var el = $('#area');
        var selectedExpansion = expansionSelect.find(":selected");
        var expansionId = selectedExpansion.attr('data-expansion');
        var shouldSelect = true;
        $.each(el.children(), function (index, element) {
            element = $(element);
            if (element.attr('data-expansion') !== expansionId) {
                element.hide();
            } else {
                if (shouldSelect && !load) {
                    shouldSelect = false;
                    el.val(element.val());
                }
                element.show();
            }
        });
        if (!load) {
            hideOrShowSelectBlock(el, 1);
        }
        updateZones(load);
    }

    $(document).on('change', '#area', function (e) {
        updateZones();
    });

    function updateZones(load) {
        if (typeof load === 'undefined') {
            load = false;
        }
        var expansionSelect = $('#area');
        var el = $('#zone');
        var selectedExpansion = expansionSelect.find(":selected");
        var expansionId = selectedExpansion.val();
        var shouldSelect = true;
        $.each(el.children(), function (index, element) {
            element = $(element);
            if (element.attr('data-area') !== expansionId) {
                element.hide();
            } else {
                if (shouldSelect && !load) {
                    shouldSelect = false;
                    el.val(element.val());
                }
                element.show();
            }
        });
        if (!load) {
            hideOrShowSelectBlock(el, 1);
        }
    }

    updateSubcategories(true);

    if ($('#expansion').val() !== '0') {
        updateAreas(true);
    }
});
