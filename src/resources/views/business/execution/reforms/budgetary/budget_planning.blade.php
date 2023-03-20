<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="col-md-11 col-sm-11 col-xs-11">
                <h2>
                    <i class="fa fa-product-hunt"></i> {{ trans('projects.labels.project') }}: {{ $project->name }}
                </h2>
            </div>
            <div class="clearfix"></div>
            <div class="x_content">
                <div id="myGrid" style="min-width: 900px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row text-center pt-3">
    <a href="{{ route('index.budgetary.reforms.reforms_reprogramming.execution') }}" class="btn btn-info ajaxify">
        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
    </a>
    <button type="button" class="btn btn-success" id="btn-save">
        <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
    </button>
</div>

<script>
    $(() => {

        let notAccruedColumn = 7;
        let monthlyTotalColumn = 8;

        // Grid
        let taskNameFormatter = (row, cell, value, columnDef, dataContext) => {
            if (value == null || dataContext === undefined) {
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
                return spacer + " <span class='toggle-tree'></span>&nbsp;" + value;
            }
        };

        let blankZeroFormatter = (row, cell, value, columnDef, dataContext) => {
            if (dataContext.indent !== 2 && cell === monthlyTotalColumn + 1) {
                return "--";
            }

            if (dataContext.indent === 2 && cell < monthlyTotalColumn) {
                return "--";
            }
            if (value == null) {
                return "";
            }
            if (cell === notAccruedColumn || cell === monthlyTotalColumn) {
                if (parseFloat(dataContext.total_not_accrued).toFixed(2) !== parseFloat(dataContext.total_month).toFixed(2)) {
                    return "<span class='text-danger fw-b'>" + $.number(value, 2) + "</span>";
                }
            }
            return $.number(value, 2);
        };

        let dataView;
        let grid;
        let data = [];
        let columns = [
            {id: "name", name: "{{ trans('reprogramming.labels.name') }}", field: "name", width: 400, cssClass: "cell-title", formatter: taskNameFormatter},
            {
                id: "total_amount", name: "{{ trans('reprogramming.labels.total_assigned') }}", field: "total_amount", width: 115, cssClass: "cell-title text-center", formatter:
                blankZeroFormatter
            },
            {
                id: "total_reform", name: "{{ trans('reprogramming.labels.total_reform') }}", field: "total_reform", width: 115, cssClass: "cell-title text-center", formatter:
                blankZeroFormatter
            },
            {
                id: "total_encoded", name: "{{ trans('reprogramming.labels.total_encoded') }}", field: "total_encoded", width: 115, cssClass: "cell-title text-center", formatter:
                blankZeroFormatter
            },
            {
                id: "total_accrued", name: "{{ trans('reprogramming.labels.total_accrued') }}", field: "total_accrued", width: 115, cssClass: "cell-title text-center", formatter:
                blankZeroFormatter
            },
            {
                id: "total_certificate",
                name: "{{ trans('reprogramming.labels.total_certificate') }}",
                field: "total_certificate",
                width: 115,
                cssClass: "cell-title text-center",
                formatter: blankZeroFormatter
            },
            {
                id: "total_committed",
                name: "{{ trans('reprogramming.labels.total_committed') }}",
                field: "total_committed",
                width: 115,
                cssClass: "cell-title text-center",
                formatter: blankZeroFormatter
            },
            {
                id: "total_not_accrued",
                name: "{{ trans('reprogramming.labels.total_not_accrued') }}",
                field: "total_not_accrued",
                width: 115,
                cssClass: "cell-title text-center",
                formatter: blankZeroFormatter
            },
            {
                id: "total_month",
                name: "{{ trans('reprogramming.labels.total_monthly') }}",
                field: "total_month",
                width: 100,
                editor: Slick.Editors.Float,
                cssClass: "cell-title text-center",
                formatter: blankZeroFormatter
            },
            {
                id: "quantity",
                name: "{{ trans('reprogramming.labels.quantity') }}",
                field: "quantity",
                width: 80,
                editor: Slick.Editors.Float,
                cssClass: "cell-title text-center",
                formatter: blankZeroFormatter
            },
            {
                id: "jan", name: "{{ trans('reprogramming.labels.jan') }}", field: "jan", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "feb", name: "{{ trans('reprogramming.labels.feb') }}", field: "feb", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "mar", name: "{{ trans('reprogramming.labels.mar') }}", field: "mar", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "apr", name: "{{ trans('reprogramming.labels.apr') }}", field: "apr", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "may", name: "{{ trans('reprogramming.labels.may') }}", field: "may", width: 80, editor: Slick.Editors.Float,
                editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "jun", name: "{{ trans('reprogramming.labels.jun') }}", field: "jun", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "jul", name: "{{ trans('reprogramming.labels.jul') }}", field: "jul", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "aug", name: "{{ trans('reprogramming.labels.aug') }}", field: "aug", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "sep", name: "{{ trans('reprogramming.labels.sep') }}", field: "sep", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "oct", name: "{{ trans('reprogramming.labels.oct') }}", field: "oct", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "nov", name: "{{ trans('reprogramming.labels.nov') }}", field: "nov", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
            },
            {
                id: "dec", name: "{{ trans('reprogramming.labels.dec') }}", field: "dec", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass:
                    'text-center', formatter: blankZeroFormatter
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
            explicitInitialization: true
        };

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
        data = $.parseJSON('{!! $budgetPlanning !!}'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));
        let currentMonth = parseInt({{ $currentMonth }}) + monthlyTotalColumn + 1; // Number of columns before January

        // initialize the model
        dataView = new Slick.Data.DataView({inlineFilters: true});
        dataView.beginUpdate();
        dataView.setItems(data);
        dataView.setFilter(filterItems);
        dataView.endUpdate();

        // initialize the grid
        grid = new Slick.Grid("#myGrid", dataView, columns, options);

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
            if (args.cell === monthlyTotalColumn + 1 && args.item.indent === 2 && args.item.editable) {
                return true;
            }
            if (args.cell < currentMonth) {
                return false;
            }
            return args.item.editable;
        });

        grid.onBeforeAppendCell.subscribe(function (e, args) {
            if (args.cell > monthlyTotalColumn + 1 && args.cell < currentMonth - 1) {
                return 'bg-grey';
            }
            if (args.cell === (currentMonth - 1)) {
                return 'bg-grey br-2';
            }
            return null;
        });

        grid.init();

        /**
         * Actualiza los totales de cada columna
         *
         */
        grid.onCellChange.subscribe((e, args) => {
            dataView.updateItem(args.item.id, args.item);
            if (args.item.parent != null) {
                let parent = dataView.getItem(args.item.parent);
                let amount = 0;
                $.each(dataView.getItems(), (index, item) => {
                    if (item.parent === parent.id) {
                        amount += item[grid.getColumns()[args.cell].field] ? item[grid.getColumns()[args.cell].field] : 0;
                    }
                });
                parent[grid.getColumns()[args.cell].field] = parseFloat(amount.toFixed(2));
                dataView.updateItem(parent.id, parent);
            }
            updateRowTotal(args.item);
        });

        dataView.onRowsChanged.subscribe((e, args) => {
            grid.invalidateRows(args.rows);
            grid.render();
        });

        /**
         * Actualiza los totales de cada fila
         *
         * @param row
         */
        const updateRowTotal = (row) => {
            let rowTotal = 0;
            for (let i = currentMonth; i < grid.getColumns().length; i++) {
                rowTotal += row[grid.getColumns()[i].field] || 0;
            }
            row.total_month = parseFloat(rowTotal.toFixed(2));
            dataView.updateItem(row.id, row);

            if (row.parent != null) {
                let parent = dataView.getItem(row.parent);
                rowTotal = 0;

                for (let i = currentMonth; i < grid.getColumns().length; i++) {
                    rowTotal += parent[grid.getColumns()[i].field] || 0;
                }
                parent.total_month = parseFloat(rowTotal.toFixed(2));
                dataView.updateItem(parent.id, parent);

            }
        };

        $.each(dataView.getItems(), (index, item) => {
            let rowTotal = 0;
            for (let i = currentMonth; i < grid.getColumns().length; i++) {
                rowTotal += item[grid.getColumns()[i].field] || 0;
            }
            item.total_month = parseFloat(rowTotal.toFixed(2));
            dataView.updateItem(item.id, item);
        });

        grid.onValidationError.subscribe((e, args) => {
            notify(args.validationResults.msg, 'warning');
        });
        // End Grid

        $('#btn-save').on('click', () => {
            let valid = true;
            let items = dataView.getItems();
            $.each(items, (index, item) => {
                if (item.indent <= 1 && parseFloat(item.total_not_accrued).toFixed(2) !== parseFloat(item.total_month).toFixed(2)) {
                    valid = false;
                    return false;
                }
            });

            if (!valid) {
                notify('{{ trans('reprogramming.messages.exceptions.budget_planning') }}', 'warning')
            } else {
                pushRequest('{{ route('update.budgetary.reforms.reforms_reprogramming.execution', ['projectId' => $projectFiscalYear->id]) }}', null, null, 'POST', {
                    items: dataView.getItems(),
                    '_token': '{{ csrf_token() }}'
                });
            }
        });

        $(window).resize(function () {
            grid.resizeCanvas();
        });
    });
</script>
