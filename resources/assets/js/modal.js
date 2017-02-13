/**
 * Displays a modal dialog box with a specified message, along with an OK and a Cancel button
 */
function modalConfirm(title, body, callback)
{
    var dlg = $('#modal');
    dlg.find('.modal-title').html(title);
    dlg.find('.modal-body').html(body);
    dlg.find('.cancle-button').show();
    dlg.modalDialog(function(btn) {
        if (callback) { callback(btn.data('result') == 'ok'); }
    });
}

/**
 * Displays a modal alert box with a specified message and an OK button
 */
function modalAlert(title, body, callback)
{
    var dlg = $('#modal');
    dlg.find('.modal-title').html(title);
    dlg.find('.modal-body').html(body);
    dlg.find('.cancle-button').hide();
    dlg.modalDialog(function(btn) {
        if (callback) { callback(btn.data('result') == 'ok'); }
    });
}

(function ($) {
    "use strict";

    /**
     * Displays a modal dialog
     */
    $.fn.modalDialog = function(callback) {
        $(this).each(function () {
            var dlg = $(this);
            dlg.find('button[data-dismiss="modal"]').unbind('click').click(function(event) {
                if (callback) {
                    var res = callback($(this));
                    if (res === false) {
                        event.preventDefault();
                        event.stopImmediatePropagation();
                    }
                }
            });
            dlg.modal();
        });
    };

    /**
     * Centers modals vertically on the screen
     */
    function centerModal() {
        var modal = $(this);
        modal.css('display', 'block');
        var dialog = modal.find('.modal-dialog');
        var offset = ($(window).height() - dialog.height()) / 2;
        var bottomMargin = parseInt(dialog.css('marginBottom'), 10);

        // Make sure you don't hide the top part of the modal w/ a negative margin if it's longer than the screen
        // height, and keep the margin equal to the bottom margin of the modal
        if (offset < bottomMargin) { offset = bottomMargin; }
        dialog.css('margin-top', offset);
    }
    $(document).on('show.bs.modal', '.modal', centerModal);
    $(window).on('resize', function () {
        $('.modal:visible').each(centerModal);
    });

}(jQuery));