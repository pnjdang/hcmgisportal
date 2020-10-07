$(document).ready(function () {
    uiUpdate();
    uiEventUpdate();
});

function reloadTable(selector, url) {
    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",
        success: function (data) {
            $(selector).empty().append(data);
        },
        error: function (xhr, status) {
            alert("Sorry, there was a problem!");
        },
        complete: function (xhr, status) {
            //$('#showresults').slideDown('slow')
        }
    })
}
function uiEventUpdate(parent_id) {
    parent_id = typeof (parent_id) === 'undefined' ? '' : parent_id;
    ////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////
    $(parent_id + " .custom-add-more").on('click', function (e) {

        // Disable default
        e.preventDefault();
        // Get select for this
        var _this = $(this);
        // Get required attribute
        var parent = $(_this.attr('data-parent'));
        var itemname = _this.attr('data-item');
        var item = $(itemname);
        var initcounter = parent.children().length;
        var counter = typeof (item.attr('data-counter')) === 'undefined' ? initcounter : item.attr('data-counter');
        var removeButton = "<button class='display-none btn btn-danger btn-circle' id='btn_remove_add' style='position: absolute'>x</button>";

        var newitem = item.clone();
        var newitemid = newitem.attr('id') + counter

        newitem.attr('id', newitemid);

        parent.append(newitem);
        //Update name of all input
        $(itemname + counter + " input").each(function () {
            var _ts = $(this);
            _ts.attr('name', String.format(_ts.attr('name'), counter));
            _ts.attr('disabled', false);
        });

        $(itemname + counter + " select").each(function () {
            var _ts = $(this);
            _ts.attr('name', String.format(_ts.attr('name'), counter));
            _ts.attr('disabled', false);
        });

        // Check if remove button not exist
        if ($('#btn_remove_add').length === 0) {
            $(newitem.parent()).append(removeButton);
        }

        removeButton = $('#btn_remove_add');

        newitem.hover(function () {
            var posNewitem = newitem.position();

            removeButton.css('top', posNewitem.top);
            removeButton.css('left', posNewitem.left);

            removeButton.attr('data-ref-id', newitemid);
            removeButton.removeClass('display-none');
        });

        newitem.mouseleave(function () {
            if (!removeButton.is(':hover')) {
                removeButton.addClass('display-none');
            }
        })

        removeButton.on('click',function (e) {
            e.preventDefault();

            $('#' + removeButton.attr('data-ref-id')).remove();
            removeButton.addClass('display-none');

        });

        item.attr('data-counter', ++counter);

    });
    ///////////////////////////////////////////////////////
    $(".custom-search-datatable").on('click', function (e) {
        e.preventDefault();
        var _this = $(this);
        var form = $(_this.attr('data-form'));
        var table = $(_this.attr('data-table')).DataTable();
        var url = _this.attr('data-url');

        table.ajax.url(url + form.serialize());
        table.ajax.reload();
    });
    /////////////////////////////////////////////////////////
    $(parent_id + '.custom-submit-input').keydown(function (event) {
        if (event.keyCode == 13) {
            $($(this).attr('data-target')).click();
            return false;
        }
    });
    ////////////////////////////////////
    // data-target, data-submit, data-value
    $(parent_id + '.custom-click-bind-input').on('click', function (e) {
        var _this = $(this);
        var _target = $(_this.attr('data-target'));
        var _value = _this.attr('data-value');
        var _submit = _this.attr('data-submit');

        if (_target.val() !== _value) {
            _target.val(_value)
            $(_submit).click();
        }
    });
    //////////////////////////////////////
    /////////////////////////////////////
    $(parent_id + '.custom-click-bind-div').on('click', function (e) {
        var _this = $(this);
        var _target = $(_this.attr('data-div'));
        _target.text(' ' + _this.text());
    });
    //////////////////////////////////////
    // data-target, data-target-event, data-target-value, data-css
    $(parent_id + '.custom-base-on-other').each(function () {
        var _this = $(this);
        var target = _this.attr('data-target');
        var target_value = _this.attr('data-target-value');
        var target_event = _this.attr('data-target-event');
        var css = _this.attr('data-css');

        if ($(target).val() === target_value) {
            _this.addClass(css);
        } else {
            _this.removeClass(css);
        }

        $(target).on(target_event, function () {
            if ($(target).val() === target_value) {
                _this.addClass(css);
            } else {
                _this.removeClass(css);
            }
        });
    });

    ////////////////////////////////////////////
    //For toggle element
    $(parent_id + ' .custom-element-toggle').each(function () {
        var _this = $(this);
        var _event = _this.attr('data-event');
        var _prevent = _this.attr('data-prevent');
        var _toggleclass = _this.attr('data-toggle');
        var _target = _this.attr('data-target');

        _this.on(_event, function (e) {
            if (!checkUndefine(_prevent)) {
                e.preventDefault();
            }
            $(_target).toggleClass(_toggleclass);
        });
    });
    ///////////////////////////////////////////
    $(parent_id + ' .custom-element-load-ajax-div').each(function () {
        var _this = $(this);
        var _div = $(_this.attr('data-target-div'));
        _this.on('click', function () {
            $.ajax({
                url: _this.attr('data-url'),
                method: 'GET',
                success: function (html) {
                    _div.empty().append(html);
                    uiEventUpdate('#' + _div.parent('div').attr('id'));
                },
                error: function () {
                    _div.empty().append('' +
                        '<div class="modal-header">' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<h4 class="modal-title">Lỗi</h4>' +
                        '</div>' +
                        '<div class="modal-body">' +
                            '<div class="col-sm-12">' +
                                '<h4 class="font-red"><i class="fa fa-exclamation"></i> Xảy ra lỗi đường truyền</h4>' +
                            '</div>' +
                            '<div style="clear:both;"></div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                            '<button type="button" data-dismiss="modal" class="btn btn-default pull-right">Đóng</button>' +
                        '</div>');
                }
            });
        });
    });
    ////////////////////////////////////////////
    $(parent_id + ' .custom-div-ajax').each(function () {
        var _this = $(this);
        if (typeof(_this.attr('data-loaded')) === 'undefined') {
            $(_this.parent()).addClass('loading');
            $.ajax({
                url: _this.attr('data-url'),
                method: 'GET',
                async: true,
                success: function (html) {
                    _this.attr('data-loaded', true);
                    _this.empty().append(html);
                    uiEventUpdate('#' + _this.attr('id'));
                    $(_this.parent()).removeClass('loading');
                }
            });
        }
    });
    ////////////////////////////////////////////
    $(parent_id + ' .custom-replace-url').each(function () {
        var _this = $(this);
        _this.on('click', function () {
            if (_this.attr('data-replace') !== 'undefined') {
                window.history.pushState("object or string", "Title", _this.attr('data-url'));
            }
        });
    });
    ////////////////////////////////////////////
    $(parent_id + ' .custom-bind-value').each(function () {
        var _this = $(this);
        $(_this.attr('data-target')).empty().append(_this.val());
    });
    ////////////////////////////////////////////

    // For set active menu
    $(parent_id + " .custom-menu").each(function () {
        var _this = $(this);
        _this.children("li").each(function () {
            var _child = $(this);
            if (window.location.pathname.indexOf(_child.attr("id")) >= 0) {
                _child.addClass("active");
            } else {
                _child.removeClass("active");
            }
        });
        var _parent = $(_this.attr('data-parent'));
        _parent.click();
    });

    /////////////////////////////
    $(parent_id + ' .custom-trigger-tab').each(function () {
        var _this = $(this);
        _this.on('click', function () {
            $('a[href=' + _this.attr('href') + ']:not(.custom-trigger-tab)').trigger('click');
        });

    });
    /////////////////////////////
    //$('.validateform').validationEngine();
    ////////////////////////////
    $(parent_id + ' .custom-ajax-form').each(function() {
        var _this = $(this);
        var form = _this.find('form');

        form.submit(function () {
            var form = $(this);
            // return false if form still have some validation errors
            if (form.find('.has-error').length) {
                return false;
            }
            // submit form
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (response) {
                    form.closest('.custom-ajax-form').empty().append(response);
                }
            });
            return false;
        });
    })
}

