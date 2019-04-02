
shortcut.add("Ctrl+s", function () {
    $(".btn-edit-contact").click();
});
shortcut.add("Ctrl+Shift+a", function () {
    $("input.tbl-item-checkbox").prop('checked', true);
    $('.custom_right_menu').addClass('checked');
    show_number_selected_row();
});
shortcut.add("Esc", function () {
    $("input.tbl-item-checkbox").prop('checked', false);
    $('.checked').removeClass('checked');
    $(".menu").hide();
});

shortcut.add("Ctrl+i", function () {
    $(".add_item_modal_fetch").modal('hide');
});