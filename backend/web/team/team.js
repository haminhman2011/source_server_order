'use strict';
const Message = (function($) {
    let lang = $('html').attr('lang');
    if (lang === 'vi') {
        return {
            validateInput: 'Vui lòng nhập giá trị.',
            validateSelect: 'Vui lòng chọn giá trị.',
            validateEmail: 'Email không hợp lệ.',
            validatePassword: 'Mật khẩu yếu.',
            blockUI: 'Vui lòng đợi...',
            errorSummary: 'Vui lòng sửa các lỗi sau đây:',
            select2Placeholder: 'Chọn',
            success: 'Thành công',
            warning: 'Cảnh báo',
            fail: 'Thất bại',
        };
    }

    return {
        validateInput: 'Please input value.',
        validateSelect: 'Please select value.',
        validateEmail: 'Email is invalid.',
        validatePassword: 'Weak password.',
        blockUI: 'Please wait...',
        errorSummary: 'Please fix the following errors:',
        select2Placeholder: 'Choose',
        success: 'Success',
        warning: 'Warning',
        fail: 'Fail',
    };
})(jQuery);
const Team = (function($) {
    let lang = $('html').attr('lang');

    // Handles Bootstrap Modals.
    const handleModals = function() {
        // fix stackable modal issue: when 2 or more modals opened, closing one of modal will remove .modal-open class.
        $(document).on('hidden.bs.modal', function() {
            if ($('.modal:visible').length) {
                $('body').addClass('modal-open');
            }
        });

        // fix page scrollbars issue
        $(document).on('show.bs.modal', '.modal', function() {
            if ($(this).hasClass('modal-scroll')) {
                $('body').addClass('modal-open-noscroll');
            }
        });

        // fix page scrollbars issue
        $(document).on('hidden.bs.modal', '.modal', function() {
            $('body').removeClass('modal-open-noscroll');
        });

        // remove ajax content and remove cache on modal closed
        $(document).on('hidden.bs.modal', '.modal:not(.modal-cached)', function() {
            $(this).removeData('bs.modal');
        });
    };

    // Handle Select2 Dropdowns
    const handleSelect2 = function() {
        if ($.isFunction($.fn.select2)) {
            //Select2 default config
            $.extend(true, $.fn.select2.defaults.defaults, {
                width: '100%',
                allowClear: true,
                placeholder: Message.select2Placeholder,
                theme: 'bootstrap',
            });
            $('.select').select2();
            //Select2 ajax plugin
            $.fn.select2Ajax = function(options) {
                let settings = {
                    ajax: {
                        url: options.url,
                        dataType: 'json',
                        delay: 50,
                        data: function(params) {
                            let paramFinal = {
                                query: params.term, // search term
                                page: params.page,
                            };
                            if ($.isFunction(options.data)) {
                                options.data(params);
                                $.extend(paramFinal, params);
                            }
                            return paramFinal;
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.items,
                                pagination: {
                                    more: (params.page * 10) <= data.total_count,
                                },
                            };
                        },
                        cache: true,
                    },
                    escapeMarkup: function(markup) {
                        return markup;
                    },
                    minimumInputLength: options.hasOwnProperty(
                        'minimumInputLength') ? options.minimumInputLength : 0,
                    templateResult: options.hasOwnProperty('templateResult') ? options.templateResult : function(repo) {
                        if (repo.loading) return repo.text;
                        let column = options.hasOwnProperty('column') ? options.column : '';
                        if (column !== '' &&
                            typeof repo[column] !== 'undefined') {
                            return `<div class=\'select2-result-repository clearfix\'><div class=\'select2-result-repository__title\'> ${repo[column]} </div>`;
                        } else {
                            if (typeof repo['name'] !== 'undefined') {
                                return `<div class=\'select2-result-repository clearfix\'><div class=\'select2-result-repository__title\'> ${repo['name']} </div>`;
                            }
                            if (typeof repo['code'] !== 'undefined') {
                                return `<div class=\'select2-result-repository clearfix\'><div class=\'select2-result-repository__title\'> ${repo['code']} </div>`;
                            }
                        }
                    },
                    templateSelection: options.hasOwnProperty('templateSelection')
                        ? options.templateSelection
                        : function(repo) {
                            let column = options.hasOwnProperty('column') ? options.column : '';
                            let val = repo.text;
                            if (column !== '' && typeof repo[column] !== 'undefined') {
                                val = repo[column];
                            } else {
                                if (typeof repo.name !== 'undefined') {
                                    val = repo['name'];
                                }
                                if (typeof repo.code !== 'undefined') {
                                    val = repo['code'];
                                }
                            }
                            return val;
                        },
                };
                return this.select2(settings);
            };
        }
    };

    // Handle Bootstrap Datepicker
    const handleDatepicker = function() {
        if ($.isFunction($.fn.datepicker)) {
            //Datepicker default config
            $.extend(true, $.fn.datepicker.defaults, {
                format: 'dd-mm-yyyy',
                autoclose: true,
                orientation: 'bottom left',
                todayHighlight: true,
                language: lang,
                todayBtn: true,
                // clearBtn: true
            });
            $('.datepicker, .input-group.date').datepicker();
        }
    };

    // Handle Bootstrap datetimepicker
    const handleDatetimepicker = function() {
        if ($.isFunction($.fn.datetimepicker)) {
            //Datepicker default config
            $.extend(true, $.fn.datetimepicker.defaults, {
                format: 'dd-mm-yyyy hh:i',
                autoclose: true,
                orientation: 'bottom left',
                todayHighlight: true,
                todayBtn: true,
                clearBtn: true
            });
            $('.datetimepicker').datetimepicker();
        }
    };

    

    // Handle Bootstrap Timepicker
    const handleTimepicker = function() {
        if ($.isFunction($.fn.timepicker)) {
            $.extend(true, $.fn.timepicker.defaults, {
                showMeridian: false,
                explicitMode: true,
                defaultTime: false,
            });
            $('.timepicker, .input-group.time').timepicker({
                showMeridian: false,
                explicitMode: true,
                defaultTime: false,
            });
        }
    };

    // Handle Alphanum JS
    const handleAlphanum = function() {
        if ($.isFunction($.fn.alphanum)) {
            //input có class alphanum chỉ được nhập chữ và số
            $('.alphanum').alphanum({
                allow: '-_,./%#@()*',
            });
            $('.email, .username').alphanum({
                allow: '@.-_',
            });
            $('.address').alphanum({
                allow: '.,/-',
            });
            //input có class number chỉ được nhập số
            $('.number').numeric();
            //input có class string chỉ được nhập chữ
            $('.string').alpha();
        }
    };

    // Handle Bootstrap Toastr && custom Toast Notification plugin
    const handleToastr = function() {
        if (typeof toastr === 'object') {
            let opts = {
                'closeButton': true,
                'debug': false,
                'positionClass': 'toast-top-right',
                'newestOnTop': true,
                'onclick': null,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            };
            $.fn.toast = function(options) {
                if (options.hasOwnProperty('content')) {
                    let content = options.content;
                    if (options.type === 'success') {
                        toastr.success(content, options.title, opts);
                    } else if (options.type === 'error') {
                        toastr.error(content, options.title, opts);
                    } else if (options.type === 'warning') {
                        toastr.warning(content, options.title, opts);
                    }
                } else {
                    let content;
                    if (options.type === 'success') {
                        content = Message.success;
                        toastr.success(content, options.title, opts);
                    } else if (options.type === 'error') {
                        content = Message.fail;
                        toastr.error(content, options.title, opts);
                    } else if (options.type === 'warning') {
                        content = Message.warning;
                        toastr.warning(content, options.title, opts);
                    }
                }
            };
        }
    };

    // Handle BT js && custom bt toolTip plugin
    const handleBt = function() {
        if ($.isFunction($.fn.bt)) {
            $.fn.tooltip = function(options) {
                let btConfig = {
                    trigger: 'none',
                    clickAnywhereToClose: false,
                    positions: ['top'],
                    fill: 'rgba(33, 33, 33, .9)',
                    spikeLength: 10,
                    spikeGirth: 10,
                    cssStyles: {
                        color: '#FFF',
                        fontSize: '11px',
                        textAlign: 'justify',
                        width: 'auto',
                    },
                };
                let message = options !== undefined ? options.message : '';
                $(this).bt(message, btConfig).btOn();
            };
        }
    };

    // Handle Bootstrap Bootbox
    const handleBootbox = function() {
        if (typeof bootbox === 'object') {
            //Bootbox default config
            bootbox.setDefaults({
                locale: lang,
                show: true,
                backdrop: true,
                closeButton: true,
                animate: true,
                className: 'my-modal',
            });
        }
    };

    // Handle BlockUI
    const handleBlockUI = function() {
        if ($.isFunction($.blockUI)) {
            //BlockUI default config
            $.extend(true, $.blockUI.defaults, {
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: 0.5,
                    color: '#fff',
                },
                baseZ: 99999,
            });
        }
    };

    // Handle AJAX Request
    const handleAjax = function() {
        //UnblockUI khi ajax chạy xong
        $(document).ajaxStop(function() {
            Team.unblockUI();
        });
        //Show toast error khi ajax lỗi
        $(document).ajaxError(function(event, request) {
            Team.unblockUI();
            if (request.status === 500) {
                console.log($(request.responseText).text());
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: `${request.status} - ${request.statusText} <br><pre> ${$(request.responseText).
                        text()} </pre>`,
                    place: 'prepend',
                });
            }
        });
    };

    // Handle Datatables
    const handleDatatables = function() {
        if ($.isFunction($.fn.dataTable)) {
            let optionLang = {
                'sLengthMenu': 'Display _MENU_ records per page',
                'sSearch': 'Search:',
                'oPaginate': {
                    'sFirst': 'First',
                    'sPrevious': 'Previous',
                    'sNext': 'Next',
                    'sLast': 'Last',
                },
                'sEmptyTable': 'No data available',
                'sProcessing': 'Loading...',
                'sZeroRecords': 'No matching records found',
                'sInfo': 'Showing _START_ to _END_ of _TOTAL_ entries',
                'sInfoEmpty': 'Showing 0 to 0 of 0 entries',
                'sInfoFiltered': '(filtered from _MAX_ total entries)',
                'sInfoPostFix': '',
                'sUrl': '',
            };
            if (lang === 'vi') {
                optionLang = {
                    'sEmptyTable': 'Không có dữ liệu',
                    'sProcessing': 'Đang xử lý...',
                    'sLengthMenu': 'Xem _MENU_ mục',
                    'sZeroRecords': 'Không tìm thấy dòng nào phù hợp',
                    'sInfo': 'Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục',
                    'sInfoEmpty': 'Đang xem 0 đến 0 trong tổng số 0 mục',
                    'sInfoFiltered': '(được lọc từ _MAX_ mục)',
                    'sInfoPostFix': '',
                    'sSearch': 'Tìm:',
                    'sUrl': '',
                    'oPaginate': {
                        'sFirst': 'Đầu',
                        'sPrevious': 'Trước',
                        'sNext': 'Tiếp',
                        'sLast': 'Cuối',
                    },
                };
            }
            //Datatable Pipleline
            $.fn.dataTable.pipeline = function(opts) {
                // Configuration options
                const conf = $.extend({
                    pages: 5, // number of pages to cache
                    url: '', // script url
                    data: null, // function or object with parameters to send to the server
                    // matching how `ajax.data` works in DataTables
                    method: 'POST' // Ajax HTTP method
                }, opts);
                // Private variables for storing the cache
                let cacheLower = -1;
                let cacheUpper = null;
                let cacheLastRequest = null;
                let cacheLastJson = null;
                return function(request, drawCallback, settings) {
                    let ajax = false;
                    let requestStart = request.start;
                    const drawStart = request.start;
                    const requestLength = request.length;
                    const requestEnd = requestStart + requestLength;
                    if (settings.clearCache) {
                        // API requested that the cache be cleared
                        ajax = true;
                        settings.clearCache = false;
                    } else if (cacheLower < 0 || requestStart < cacheLower ||
                        requestEnd > cacheUpper) {
                        // outside cached data - need to make a request
                        ajax = true;
                    } else if (JSON.stringify(request.order) !== JSON.stringify(cacheLastRequest.order) ||
                        JSON.stringify(request.columns) !== JSON.stringify(cacheLastRequest.columns) ||
                        JSON.stringify(request.search) !== JSON.stringify(cacheLastRequest.search)
                    ) {
                        // properties changed (ordering, columns, searching)
                        ajax = true;
                    }
                    // Store the request for checking next time around
                    cacheLastRequest = $.extend(true, {}, request);
                    if (ajax) {
                        // Need data from the server
                        if (requestStart < cacheLower) {
                            requestStart = requestStart -
                                (requestLength * (conf.pages - 1));
                            if (requestStart < 0) {
                                requestStart = 0;
                            }
                        }
                        cacheLower = requestStart;
                        cacheUpper = requestStart + (requestLength * conf.pages);
                        request.start = requestStart;
                        request.length = requestLength * conf.pages;
                        // Provide the same `data` options as DataTables.
                        if ($.isFunction(conf.data)) {
                            // As a function it is executed with the data object as an arg
                            // for manipulation. If an object is returned, it is used as the
                            // data object to submit
                            const d = conf.data(request);
                            if (d) {
                                $.extend(request, d);
                            }
                        } else if ($.isPlainObject(conf.data)) {
                            // As an object, the data given extends the default
                            $.extend(request, conf.data);
                        }
                        settings.jqXHR = $.ajax({
                            'type': conf.method,
                            'url': conf.url,
                            'data': request,
                            'dataType': 'json',
                            'cache': false,
                            'success': function(json) {
                                cacheLastJson = $.extend(true, {}, json);
                                if (cacheLower !== drawStart) {
                                    json.data.splice(0, drawStart - cacheLower);
                                }
                                json.data.splice(requestLength, json.data.length);
                                drawCallback(json);
                            },
                        });
                    } else {
                        let json = $.extend(true, {}, cacheLastJson);
                        json.draw = request.draw; // Update the echo for each response
                        json.data.splice(0, requestStart - cacheLower);
                        json.data.splice(requestLength, json.data.length);
                        drawCallback(json);
                    }
                };
            };
            //Datatable clear Pipleline
            $.fn.dataTable.Api.register('clearPipeline()', function() {
                Team.blockUI();
                return this.iterator('table', function(settings) {
                    settings.clearCache = true;
                });
            });
            //Datatable default config
            $.extend(true, $.fn.dataTable.defaults, {
                'oLanguage': optionLang,
                'info': false,
                'lengthChange': false,
                'searching': false,
                'columnDefs': [
                    {
                        'targets': [-1],
                        'searchable': false,
                        'orderable': false,
                        'visible': true,
                    },
                    // {className: "text-center", "targets": '_all'}
                ],
                'order': [],
                'iDisplayLength': 10,
                'autoWidth': false, // disable fixed width and enable fluid table
                'processing': false // enable/disable display message box on record load
                // "aLengthMenu": [
                //     [10, 15, 20, 50, -1],
                //     [10, 15, 20, 50, 'all']
                // ],
            });
        }
    };

    // Handle Input
    const handleInput = function() {
        //event cho nút check all & single ở table
        $(document).on('click', '.cb-all', function() {
            let cbSingle = $('.cb-single');
            let tr = cbSingle.parents('tr');
            if (!$(this).is(':checked')) {
                cbSingle.prop('checked', '');
                tr.removeClass('warning');
            } else {
                cbSingle.prop('checked', 'checked');
                tr.addClass('warning');
            }
        });
        //event cho nút check từng dòng ở table
        $(document).on('click', '.cb-single', function() {
            let cbSingle = $('.cb-single');
            let tr = $(this).parents('tr');
            let cbAll = $('.cb-all');
            if ($(this).is(':checked')) {
                tr.addClass('warning');
                if (cbSingle.length === $('.cb-single:checked').length) {
                    cbAll.prop('checked', 'checked');
                } else {
                    cbAll.prop('checked', '');
                }
            } else {
                tr.removeClass('warning');
                cbAll.prop('checked', '');
            }
        });
        //event change cho input co class can validate
        $(document).on('change', '.email, .require, .password', function() {
            //nếu không có class no-validate thì validate input
            if (!$(this).hasClass('no-validate')) {
                let result = Team.validateElement($(this));
                Team.addValidateTooltip($(this), result.hasError, result.message);
            }
        });
        //Set select text cho thẻ input focus
        $('input, textarea').focus(function() {
            $(this).select();
        });
    };

    return {
        /**
         * Hàm khởi tạo cấu hình plugin
         */
        init() {
            handleModals();
            handleSelect2();
            handleDatepicker();
            handleTimepicker();
            handleDatetimepicker();
            handleAlphanum();
            handleToastr();
            handleBt();
            handleBootbox();
            handleBlockUI();
            handleAjax();
            handleInput();
            handleDatatables();
        },
        /**
         * BlockUI
         * @param options
         */
        blockUI(options) {
            options = $.extend(true, {}, options);
            let message = options.message === undefined ? Message.blockUI : options.message;

            if (options.target) { // element blocking
                const el = $(options.target);
                if (el.height() <= ($(window).height())) {
                    options.cenrerY = true;
                }
                el.block({
                    message: `<i class="fa fa-spinner fa-spin"></i> ${message}`,
                    centerY: options.cenrerY !== undefined ? options.cenrerY : false,
                    css: {
                        top: '10%',
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none',
                    },
                });
            } else { // page blocking
                $.blockUI({
                    message: `<i class="fa fa-spinner fa-spin"></i> ${message}`,
                });
            }
        },
        /**
         * Unblick UI
         * @param target
         */
        unblockUI(target) {
            if (target) {
                $(target).unblock({
                    onUnblock() {
                        $(target).css('position', '');
                        $(target).css('zoom', '');
                    },
                });
            } else {
                $.unblockUI();
            }
        },

        /**
         * Hiện modal với content load ajax
         * @param params: object
         * @param url: string
         * @param modal: mặc định là $("#modal_md")
         * @returns {*}
         */
        showModal(params, url, modal) {
            if (modal === undefined) {
                modal = $("#modal_md");
            }
            Team.blockUI();
            return $.ajax({
                url: url,
                data: params,
                type: 'GET',
                success: result => {
                    modal.find('.modal-content').html(result);
                    modal.modal({
                        backdrop: 'static'   // This disable for click outside event
                        //keyboard: true        // This for keyboard event
                    });
                },
            });
        },

        /**
         * Tạo mảng giá trị từ nhiều input cùng class
         * @param element: tên class
         * @param data (optional): lấy value từ data-
         * @param parse (optional): parse dữ liệu (int hoặc float)
         * @returns {*}
         */
        getValues(element, data, parse) {
            if (data !== undefined) {
                if (parse !== undefined) {
                    if (parse === 'int') {
                        return _.map($('.' + element), (elem) => {
                            return parseInt($(elem).attr(`data-${data}`));
                        });
                    } else if (parse === 'float') {
                        return _.map($('.' + element), (elem) => {
                            return parseFloat($(elem).attr(`data-${data}`));
                        });
                    }
                } else {
                    return _.map($('.' + element), (elem) => {
                        return $(elem).attr(`data-${data}`);
                    });
                }
            }
            if (parse !== undefined) {
                if (parse === 'int') {
                    return _.map($('.' + element), (elem) => {
                        return parseInt($(elem).val());
                    });
                } else if (parse === 'float') {
                    return _.map($('.' + element), (elem) => {
                        return parseFloat($(elem).val());
                    });
                }
            }

            return _.map($('.' + element), (elem) => {
                return $(elem).val();
            });
        },

        //FORM UTIL

        /**
         * Hiện bảng lỗi tổng hợp form
         * @param result
         */
        showErrorSummary(result) {
            let title = Message.errorSummary;
            let summary = 'Error';
            try {
                summary = `<ul>`;
                if (typeof result === 'string') {
                    summary += `<li> ${result} </li>`;
                } else {
                    for (let property in result) {
                        if (result.hasOwnProperty(property)) {
                            summary += `<li> ${result[property]} </li>`;
                        }
                    }
                }
                summary += `</ul>`;
            } catch (e) {
                summary = 'Error';
            } finally {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: `<strong>${title}</strong> ${summary}`,
                    place: 'prepend',
                });
                App.scrollTop();
            }
        },
        /**
         * Gắn tooltip vào element
         * @param element
         * @param hasError
         * @param message
         * @returns {boolean}
         */
        addValidateTooltip(element, hasError, message) {
            if (hasError) {
                if (element.is('select')) {
                    element.select2('open');
                    element.next().find('.select2-selection').tooltip({message: message});
                    element.parents('.form-group').removeClass('has-success').addClass('has-error');
                } else {
                    element.tooltip({message: message});
                    element.parents('.form-group').removeClass('has-success').addClass('has-error');
                }
                return false;
            } else {
                if (element.is('select')) {
                    element.next().find('.select2-selection').btOff();
                    element.parents('.form-group').removeClass('has-error').addClass('has-success');
                } else {
                    element.parents('.form-group').removeClass('has-error').addClass('has-success');
                    element.btOff();
                }
            }
        },
        /**
         * Validate từnng element
         * @param element
         * @param isSingle
         * @returns {{message: string, hasError: boolean}}
         */
        validateElement(element, isSingle) {
            let message = '', hasError = false;
            let eleVal = $.trim(element.val());
            if (element.hasClass('no-validate')) {
                return {message: message, hasError: hasError};
            }
            if (element.hasClass('require')) {
                if (eleVal === '' || eleVal === null) {
                    message = Message.validateInput;
                    if (element.is('select')) {
                        message = Message.validateSelect;
                    }
                    hasError = true;
                }
            }
            if (element.hasClass('email')) {
                if (eleVal !== '' && eleVal !== null) {
                    if (eleVal.match(
                            /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/) ===
                        null) {
                        message = Message.validateEmail;
                        hasError = true;
                    }
                }
            }
            if (element.hasClass('password') && eleVal.length > 0) {
                //Regular Expressions.
                let regex = [];
                regex.push('[A-Z]'); //Uppercase Alphabet.
                regex.push('[a-z]'); //Lowercase Alphabet.
                regex.push('[0-9]'); //Digit.
                regex.push('[!@#$%^&*()_+=?></.,`~]'); //Special Character.
                let passed = 0;
                //Validate for each Regular Expression.
                for (let i = 0; i < regex.length; i++) {
                    if (new RegExp(regex[i]).test(eleVal)) {
                        passed++;
                    }
                }
                //Validate for length of Password.
                if (passed > 2 && eleVal.length > 8) {
                    passed++;
                }
                if (passed < 2) {
                    message = Message.validatePassword;
                    hasError = true;
                }
            }
            //Nếu không phải là validate input lẻ thì return object, ngược lại add tooltip
            if (isSingle === undefined) {
                return {message: message, hasError: hasError};
            } else {
                this.addValidateTooltip(element, hasError, message);
            }
        },
        /**
         * Validate toàn bộ element nằm trong containerId
         * @param containerId: id của element, không cần #
         * @returns {boolean}
         */
        validate(containerId) {
            let self = this;
            $('#' + containerId).find(`.form-control`).each(function() {
                let result = self.validateElement($(this));
                let {hasError, message} = result;
                self.addValidateTooltip($(this), hasError, message);
            });
            return $(`.has-error`).length === 0;
        },
        /**
         * Action cho tung row trong trang index
         * @param self
         * @param message: nội dung thông báo
         * @param table: table muốn thao tác
         * @param cssClass: class cho từng row được chọn, mặc định là danger
         * @param size: kích thước bootbox, mặc định là small
         * @param params
         */
        action(self, message, table, params, cssClass = 'danger', size = 'small') {
            let id = self.data('id');
            if (params === undefined) {
                params = {id: id};
                self.parents('tr').addClass(cssClass);
                bootbox.confirm({
                    size: size,
                    message: message,
                    callback: function(result) {
                        if (result) {
                            let url = self.data('url');
                            $.post(url, params, function(result) {
                                if (result === 'success') {
                                    $('body').toast({type: 'success'});
                                    table.clearPipeline().draw(false);
                                    $('.cb-all').prop('checked', false);
                                } else {
                                    $('body').toast({type: 'error'});
                                }
                            });
                        } else {
                            self.parents('tr').removeClass(cssClass);
                        }
                    },
                });
            } else {
                $('.cb-single:checked').each(function() {
                    $(this).parents('tr').addClass(cssClass);
                });
                if (id !== undefined) {
                    params.id = id;
                }
                bootbox.confirm({
                    size: size,
                    message: message,
                    callback: function(result) {
                        if (result) {
                            let url = self.data('url');
                            $.post(url, params, function(result) {
                                if (result === 'success') {
                                    $('body').toast({type: 'success'});
                                    table.clearPipeline().draw(false);
                                    $('.cb-all').prop('checked', false);
                                } else {
                                    $('body').toast({type: 'error'});
                                }
                            });
                        } else {
                            self.parents('tr').removeClass(cssClass);
                        }
                        // $('.cb-single:checked').each(function() {
                        //     $(this).parents('tr').removeClass(cssClass);
                        // });
                    },
                });
            }
        },
        /**
         * Lưu form sử dụng Form data
         * @param url
         * @param formData
         * @returns {*}
         */
        submitForm(url, formData) {
            Team.blockUI();
            return $.ajax(
                {
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                }
            )
        },
    };
})(jQuery);

(function() {
    Team.init();
})();