function uiUpdate(parent_id) {
    parent_id = typeof (parent_id) === 'undefined' ? '' : parent_id;

    // TinyMCE editor
    //tinymce.init({
    //    selector: '.tinymce-editor',
    //    language: 'vi_VN',
    //    menu: {// this is the complete default configuration
    //        file: {title: 'File', items: 'newdocument'},
    //        edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
    //        insert: {title: 'Insert', items: 'link media | template hr'},
    //        view: {title: 'View', items: 'visualaid'},
    //        format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
    //        table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
    //        tools: {title: 'Tools', items: 'spellchecker code'}
    //    },
    //    plugins: [
    //        "advlist autolink lists link image charmap print preview anchor",
    //        "searchreplace visualblocks code fullscreen",
    //        "insertdatetime media table contextmenu paste",
    //        "lineheight"
    //    ],
    //    toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | fontselect fontsizeselect | forecolor backcolor | lineheightselect",
    //    lineheight_formats: "8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 36pt",
    //    theme_advanced_font_sizes: "8px,10px,12px,14px,16px,18px,20px,24px,32px,36px",
    //    theme_advanced_fonts: "Andale Mono=andale mono,times;" +
    //    "Arial=arial,helvetica,sans-serif;" +
    //    "Arial Black=arial black,avant garde;" +
    //    "Book Antiqua=book antiqua,palatino;" +
    //    "Comic Sans MS=comic sans ms,sans-serif;" +
    //    "Courier New=courier new,courier;" +
    //    "Century Gothic=century_gothic;" +
    //    "Georgia=georgia,palatino;" +
    //    "Gill Sans MT=gill_sans_mt;" +
    //    "Gill Sans MT Bold=gill_sans_mt_bold;" +
    //    "Gill Sans MT BoldItalic=gill_sans_mt_bold_italic;" +
    //    "Gill Sans MT Italic=gill_sans_mt_italic;" +
    //    "Helvetica=helvetica;" +
    //    "Impact=impact,chicago;" +
    //    "Iskola Pota=iskoola_pota;" +
    //    "Iskola Pota Bold=iskoola_pota_bold;" +
    //    "Symbol=symbol;" +
    //    "Tahoma=tahoma,arial,helvetica,sans-serif;" +
    //    "Terminal=terminal,monaco;" +
    //    "Times New Roman=times new roman,times;" +
    //    "Trebuchet MS=trebuchet ms,geneva;" +
    //    "Verdana=verdana,geneva;" +
    //    "Webdings=webdings;" +
    //    "Wingdings=wingdings,zapf dingbats"
    //});
    //////////////////////////////////////////////
    /*******************************************************/
    // Create number formar
    /*******************************************************/
    //$(parent_id + " .number-format-convert").each(function () {
    //    try {
    //        var _this = $(this);
    //        var prefix = _this.attr("number-prefix");
    //        var format = _this.attr("number-format");
    //        var value = this.tagName == 'INPUT' ? _this.val() : this.textContent;
    //        var res_value;
    //        ////console.log(_this);
    //        var _zero_format = _this.attr('number-zero');
    //
    //        ////console.log(value);
    //
    //        if (checkUndefine(value) || value == '')
    //            return;
    //        prefix = typeof (prefix) == 'undefined' ? '' : prefix;
    //
    //        ////console.log('check prefix');
    //
    //        if (!isNaN(Number.parseFloat(value.trim())))
    //            res_value = (Number.parseFloat(value.trim()).format(typeof (_zero_format) == 'undefined' ? 5 : _zero_format, 3, '.', ',')).toString();
    //        ////console.log(res_value);
    //        // Check for valid zero number
    //        if (typeof (_zero_format) == 'undefined' && typeof (res_value) != 'undefined') {
    //            var _index_comma = res_value.indexOf(',');
    //            //////console.log(_index_comma);
    //            if (_index_comma > -1) {
    //                var _zero_index = -1,
    //                    _zero_next = -1;
    //                for (var i = _index_comma + 1; i < res_value.length; i++) {
    //                    if (res_value[i] == '0') {
    //                        _zero_index = _zero_next == -1 ? i : _zero_index;
    //                        _zero_next = i;
    //                    } else {
    //                        _zero_next = -1;
    //                    }
    //                }
    //                if (_zero_next != -1 && _zero_index != -1) {
    //                    if (_zero_index == _index_comma + 1)
    //                        _zero_index--;
    //                    res_value = res_value.substring(0, _zero_index);
    //                }
    //            }
    //        }
    //
    //        if (typeof (res_value) != 'undefined') {
    //            _this.empty();
    //            ////console.log(this.tagName);
    //            this.tagName != 'INPUT' ? _this.append(res_value + " " + prefix) : _this.val(res_value + " " + prefix);
    //        }
    //    } catch (e) {
    //    }
    //});
    /////////////////////
    //$(parent_id + '.custom-astype-number').number(true, 0, ',', '.');

    // Update for step workflow
    $(parent_id + ' .step-nav').each(function () {
        var _this = $(this);
        var _childrens = _this.children();
        var _length = _childrens.length;
        for (var i = 0; i < _length; i++) {
            var _child = _childrens.eq(i);
            if (i >= step) {
                console.log(_child);
                _child.find('a').addClass('dis');
            } else if (i == step - 1) {
                _child.find('a').addClass('active');
            }
        }
    });

    // Create date format for class="date-format-convert" date-format="DMY".
    /*******************************************************/
    $(parent_id + ".date-format-convert").each(function () {
        var _this = $(this);
        var value = this.textContent.trim();
        if (checkUndefine(value) || value == '' || !isDate(value, 'yyyy-MM-dd'))
            return;
        _this.empty();
        //////console.log(getDateFromFormat(value, 'yyyy-MM-dd'));
        _this.append(formatDate(parseDate(value), 'dd/MM/yyyy'));
    });

    $(parent_id + ".datetime-format-convert").each(function () {
        var _this = $(this);
        var value = this.textContent.trim().split('.')[0];

        if (checkUndefine(value) || value == '' || !isDate(value, 'yyyy-MM-dd HH:mm:ss')) {
            return;
        }

        _this.empty();
        //////console.log(getDateFromFormat(value, 'yyyy-MM-dd'));
        _this.append(formatDate(new Date(getDateFromFormat(value, 'yyyy-MM-dd HH:mm:ss')), 'dd/MM/yyyy'));
    });



    //////////////////////AJAX SELECT SEARCH
    $(parent_id + " .custom-select2").each(function () {
        var _this = $(this);
        var _url = _this.attr('data-url');
        var _options = {
            theme: 'bootstrap',
            language: {
                inputTooLong: function (args) {
                    var overChars = args.input.length - args.maximum;

                    var message = 'Vui lòng nhập ít hơn ' + overChars + ' ký tự';

                    if (overChars != 1) {
                        message += 's';
                    }

                    return message;
                },
                inputTooShort: function (args) {
                    var remainingChars = args.minimum - args.input.length;

                    var message = 'Vui lòng nhập nhiều hơn ' + remainingChars + ' ký tự"';

                    return message;
                },
                loadingMore: function () {
                    return 'Đang lấy thêm kết quả…';
                },
                maximumSelected: function (args) {
                    var message = 'Chỉ có thể chọn được ' + args.maximum + ' lựa chọn';

                    return message;
                },
                noResults: function () {
                    return 'Không tìm thấy kết quả';
                },
                searching: function () {
                    return 'Đang tìm…';
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 0
        };
        if (typeof(_url) !== 'undefined') {
            _options.ajax = {
                url: _url,
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, page) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data.results
                    };
                },
                cache: true
            };
            _options.minimumInputLength = 1;
        }
        _this.select2(_options);
    });

    //////////////////////////////////////
    /********************************************************************
     // Export word: btn-word-export, target: data-target
     /********************************************************************/
    $(parent_id + ".btn-word-export").on('click', function (e) {
        // Escape default functional
        e.preventDefault();
        // Get target data
        var _this = $(this);
        var target = _this.attr('data-target');
        var filename = _this.attr('data-filename');
        var _url = _this.attr('data-url');
        var _filter = _this.attr('data-filter');
        // Check valid target
        if (!checkUndefine(_url)) {
            $.ajax({
                url: _url,
                data: $(_filter).serialize(),
                success: function (data) {
                    $(target).empty().append(data);
                    $(target).wordExport(filename);
                }
            });
            return;
        }

        if (checkUndefine(target)) {
            return;
        }
        // Check filename
        if (checkUndefine(filename)) {
            filename = 'ExportFile';
        }
        // Export as word
        $(target).wordExport(filename);
    });


