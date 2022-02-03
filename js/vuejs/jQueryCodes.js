  (function ($) {
  
  jQuery(document).on('ready', function () {
  
 if(jQuery('.custom-select').length){
            alert(jQuery('.custom-select').length);
             initCustomSelect();
        }
            function initCustomSelect(){

// Iterate over each select element
$('select.hidden-select').each(function () {

    // Cache the number of options
    var $originalSelectElement = $(this),
        numberOfOptions = $(this).children('option').length;

    // Hides the select element
    $originalSelectElement.addClass('s-hidden');

    // Wrap the select element in a div
    $originalSelectElement.wrap('<div class="custom-select"></div>');

    // Insert a styled div to sit over the top of the hidden select element
    $originalSelectElement.after('<div class="le-select"></div>');

    // Cache the styled div
    var $leSelect = $originalSelectElement.next('div.le-select');

    // Show the first select option in the styled div
    $leSelect.text($originalSelectElement.children('option').eq(0).text());

    // Insert an unordered list after the styled div and also cache the list
    var $list = $('<ul />', {
        'class': 'options'
    }).insertAfter($leSelect);

    // Insert a list item into the unordered list for each select option
    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $originalSelectElement.children('option').eq(i).text(),
            rel: $originalSelectElement.children('option').eq(i).val()
        }).appendTo($list);
    }

    // Cache the list items
    var $listItems = $list.children('li');

    // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
    $leSelect.click(function (e) {
        e.stopPropagation();
        $('div.le-select.active').each(function () {
            $(this).removeClass('active').next('ul.options').hide();
        });
        $(this).toggleClass('active').next('ul.options').toggle();
    });

    // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
    // Updates the select element to have the value of the equivalent option
    $listItems.click(function (e) {
        e.stopPropagation();
        $leSelect.text($(this).text()).removeClass('active');
        $originalSelectElement.val($(this).attr('rel'));
        $originalSelectElement.trigger('change');
        $list.hide();
        /* alert($originalSelectElement.val()); Uncomment this for demonstration! */
    });

    // Hides the unordered list when clicking outside of it
    $(document).click(function () {
        $leSelect.removeClass('active');
        $list.hide();
    });

});

}

});
})(jQuery);