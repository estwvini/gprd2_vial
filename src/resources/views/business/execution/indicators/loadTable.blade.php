@inject('PlanIndicator', 'App\Models\Business\PlanIndicator')
<div id="grid" style="min-width: 900px;"></div>
<div class="row text-center pt-3">
    <button type="button" class="btn btn-success" id="btn-save">
        <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
    </button>
</div>
<script>
    $(() => {
        let thresholds = $.parseJSON('{!! $thresholds !!}'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));
        // Grid

        //Formatea el nombre
        let nameFormatter = (row, cell, value, columnDef, dataContext) => {
            if (value === null || dataContext === undefined) {
                return "";
            }

            value = value.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
            let spacer = "<span style='display:inline-block;height:1px;width:" + (15 * dataContext["indent"]) + "px'></span>";
            let idx = dataView.getIdxById(dataContext.id);
            if (data[idx + 1] && data[idx + 1].indent > data[idx].indent) {
                if (dataContext._collapsed) {
                    return spacer + " <span class='toggle-tree expand'></span>&nbsp;" + value;
                } else {
                    return spacer + " <span class='toggle-tree collapse'></span>&nbsp;" + value;
                }
            } else {
                if (dataContext["type_indicator"] == '{{ $PlanIndicator::TYPE_DESCENDING }}') {
                    return spacer + " <span class='toggle-tree fa fa-arrow-down green' data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"{{ trans('indicator_tracking.labels.descending') }}\"></span>&nbsp;" + spacer + value;
                } else if (dataContext['type_indicator'] == '{{ $PlanIndicator::TYPE_ASCENDING }}') {
                    return spacer + " <span class='toggle-tree fa fa-arrow-up green' data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"{{ trans('indicator_tracking.labels.ascending') }}\"></span>&nbsp;" + spacer + value;
                } else {
                    return spacer + " <span class='toggle-tree fs-25 green' data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"{{ trans('indicator_tracking.labels.tolerance') }}\"><b>=</b></span>&nbsp;" + spacer + value;
                }
            }
        };

        //Formatea la columna del semáforo
        let thresholdFormatter = (row, cell, value, columnDef, dataContext) => {
            if (value == null || dataContext === undefined) {
                return "";
            }

            if (value == 'success') {
                return " <label><i class=\"fa fa-circle fa-2x \"style=\"color: #3c763d;\"></i></label>";
            } else if (value == 'danger') {
                return " <label><i class=\"fa fa-circle fa-2x \"style=\"color: #e74c3c;\"></i></label>";
            } else {
                return " <label><i class=\"fa fa-circle fa-2x \"style=\"color: #f39c12;\"></i></label>";
            }
        };

        //Formateo en cero los espacios en blanco
        let blankZeroFormatter = (row, cell, value, columnDef, dataContext) => {
            if (value == null || dataContext === undefined) {
                return "";
            }
            return $.number(value, 2);
        };

        //Formateo en cero los espacios en blanco
        let blankZeroPercentageFormatter = (row, cell, value, columnDef, dataContext) => {
            if (value == null || dataContext === undefined) {
                return "";
            }
            return $.number(value, 2) + ' %';
        };

        //Mostrar acciones
        let showActionsFormatter = (row, cell, value, columnDef, dataContext) => {

            let actions = '';

            let url = "{!! route('show.indicator_progress.execution', ['id' => '__ID__', 'indicatorType' => '__TYPE__']) !!}";
            url = url.replace('__ID__', dataContext.primaryId);
            url = url.replace('__TYPE__', '{{ $type }}');

            if (dataContext.primaryId !== 0 && dataContext.goal_id) {
                actions += '<a class="btn btn-xs  btn-primary ajaxify" role="button" href="' + url + '" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('indicator_tracking.labels.show_indicator') }}"><i class="fa fa-search"></i></a>'
            }

            @permission('download.indicator_progress.execution')
            let urlFile = "{!! route('download.indicator_progress.execution', ['name' => '__NAME__']) !!}";
            urlFile = urlFile.replace('__NAME__', dataContext.primaryId);
            if (dataContext["indent"] == 1 && dataContext["file"] != null) {
                actions += '<a class="btn btn-xs btn-success" role="button" href="' + urlFile + '" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('indicator_tracking.labels.file_download') }}"><i class="glyphicon glyphicon-download-alt"></i></a>'
            }
            @endpermission

            return actions;
        };

        let dataView;
        let grid;
        let data = [];

        // No ES6
        function filterItems(item) {
            if (item.parent != null) {
                let parent = _items[item.parent];
                while (parent) {
                    if (parent._collapsed) {
                        return false;
                    }
                    parent = _items[parent.parent];
                }
            }
            return true;
        }

        // prepare the data
        data = $.parseJSON('{!! $data !!}'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));

        let columnName = '{{ trans('indicator_tracking.labels.name', ['parent' => trans('indicator_tracking.labels.parent.' . $type)]) }}'

        let columns = [
            {
                id: "name",
                name: columnName,
                field: "name",
                width: 500,
                cssClass: "cell-title", formatter: nameFormatter
            },
            {
                id: "measurement_type",
                name: '{{ trans('indicator_tracking.labels.measurement_type') }}',
                field: "measurement_type",
                width: 140,
                cssClass: "cell-title"
            },
            {
                id: "base_line",
                name: '{{ trans('indicator_tracking.labels.base_line') }}',
                field: "base_line",
                width: 100,
                cssClass: "cell-title text-center",
                formatter: blankZeroFormatter
            },
            {
                id: "plan_goal",
                name: '{{ trans('indicator_tracking.labels.goal_value') }}',
                field: "plan_goal",
                width: 135,
                cssClass: "cell-title text-center",
                formatter: blankZeroFormatter
            },
            {
                id: "real_goal",
                name: '{{ trans('indicator_tracking.labels.actual_value') }}',
                field: "real_goal",
                width: 135,
                editor: Slick.Editors.Float,
                editorFixedDecimalPlaces: 2,
                cssClass: 'text-center',
                formatter: blankZeroFormatter
            },
            {
                id: "percentage",
                name: '{{ trans('indicator_tracking.labels.percentage') }}',
                field: "percentage",
                width: 155,
                cssClass: "cell-title text-center",
                formatter: blankZeroPercentageFormatter
            },
            {
                id: "threshold",
                name: '{{ trans('indicator_tracking.labels.threshold') }}',
                field: "threshold",
                width: 100,
                cssClass: "cell-title text-center",
                formatter: thresholdFormatter
            },
            {
                id: "actions",
                name: '{{ trans('app.labels.actions') }}',
                width: 115,
                cssClass: "cell-title text-center",
                formatter: showActionsFormatter
            }
        ];

        let options = {
            editable: true,
            enableCellNavigation: true,
            asyncEditorLoading: false,
            enableColumnReorder: false,
            autoEdit: false,
            rowHeight: 45,
            fullWidthRows: true,
            autoHeight: true,
            forceFitColumns: true
        };

        // initialize the model
        dataView = new Slick.Data.DataView({inlineFilters: true});
        dataView.beginUpdate();
        dataView.setItems(data);
        dataView.setFilter(filterItems);
        dataView.endUpdate();
        dataView.getItemMetadata = (row) => {
            let item = dataView.getItem(row);
            if (item.indent === 0) {
                return {'cssClasses': 'bg-invalid-row-objective'};
            }
        };

        // initialize the grid
        grid = new Slick.Grid("#grid", dataView, columns, options);
        grid.registerPlugin( new Slick.AutoTooltips({ enableForHeaderCells: true }) );

        grid.onClick.subscribe((e, args) => {
            if ($(e.target).hasClass("toggle-tree")) {
                let item = dataView.getItem(args.row);
                if (item) {
                    item._collapsed = !item._collapsed;
                    dataView.updateItem(item.id, item);
                }
                e.stopImmediatePropagation();
            }
        });

        grid.onBeforeEditCell.subscribe((e, args) => {
            if (args.cell != 4) {
                return false;
            }
            if (!args.item.editable) {
                return false;
            }
        });

        grid.onCellChange.subscribe((e, args) => {

            const selectedCell = args.item[grid.getColumns()[args.cell].field]

            if (args.item.plan_goal > 0) {
                if (args.item.type_indicator == '{{ $PlanIndicator::TYPE_ASCENDING }}') {
                    args.item.percentage = selectedCell * 100 / args.item.plan_goal;
                } else if (args.item.type_indicator == '{{ $PlanIndicator::TYPE_DESCENDING }}') {
                    if ((args.item.base_line - args.item.plan_goal) != 0) {
                        if (args.item.goal_type == '{{ $PlanIndicator::TYPE_DISCREET }}') {
                            args.item.percentage = ((args.item.base_line - (args.item.base_line - selectedCell)) / (args.item.base_line - (args.item.base_line - args.item.plan_goal))) * 100;
                        } else {
                            args.item.percentage = ((args.item.base_line - selectedCell) / (args.item.base_line - args.item.plan_goal)) * 100;
                        }
                    } else {
                        args.item.percentage = 0;
                    }
                }

            } else {
                if (args.item.type_indicator == '{{ $PlanIndicator::TYPE_TOLERANCE }}') {

                    let values = args.item.plan_goal.split(' - ');
                    if (selectedCell <= parseFloat(values[1]) && selectedCell >= parseFloat(values[0])) {
                        args.item.percentage = 0;
                    } else {
                        if (parseFloat(values[1]) > 0 && parseFloat(values[0]) > 0) {
                            let percentage_max = selectedCell * 100 / parseFloat(values[1]);
                            let percentage_min = selectedCell * 100 / parseFloat(values[0]);
                            let deviation_percentage_max = Math.abs((percentage_max - 100));
                            let deviation_percentage_min = Math.abs((percentage_min - 100));
                            let measurement_value = deviation_percentage_max;
                            if (deviation_percentage_max > deviation_percentage_min) {
                                measurement_value = deviation_percentage_min;
                            }
                            args.item.percentage = measurement_value;

                        } else {
                            args.item.percentage = 0;
                        }
                    }
                } else {
                    args.item.percentage = 0;
                }
            }

            thresholds.forEach((threshold) => {

                if ((args.item.percentage >= threshold.min && args.item.percentage <= threshold.max) && (args.item.type_indicator == threshold.type)) {
                    args.item.threshold = threshold.color;
                }

            });
            dataView.updateItem(args.item.id, args.item);
        });

        dataView.onRowsChanged.subscribe((e, args) => {
            grid.invalidateRows(args.rows);
            grid.render();
        });

        grid.onValidationError.subscribe((e, args) => {
            notify(args.validationResults.msg, 'warning');
        });
        // End Grid

        if (data.length < 1) {
            $('#btn-save').prop('disabled', true);
        } else {
            $('#btn-save').prop('disabled', false);
        }
        $('#btn-save').unbind('click');
        $('#btn-save').on('click', () => {

            let items = dataView.getItems();

            pushRequest('{{ route('update.indicator_progress.execution') }}', null, null, 'POST', {
                items: dataView.getItems(),
                '_token': '{{ csrf_token() }}'
            });

        });
    });
</script>