/////////////////////////////////////////////////
//    $(parent_id + ' .selectpicker').selectpicker();
    ////////////////////////////////////////////
    uiMenuUpdate();

}

function uiMenuUpdate() {
    $(' .custom-active-menu').each(function () {
        var _this = $(this);
        var menu = $(_this.attr('data-menu'));
        menu.addClass('active');
    });

    if (window.location.hash !== "") {
        $('a[href="' + window.location.hash + '"]').click()
    }

    //$('[data-toggle=confirmation]').confirmation();
}

function callAjaxFunction() {

    var _this = $(this);
    var urlajax = _this.attr('data-ajax-url');
    var methodajax = _this.attr('data-ajax-method');
    var isreload = _this.attr('data-ajax-reload');
    var _form = $(_this.attr('data-ajax-form'));

    $.ajax({
        url: urlajax,
        data: !checkUndefine(_form) ? _form.serialize() : {},
        method: !checkUndefine(methodajax) ? methodajax : 'POST',
        success: function (link) {
            if (!checkUndefine(isreload) && isreload) {
                //console.log(link);
                window.location = link;
            }
        }
    });
}

var chartOptions =
{
    tooltipTemplate: "<%= label %>:<%= value %>",
    legendTemplate: '<ul>'
    + '<% for (var i=0; i<datasets.length; i++) { %>'
    + '<li>'
    + '<span style=\"background-color:<%=datasets[i].fillColor%>\"><% if (datasets[i].label) { %><%= datasets[i].label %><% } %></span>'
    + ''
    + '</li>'
    + '<% } %>'
    + '</ul>',
    onAnimationComplete: function ()
    {
        this.showTooltip(this.segments, true);
        //Show tooltips in bar chart (issue: multiple datasets doesnt work http://jsfiddle.net/5gyfykka/14/)
        //this.showTooltip(this.datasets[0].bars, true);

        //Show tooltips in line chart (issue: multiple datasets doesnt work http://jsfiddle.net/5gyfykka/14/)
        //this.showTooltip(this.datasets[0].points, true);
    }
    ,
    tooltipEvents: [],
    showTooltips: true
};

function checkUndefine(objCheck) {
    return typeof(objCheck) === 'undefined';
}