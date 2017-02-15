jQuery(document).ready(function($) {

    /**
     * Base URL of the application.
     */
    window.baseUrl = $('meta[name="base-url"]').attr('content').replace(/\/$/, '') + '/';

    /**
     * Set the language of the datepickers.
     */
    moment.locale($('html').attr('lang'));

    /**
     * Solve the 'X-CSRF-TOKEN' problem by ajax calls ('TokenMismatchException:  in ... VerifyCsrfToken.php on line 46')
     *
     * Need the following meta-tag in the main layout:
     *      <meta name="csrf-token" content="{{ csrf_token() }}" />
     *
     * @link http://laravel.io/forum/01-30-2015-laravel5-tokenmismatchexception-in-verifycsrftoken
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * Adds functionality to the form clear icon
     */
    $('.has-clear .form-control-clear').on('click', function() {
        $(this).parents('.input-group').find('input').val('').trigger('change');
        var url = $(this).data('clear-redirect');
        if (url != '') {
            $(this).removeClass('glyphicon-remove')
                .addClass('glyphicon-refresh')
                .addClass('glyphicon-refresh-animate');
            window.location.replace(url);
        }
    });

    /**
     * Adds a form clear icon if the input field is not empty
     */
    $('.has-clear input').on('keyup', function() {
        if ($(this).val() == '') {
            $(this).parents('.input-group').addClass('has-empty-value');
        }
        else {
            $(this).parents('.input-group').removeClass('has-empty-value');
        }
    }).trigger('change');

    /**
     * Adds functionality to the Form Control Add Button
     */
    $('.form-control-add').click(function() {
        var el = $(this);
        var field = el.data('field');
        var partial = el.data('partial');

        // find the first unused index
        var index = 0;
        while ($('[name="' + field + '[' + index + ']"]').length) {
            index++;
        }

        // insert the partial view just above the button
        el.before(partial.replace(/\{index}/g, index));
    });

    /**
     * Adds functionality to the Form Control Remove Icon
     */
    var form = $('form');
    form.on('click', '.form-control-remove', function() {
        $(this).closest('.form-group').remove();
    });

    /**
     * Adds a smooth spinning effect to submits with glyphicon icons that is shown
     * on submit can be turned off by adding the class "no-spinner" to the icon span.
     */
    form.submit(function() {
        //already submitted -> prevent double submition
        var icon = $(this).find(':submit span.glyphicon').not('.no-spinner');
        if (icon.hasClass('glyphicon-refresh-animate')) {
            return false;
        }

        //remove all other glyphicons to avoid any other spinning icon
        icon.removeClass(function (index, css) {
            return (css.match (/(^|\s)glyphicon-\S+/g) || []).join(' ');
        }).addClass('glyphicon-refresh').addClass('glyphicon-refresh-animate');
    });

    /**
     * Adds a confirm message to buttons/links with the class "delete-button"
     */
    $('.delete-button').click(function() {
        return confirm('Wollen Sie diesen Datensatz endgültig löschen?');
    });

    /**
     * An unchecked checkbox does not send any data when your form is submitted. This means that you will not see
     * negative responses to checkbox data. To fix this, add a hidden field with the same name as your checkbox field
     * directly before the checkbox.
     */
    $('form input:checkbox[value="1"]').each(function () {
        var el = $(this);
        $('<input type="hidden" value="0">').attr('name', el.attr('name')).insertBefore(el);
    });

    /**
     * Datetimepickers
     * Source: https://github.com/Eonasdan/bootstrap-datetimepicker
     */

    var momentJsFormatTag = $('meta[name="momentJsFormats"]');

    $('.timepicker').each(function () {
        var input = $(this);
        var picker = input.next().hasClass('input-group-addon') ? input.parent() : input;
        picker.datetimepicker({
            format: momentJsFormatTag.data('time'),
            useCurrent: false,
            showClear: true,
            showClose: true,
            showTodayButton: true,
            toolbarPlacement: 'bottom'
        });
    });

    $('.datetimepicker, .datepicker').each(function () {
        var input = $(this);
        var srcFormat = input.hasClass('datetimepicker') ? 'YYYY-MM-DD HH:mm:ss' : 'YYYY-MM-DD';
        var dstFormat = momentJsFormatTag.data(input.hasClass('datetimepicker') ? 'datetime' : 'date');
        var value = input.val();
        var clone = $('<input type="hidden">').attr('name', input.attr('name')).val(value);
        if (value) {
            input.val(moment(value, srcFormat).format(dstFormat));
        }

        var picker = input.next().hasClass('input-group-addon') ? input.parent() : input;
        picker.datetimepicker({
            format: dstFormat,
            useCurrent: false,
            showClear: true,
            showClose: true,
            showTodayButton: true,
            calendarWeeks: true
        });

        input.removeAttr('name').after(clone);

        clone.on('change', function () {
            var value = clone.val();
            if (value) {
                picker.data('DateTimePicker').date(moment(value, srcFormat));
            }
            else {
                picker.data('DateTimePicker').clear();
            }
        });

        picker.on('dp.change', function (e) {
            clone.val(e.date ? e.date.format(srcFormat) : '');
        });
    });

    /**
     * Selectize
     * http://brianreavis.github.io/selectize.js/
     */
    $('input.selectize, select').not('.notDefaultSelectize').each(function () {
        var el = $(this);

        if (el.attr('required')) {
            el.attr('required', false); // Bugfix "Required field cannot be focused", see https://github.com/brianreavis/selectize.js/issues/63
        }

        el.selectize({
            plugins: ['remove_button' /*, 'restore_on_backspace'*/ ],
            delimiter: ',', // erforderlich für INPUT-Field
            persist: false,
            //sortField: 'text',
            //allowEmptyOption: true,
            maxItems: el.attr('multiple') || el.data('multiple') ? (el.data('max') || null) : 1, //  null for none limit
            //valueField: 'value',
            //labelField: 'text',
            create: el.data('add') ? function(input) { 	// wenn gesetzt, können neue Einträge angelegt werden
                return {
                    value: input,
                    text: input
                }
            } : undefined,
            load: el.data('url') ? function (query, callback) { // Auswahl dynamisch erweitern
                if (!query.length) { return callback(); }
                $.ajax({
                    method: 'GET',
                    url: el.data('url') + '/' + encodeURIComponent(query)
                }).fail(function() {
                    callback();
                }).done(function(res) {
                    //el[0].selectize.clearOptions();
                    callback(res);
                });
            } : undefined
        });
    });
});
