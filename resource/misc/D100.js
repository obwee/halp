/**
 * D100
 * Script for D-Bill Statistics
 * @author Aries V. Macandili <aries@simplexi.com.ph>
 * @since 2020.02.10
 * @version 1.0
 */

/**
 * D100
 * Revealing module for D100 template.
 */
var D100 = (() => {

    let sFunctionApi  = '/function.htm?template=D100&action=';

    let aTypes = [
        '청구',    // charge
        '매입',    // purchase
        '미송',    // unreceived
        '미송입고', // receive
        '반품예정', // return
        '반품'     // refund
    ];

    let oFromDate     = {};
    let oToDate       = {};
    let oTypes        = {};
    let oSearchForm   = {};
    let oTypeAll      = {};

    let oProducts     = {};
    let oInputFilters = {};

    /**
     * init
     * PRODUCT_SEARCH constructor.
     */
    function init() {
        setElements();
        setEvents();
        prepareDatePicker();
        checkQueryParamsForType();
    }

    /**
     * setElements
     * Prepare HTML elements.
     */
    function setElements() {
        oFromDate    = $('#fromDate');
        oToDate      = $('#toDate');
        oTypes       = $('.type-cbox');
        oSearchForm  = $('#searchForm');
        oTypeAll     = $('#typeAll');
    }

    /**
     * prepareDatePicker
     * Initialize custom date picker.
     */
    function prepareDatePicker() {
        createDatePicker('#fromDateDiv');
        createDatePicker('#toDateDiv');

        $('#fromDate, #toDate').val(formatDateToday(new Date));
    }

    /**
     * checkQueryParamsForType
     * Check query parameters for d_type before fetching products.
     */
    function checkQueryParamsForType() {
        let searchParams = new URLSearchParams(window.location.search);

        if (searchParams.has('type') === true) {
            let iType = searchParams.get('type');
            $(`.type-cbox[value=${aTypes[iType]}]`).attr('checked', 'true');

            fetchProducts({
                d_type : [iType]
            });
        } else {
            fetchProducts();
        }
    }

    /**
     * formatDateToday
     * Format the date today into yyyy.mm.dd
     * @param {object} oDate
     * @return {string}
     */
    function formatDateToday(oDate) {
        let sYear = oDate.getFullYear().toString();
        let sMonth = (oDate.getMonth() + 1).toString();
        let sDay = oDate.getDate().toString();

        if (sMonth.length < 2) {
            sMonth = "0" + sMonth;
        }
        if (sDay.length < 2) {
            sDay = "0" + sDay;
        }

        return [
            sYear,
            sMonth,
            sDay
        ].join('.');
    }

    /**
     * setEvents
     * Set DOM events.
     */
    function setEvents() {

        $(document).on('click', 'body', (oEvent) => {
            if (oEvent.target.id !== 'fromDateDiv' && oEvent.target.id !== 'toDateDiv' && (oEvent.target.className.includes('dt') === false)) {
                $('.dt').hide();
            }
        });

        $(document).on('click', '.dtd', function () {
            let sDatePickerId = $(this)
                .closest('.dt')
                .prev('div')
                .attr('id');

            let sDateInputId = '#' + sDatePickerId.replace('Div', '');
            $(sDateInputId).val($('#' + sDatePickerId).text());
        });

        $(document).on('click', '#fromDateDiv, #toDateDiv', () => {
            changeDateBorderColor('#ced4da');
        });

        oTypeAll.on('change', function() {
            oTypes.not(this).prop('checked', this.checked);
        });

        oTypes.on('click', function () {
            if (this.checked !== true) {
                if (oTypeAll.is(':checked') === true) {
                    oTypeAll.prop('checked', false)
                }
            } else {
                if (oTypes.not(':checked').length === 0) {
                    oTypeAll.prop('checked', true)
                }
            }
        });

        oSearchForm.on('submit', (oEvent) => {
            oEvent.preventDefault();
            changeDateBorderColor('#ced4da');

            if (isValidDate() === false) {
                changeDateBorderColor('#F1547F');
                return;
            }

            fetchProducts(extractFormData());
        });

        $(document).on('click', '.productDetail', function () {
            let iProductId = $(this).attr('id');
            let sSupplierName = '';

            Object.values(oProducts).forEach((oEntry) => {
                if (oEntry.product_id === iProductId) {
                    sSupplierName = oEntry.name;
                }
            });

            fetchProductDetails(iProductId, sSupplierName);

            $('#productDetailsModal').modal('show');
        });
    }

    /**
     * changeDateBorderColor
     * Change the border color of the date input.
     * @param {string} sColor
     */
    function changeDateBorderColor(sColor) {
        $('#fromDate, #toDate').css(
            {
                'border'       : `1px solid ${sColor}`,
                'border-right' : 'none'
            }
        );
        $('.icon-rounded').attr('style', `border: 1px solid ${sColor} !important; border-left: none;`);
    }

    /**
     * extractFormData
     * Extract the input filters by the user for product searching.
     * @return {object}
     */
    function extractFormData() {
        let oInputs = {
            d_type    : [],
            colorname : '',
            sizename  : ''
        } ;

        $.each(oSearchForm.serializeArray(), (iIndex, oField) => {
            if (oField.name === 'type') {
                if (aTypes.indexOf(oField.value) !== -1) {
                    oInputs.d_type.push(aTypes.indexOf(oField.value));
                }
            }
            if (oField.name === 'optionName') {
                [oInputs['colorname'], oInputs['sizename']] = oField.value.split('-');
            }
            oInputs[oField.name] = oField.value;
        });

        oInputs = removeBlankAttributes(oInputs);
        delete oInputs.type;
        delete oInputs.optionName;

        return oInputs;
    }

    /**
     * removeBlankAttributes
     * Delete blank object attributes inside the form data.
     * @param {object} oFormData
     * @return {object}
     */
    function removeBlankAttributes(oFormData) {
        Object.keys(oFormData).forEach((sKey) => {
            (oFormData[sKey] === '' || oFormData[sKey] === undefined || oFormData[sKey].length === 0) && delete oFormData[sKey]
        });
        return oFormData;
    }

    /**
     * isValidDate
     * Check if date filter is valid.
     * @return {boolean}
     */
    function isValidDate() {
        let iFromDate = Date.parse(oFromDate.val());
        let iToDate = Date.parse(oToDate.val());

        if ([iFromDate, iToDate].every(isNaN)) {
            return true;
        }
        return (iToDate >= iFromDate);
    }

    /**
     * fetchProducts
     * Fetch the products from the database.
     * @param {object} oFormData
     */
    function fetchProducts(oFormData = {}) {
        oInputFilters = oFormData;
        let aColumns = [
            {
                title: '공급처', data: 'name'
            },
            {
                title: 'D-상품명', data: 'itemname'
            },
            {
                title: 'D-옵션', render: (aData, oType, oRow) =>
                    oRow.colorname + '-' + oRow.sizename
            },
            {
                title: '청구', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('0')) ? oRow.d_types[0]: ''
            },
            {
                title: '미송', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('2')) ? oRow.d_types[2]: ''
            },
            {
                title: '미송입고', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('3')) ? oRow.d_types[3]: ''
            },
            {
                title: '반품예정', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('4')) ? oRow.d_types[4]: ''
            },
            {
                title: '반품', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('5')) ? oRow.d_types[5]: ''
            },
            {
                title: '매입', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('1')) ? oRow.d_types[1] : ''
            },
            {
                title: '거래금액', className: 'sum', data: 'totalAmount'
            },
            {
                title: '상제보기', render: (aData, oType, oRow, oMeta) =>
                    '<button class="btn btn-rounded btn-sm btn-default details productDetail" id="' + oRow.product_id + '" style="font-weight: 900 !important;">상세</button>'
            }
        ];

        let oData = {
            url      : `${sFunctionApi}fetchProducts`,
            type     : ($.isEmptyObject(oFormData) === false) ? 'POST' : 'GET',
            data     : {oFormData : oFormData},
            dataType : 'JSON',
            dataSrc  : function(oJson) {
                if (oJson.bResult === false) {
                    changeDateBorderColor('#F1547F');
                    return oProducts;
                }
                oProducts = oJson.oProducts;
                return oProducts;
            },
            async    : false
        };

        let oPagination = () => {
            renderPagination('#productsTable_paginate', '#productsTable_paginate_wrapper');
        };

        loadTable(oData, '#productsTable', 4, aColumns, oPagination);
    }

    /**
     * fetchProductDetails
     * Fetch product details from the database to be displayed inside the modal.
     * @param {int} iProductId
     * @param {string} sSupplierName
     */
    function fetchProductDetails(iProductId, sSupplierName) {
        let oTypes = {};
        oTypes.d_type = oInputFilters.d_type;

        let aColumns = [
            {
                title: '등록일', data: 'crdate'
            },
            {
                title: '영수증', data: 'barcode'
            },
            {
                title: '청구', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('0')) ? oRow.d_types[0]: ''
            },
            {
                title: '미송', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('2')) ? oRow.d_types[2]: ''
            },
            {
                title: '미송입고', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('3')) ? oRow.d_types[3]: ''
            },
            {
                title: '반품예정', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('4')) ? oRow.d_types[4]: ''
            },
            {
                title: '반품', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('5')) ? oRow.d_types[5]: ''
            },
            {
                title: '매입', className: 'sum', render: (aData, oType, oRow) =>
                    (oRow.d_types.hasOwnProperty('1')) ? oRow.d_types[1] : ''
            },
            {
                title: '거래금액', className: 'sum', data: 'totalAmount'
            }
        ];

        let oData = {
            url      : `${sFunctionApi}fetchProductDetails`,
            type     : 'POST',
            data     : {
                iProductId    : iProductId,
                oInputFilters : oTypes
            },
            dataType : 'JSON',
            dataSrc  : function(oJson) {
                $('#selectedSupplierName').val(sSupplierName);
                $('#rows-found-history').text(oJson.length);
                return oJson;
            },
            async    : false
        };

        let oPagination = () => {
            renderPagination('#detailsTable_paginate', '#detailsTable_paginate_wrapper');
        };

        loadTable(oData, '#detailsTable', 3, aColumns, oPagination);
    }

    /**
     * loadTable
     * Render datatable together with the data received from the AJAX request.
     * @param {array} aData
     * @param {string} sTableName
     * @param {int} iPageLength
     * @param {array} aColumns
     * @param {function} oPagination
     */
    function loadTable(aData, sTableName, iPageLength, aColumns, oPagination = () => {}) {
        $(`${sTableName} > tbody`).empty().parent().dataTable({
            destroy      : true,
            deferRender  : true,
            ajax         : aData,
            language     : {
                paginate : {
                    next     : '',
                    previous : '',
                    first    : '',
                    last     : ''
                }
            },
            responsive   : true,
            pagingType   : 'full_numbers',
            pageLength   : iPageLength,
            ordering     : false,
            searching    : false,
            lengthChange : false,
            info         : false,
            columns      : aColumns,
            columnDefs : [
                { sortable : false, targets : '_all' }
            ],
            footerCallback: function () {
                let oApi = this.api();

                // Remove the formatting to get integer data for summation.
                let intVal = (mValue) => {
                    return typeof mValue === 'string' ?
                        mValue.replace(/[,]/g, '') * 1 :
                            typeof mValue === 'number' ?
                            mValue : 0;
                };

                // Get the sum of all the columns with a class named 'sum'.
                oApi.columns('.sum', {page: 'current'}).every(function() {
                    let iSum = oApi
                        .cells(null, this.index(), {page: 'current'})
                        .render('display')
                        .reduce((iAccumulator, iCurrentValue) => {
                            return intVal(iAccumulator) + intVal(iCurrentValue);
                        }, 0);
                    $(this.footer()).text(iSum.toLocaleString());
                });
            },
            drawCallback: () => {
                oPagination();
                $('#rows-found').text(oProducts.length);
            }
        });
    }

    /**
     * renderPagination
     * Create custom pagination.
     * @param {string} sOriginId
     * @param {string} sTargetId
     */
    function renderPagination(sOriginId, sTargetId) {
        $(sOriginId).hide();
        let mCopy = $(sOriginId).clone(true);
        $(sTargetId)
            .empty()
            .append(mCopy)
            .children(0).show()
    }

    /**
     * Reveal public pointers.
     */
    return {
        initialize : init
    }

})();

/**
 * ready()
 * jQuery method that checks if DOM has been loaded.
 */
$(() => {
    D100.initialize();
});