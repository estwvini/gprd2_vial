/**
 * Datatables
 **/
(function ($, DataTable) {
    $.extend(true, DataTable.defaults, {
        dom: '<lf<t>ipr>',
        bProcessing: true,
        bServerSide: true,
        bAutoWidth: false,
        responsive: true,
        oLanguage: {
            "sProcessing": "<i class='fa fa-spinner fa-spin'></i>",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning&#250;n dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<i class='fa fa-spinner fa-spin'></i>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "&#218;ltimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
})(jQuery, jQuery.fn.DataTable);

function build_datatable($table, $config, onEnabledSwitchChange) {
    $.fn.dataTable.ext.errMode = 'none';
    showLoading();

    return $table
        .DataTable($config)
        .on('draw.dt', function () {

            /** initialize actions tooltip */
            init_tooltip($table);

            /** switches for enabled/disabled entities */
            init_switchery($table);
            $table.find('.js-switch-enabled').on('click', onEnabledSwitchChange);

            /** checks for bulk actions */
            var $checks = $("input.bulk", $table);
            if ($checks[0]) {
                $checks.iCheck({
                    checkboxClass: 'icheckbox_flat-green'
                });

                var $checksOne = $('input.check-one', $table);
                var $checksAll = $('input.check-all', $table);

                if ($("input[class*='check-one']:checked", $table).length === $checksOne.length) {
                    $checksAll.prop('checked', true);
                    $checksAll.iCheck('update');
                }

                $checks.on('ifChecked', function () {
                    var $this = $(this);

                    if ($this.hasClass('check-all'))
                        $("input[name='table_records']", $table).iCheck('check');

                    else if ($this.hasClass('check-one')) {
                        $this.closest('tr').addClass('selected');

                        if ($("input[class*='check-one']:checked", $table).length === $checksOne.length) {
                            $checksAll.prop('checked', true);
                            $checksAll.iCheck('update');
                        }
                    }

                    _options();
                });

                $checks.on('ifUnchecked', function () {
                    var $this = $(this);

                    if ($this.hasClass('check-all'))
                        $("input[name='table_records']", $table).iCheck('uncheck');

                    else if ($this.hasClass('check-one')) {
                        $this.closest('tr').removeClass('selected');

                        if ($("input[class*='check-one']:checked", $table).length !== $checksOne.length) {
                            $checksAll.prop('checked', false);
                            $checksAll.iCheck('update');
                        }
                    }

                    _options();
                });

                _options();

                function _options() {
                    var $wrapper = $('.dataTables_wrapper');
                    var $length = $('.dataTables_length', $wrapper);
                    var $filter = $('.dataTables_filter', $wrapper);

                    var $bulk = $('#bulk-actions');
                    var $info = $("[data-toggle='tooltip']", $bulk);

                    var count = $("input[name='table_records']:checked", $table).length;

                    if (count) {
                        $length.hide();
                        $filter.hide();
                        $bulk.show();
                        $(".action-cnt").html(count + " Elementos seleccionados");
                        $bulk.find('a.btn-success').attr('data-original-title', 'Habilitar/Inhabilitar elementos seleccionados');
                        $bulk.find('a.btn-danger').attr('data-original-title', 'Eliminar elementos seleccionados');

                    } else {
                        $bulk.hide();
                        $filter.show();
                        $length.show();
                        $info.attr('data-original-title', '');
                    }
                }
            }
            hideLoading();
        });
}

// XML Custom Stylesheet for Excel
$customExcelStyle = '<?xml version="1.0" encoding="UTF-8"?>' +
    '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" ' +
    '    xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" ' +
    '    xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac">' +
    '    <numFmts count="6">' +
    '        <numFmt numFmtId="164" formatCode="#,##0.00_-\\ [$$-45C]"/>' +
    '        <numFmt numFmtId="165" formatCode="&quot;£&quot;#,##0.00"/>' +
    '        <numFmt numFmtId="166" formatCode="[$€-2]\\ #,##0.00"/>' +
    '        <numFmt numFmtId="167" formatCode="0.00%"/>' +
    '        <numFmt numFmtId="168" formatCode="#,##0;(#,##0)"/>' +
    '        <numFmt numFmtId="169" formatCode="#,##0.00;(#,##0.00)"/>' +
    '    </numFmts>' +
    '    <fonts count="8" x14ac:knownFonts="1">' +
    '        <font>' +
    '            <sz val="12" />' +
    '            <name val="Calibri" />' +
    '        </font>' +
    '        <font>' +
    '            <sz val="11" />' +
    '            <name val="Calibri" />' +
    '            <color rgb="FFFEFEFE" />' +
    '        </font>' +
    '        <font>' +
    '            <sz val="11" />' +
    '            <name val="Calibri" />' +
    '            <b />' +
    '        </font>' +
    '        <font>' +
    '            <sz val="11" />' +
    '            <name val="Calibri" />' +
    '            <i />' +
    '        </font>' +
    '        <font>' +
    '            <sz val="11" />' +
    '            <name val="Calibri" />' +
    '            <u />' +
    '        </font>' +
    '        <font>' +
    '            <sz val="20" />' +
    '            <name val="Calibri" />' +
    '            <color rgb="FFFEFEFE" />' +
    '            <b />' +
    '        </font>' +
    '        <font>' +
    '            <sz val="18" />' +
    '            <name val="Calibri" />' +
    '            <color rgb="FFFEFEFE" />' +
    '            <b />' +
    '        </font>' +
    '        <font>' +
    '            <sz val="14" />' +
    '            <name val="Calibri" />' +
    '            <color rgb="FFFEFEFE" />' +
    '            <b />' +
    '        </font>' +
    '    </fonts>' +
    '    <fills count="6">' +
    '        <fill>' +
    '            <patternFill patternType="none" />' +
    '        </fill>' +
    '        <fill> // Excel appears to use this as a dotted background regardless of values but' +
    '            <patternFill patternType="none" />' +
    ' // to be valid to the schema, use a patternFill' +
    '        </fill>' +
    '        <fill>' +
    '            <patternFill patternType="solid">' +
    '                <fgColor rgb="FFD9D9D9" />' +
    '                <bgColor indexed="64" />' +
    '            </patternFill>' +
    '        </fill>' +
    '        <fill>' +
    '            <patternFill patternType="solid">' +
    '                <fgColor rgb="FFD99795" />' +
    '                <bgColor indexed="64" />' +
    '            </patternFill>' +
    '        </fill>' +
    '        <fill>' +
    '            <patternFill patternType="solid">' +
    '                <fgColor rgb="FF1ABB9C" />' +
    '                <bgColor indexed="64" />' +
    '            </patternFill>' +
    '        </fill>' +
    '        <fill>' +
    '            <patternFill patternType="solid">' +
    '                <fgColor rgb="ffc6cfef" />' +
    '                <bgColor indexed="64" />' +
    '            </patternFill>' +
    '        </fill>' +
    '    </fills>' +
    '    <borders count="3">' +
    '        <border>' +
    '            <left />' +
    '            <right />' +
    '            <top />' +
    '            <bottom />' +
    '            <diagonal />' +
    '        </border>' +
    '        <border diagonalUp="false" diagonalDown="false">' +
    '            <left style="thin">' +
    '                <color auto="1" />' +
    '            </left>' +
    '            <right style="thin">' +
    '                <color auto="1" />' +
    '            </right>' +
    '            <top style="thin">' +
    '                <color auto="1" />' +
    '            </top>' +
    '            <bottom style="thin">' +
    '                <color auto="1" />' +
    '            </bottom>' +
    '            <diagonal />' +
    '        </border>' +
    '        <border diagonalUp="false" diagonalDown="false">' +
    '            <left style="thin">' +
    '                <color auto="1" />' +
    '            </left>' +
    '            <right style="thin">' +
    '                <color auto="1" />' +
    '            </right>' +
    '            <top style="thin">' +
    '                <color auto="1" />' +
    '            </top>' +
    '            <bottom style="thick">' +
    '                <color auto="1" />' +
    '            </bottom>' +
    '            <diagonal />' +
    '        </border>' +
    '    </borders>' +
    '    <cellStyleXfs count="1">' +
    '        <xf numFmtId="0" fontId="0" fillId="0" borderId="0" />' +
    '    </cellStyleXfs>' +
    '    <cellXfs count="79">' +
    '        <xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 0
    '        <xf numFmtId="0" fontId="1" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 1
    '        <xf numFmtId="0" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 2
    '        <xf numFmtId="0" fontId="3" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 3
    '        <xf numFmtId="0" fontId="4" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 4
    '        <xf numFmtId="0" fontId="0" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 5
    '        <xf numFmtId="0" fontId="1" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 6
    '        <xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 7
    '        <xf numFmtId="0" fontId="3" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 8
    '        <xf numFmtId="0" fontId="4" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 9
    '        <xf numFmtId="0" fontId="0" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 10
    '        <xf numFmtId="0" fontId="1" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 11
    '        <xf numFmtId="0" fontId="2" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 12
    '        <xf numFmtId="0" fontId="3" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 13
    '        <xf numFmtId="0" fontId="4" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 14
    '        <xf numFmtId="0" fontId="0" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 15
    '        <xf numFmtId="0" fontId="1" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 16
    '        <xf numFmtId="0" fontId="2" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 17
    '        <xf numFmtId="0" fontId="3" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 18
    '        <xf numFmtId="0" fontId="4" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 19
    '        <xf numFmtId="0" fontId="0" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 20
    '        <xf numFmtId="0" fontId="1" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 21
    '        <xf numFmtId="0" fontId="2" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 22
    '        <xf numFmtId="0" fontId="3" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 23
    '        <xf numFmtId="0" fontId="4" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 24
    '        <xf numFmtId="0" fontId="0" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 25
    '        <xf numFmtId="0" fontId="1" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 26
    '        <xf numFmtId="0" fontId="2" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 27
    '        <xf numFmtId="0" fontId="3" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 28
    '        <xf numFmtId="0" fontId="4" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 29
    '        <xf numFmtId="0" fontId="0" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 30
    '        <xf numFmtId="0" fontId="1" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 31
    '        <xf numFmtId="0" fontId="2" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 32
    '        <xf numFmtId="0" fontId="3" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 33
    '        <xf numFmtId="0" fontId="4" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 34
    '        <xf numFmtId="0" fontId="0" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 35
    '        <xf numFmtId="0" fontId="1" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 36
    '        <xf numFmtId="0" fontId="2" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 37
    '        <xf numFmtId="0" fontId="3" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 38
    '        <xf numFmtId="0" fontId="4" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 39
    '        <xf numFmtId="0" fontId="0" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 40
    '        <xf numFmtId="0" fontId="1" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 41
    '        <xf numFmtId="0" fontId="2" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 42
    '        <xf numFmtId="0" fontId="3" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 43
    '        <xf numFmtId="0" fontId="4" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 44
    '        <xf numFmtId="0" fontId="0" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 45
    '        <xf numFmtId="0" fontId="1" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 46
    '        <xf numFmtId="0" fontId="2" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 47
    '        <xf numFmtId="0" fontId="3" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 48
    '        <xf numFmtId="0" fontId="4" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/>' +       // s: 49
    '        <xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +    // s: 50
    '            <alignment horizontal="left"/>' +
    '        </xf>' +
    '        <xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +    // s: 51
    '            <alignment horizontal="center"/>' +
    '        </xf>' +
    '        <xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +    // s: 52
    '            <alignment horizontal="right"/>' +
    '        </xf>' +
    '        <xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +    // s: 53
    '            <alignment horizontal="fill"/>' +
    '        </xf>' +
    '        <xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +    // s: 54
    '            <alignment textRotation="90"/>' +
    '        </xf>' +
    '        <xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +    // s: 55
    '            <alignment wrapText="1"/>' +
    '        </xf>' +
    '        <xf numFmtId="9" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +    // s: 56
    '        <xf numFmtId="164" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +  // s: 57
    '        <xf numFmtId="165" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +  // s: 58
    '        <xf numFmtId="166" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +  // s: 59
    '        <xf numFmtId="167" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +  // s: 60
    '        <xf numFmtId="168" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +  // s: 61
    '        <xf numFmtId="169" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +  // s: 62
    '        <xf numFmtId="3" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +    // s: 63
    '        <xf numFmtId="4" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +    // s: 64
    '        <xf numFmtId="1" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +    // s: 65
    '        <xf numFmtId="2" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>' +    // s: 66
    '        <xf numFmtId="0" fontId="5" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +        // s: 67
    '            <alignment horizontal="center" vertical="center"/>' +
    '        </xf>' +
    '        <xf numFmtId="0" fontId="6" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +        // s: 68
    '            <alignment horizontal="center" vertical="center"/>' +
    '        </xf>' +
    '        <xf numFmtId="2" fontId="0" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +        // s: 69
    '            <alignment horizontal="center" vertical="center"/>' +
    '        </xf>' +
    '        <xf numFmtId="2" fontId="7" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +        // s: 70
    '            <alignment horizontal="center" vertical="center"/>' +
    '        </xf>' +
    '        <xf numFmtId="167" fontId="7" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1" applyNumberFormat="1">' +    // s: 71
    '            <alignment horizontal="center" vertical="center"/>' +
    '        </xf>' +
    '        <xf numFmtId="0" fontId="6" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1" applyNumberFormat="1"></xf>' + // s: 72
    '        <xf numFmtId="0" fontId="7" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +        // s: 73
    '            <alignment horizontal="center" vertical="center"/>' +
    '        </xf>' +
    '        <xf numFmtId="0" fontId="0" fillId="0" borderId="2" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"/>' +        // s: 74
    '        <xf numFmtId="2" fontId="0" fillId="0" borderId="2" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +        // s: 75
    '            <alignment horizontal="center" vertical="center"/>' +
    '        </xf>' +
    '        <xf numFmtId="167" fontId="0" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +        // s: 76
    '            <alignment horizontal="center" vertical="center"/>' +
    '        </xf>' +
    '        <xf numFmtId="167" fontId="0" fillId="0" borderId="2" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +        // s: 77
    '            <alignment horizontal="center" vertical="center"/>' +
    '        </xf>' +
    '        <xf numFmtId="1" fontId="0" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +        // s: 78
    '            <alignment horizontal="center" vertical="center"/>' +
    '        </xf>' +
    '    </cellXfs>' +
    '    <cellStyles count="1">' +
    '        <cellStyle name="Normal" xfId="0" builtinId="0" />' +
    '    </cellStyles>' +
    '    <dxfs count="0" />' +
    '    <tableStyles count="0" defaultTableStyle="TableStyleMedium9" defaultPivotStyle="PivotStyleMedium4" />' +
    '</styleSheet>';

const changeExcelStyle = (xlsx) => {
    xlsx.xl['styles.xml'] = $.parseXML($customExcelStyle);
};

// Add a new Row to the file to export.
const insertRow = (sheet, index, data, afterData = false) => {

    // r: xml tag for row.
    // c: xml tag for column.
    // v: xml tag for value of the cell.
    // s: xml tag for style of the cell.
    // is: xml tag for container of text of the cell.
    // t: xml tag for text value of the cell.

    let row = sheet.createElement('row');
    row.setAttribute('r', index);

    for (let i = 0; i < data.length; i++) {
        let key = data[i].key;
        let value = data[i].value;

        let c = sheet.createElement('c');
        c.setAttribute('r', key + index);

        let text = sheet.createTextNode(value);

        if (typeof value === 'number') {
            c.setAttribute('s', '64');
            let v = sheet.createElement('v');

            v.appendChild(text);
            c.appendChild(v);
        } else {
            c.setAttribute('t', 'inlineStr');
            let t = sheet.createElement('t');
            let is = sheet.createElement('is');

            t.appendChild(text);
            is.appendChild(t);
            c.appendChild(is);
        }

        row.appendChild(c);
    }

    let sheetData = sheet.getElementsByTagName('sheetData')[0];

    if (!afterData) {
        sheetData.insertBefore(row, sheetData.childNodes[index]);
    } else {
        sheetData.appendChild(row);
    }
};

const updateRowsIndex = (sheet) => {
    // Update Rows
    $('row', sheet).each((index, element) => {
        index = index + 1;
        $(element).attr('r', index);
    });

    // Update row > c
    $('row c ', sheet).each((index, element) => {
        let attr = $(element).attr('r');
        let pre = attr.substring(0, 1);
        let ind = $(element).parent().attr('r');
        $(element).attr('r', pre + ind);
    });
};

// Merge cells given a rowspan or colspan.
const mergeCells = (sheet, span) => {
    let mergeCells = $('mergeCells', sheet);

    const _createNode = ( doc, nodeName, opts ) => {
        let tempNode = doc.createElement( nodeName );

        if ( opts ) {
            if ( opts.attr ) {
                $(tempNode).attr( opts.attr );
            }

            if ( opts.children ) {
                $.each( opts.children, ( key, value ) => {
                    tempNode.appendChild( value );
                } );
            }

            if ( opts.text !== null && opts.text !== undefined ) {
                tempNode.appendChild( doc.createTextNode( opts.text ) );
            }
        }

        return tempNode;
    };

    mergeCells[0].appendChild(_createNode( sheet, 'mergeCell', {
        attr: {
            ref: span
        }
    }));

    mergeCells.attr( 'count', mergeCells.attr( 'count' ) + 1 );
};