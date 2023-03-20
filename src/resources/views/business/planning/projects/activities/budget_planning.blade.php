<div id="myGrid" style="min-width: 900px;"></div>

<div class="row text-center pt-3">
    @if(isset($currentExpenditure) && $currentExpenditure)
        <button type="button" class="btn btn-info" id="btn-cancel">
            <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
        </button>
    @else
        @if(!isset($from_budget_adjustment))
            <a href="{{ route('index.projects.plans_management') }}" class="btn btn-info ajaxify">
                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
            </a>
        @else
            <a href="{{ route('index.budget_adjustment.budget.plans_management') }}" class="btn btn-info ajaxify">
                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
            </a>
        @endif
    @endif
    <button type="button" class="btn btn-success" id="btn-save">
        <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
    </button>
</div>

<script>
    $(() => {

        @if(isset($currentExpenditure) && $currentExpenditure)
        /**
         * Desplazar panel a la derecha y viceversa.
         */
        const toggleSidebar = () => {
            $('#sidebar-left').toggleClass('collapsed');

            $('#budget-items-area').empty();
            $('#load-area').empty();
            $('#budget-planning-area').empty();

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected');
            });
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected');
            });

            $('#sidebar-right').toggleClass('hidden');
            $('.page-title').toggleClass('hidden');
        };

        $('#btn-cancel').click(function () {
            toggleSidebar();
        });
        @endif


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
            if (value === 0 || value == null || dataContext === undefined) {
                return "";
            }
            return $.number(value, 2);
        };

        let dataView;
        let grid;
        let data = [];
        let columns = [
            {id: "name", name: "Nombre", field: "name", width: 400, cssClass: "cell-title", formatter: taskNameFormatter},
            {id: "total", name: "Total Planificado ($)", field: "total", width: 115, cssClass: "cell-title text-center", formatter: blankZeroFormatter},
            {
                id: "total_month",
                name: "Total Meses ($)",
                field: "total_month",
                width: 100,
                editor: Slick.Editors.Float,
                cssClass: "cell-title text-center",
                formatter: blankZeroFormatter
            },
            {id: "jan", name: "Ene", field: "jan", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "feb", name: "Feb", field: "feb", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "mar", name: "Mar", field: "mar", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "apr", name: "Abr", field: "apr", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "may", name: "May", field: "may", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "jun", name: "Jun", field: "jun", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "jul", name: "Jul", field: "jul", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "aug", name: "Ago", field: "aug", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "sep", name: "Sep", field: "sep", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "oct", name: "Oct", field: "oct", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "nov", name: "Nov", field: "nov", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
            {id: "dec", name: "Dic", field: "dec", width: 80, editor: Slick.Editors.Float, editorFixedDecimalPlaces: 2, cssClass: 'text-center', formatter: blankZeroFormatter},
        ];

        let options = {
            editable: true,
            enableCellNavigation: true,
            asyncEditorLoading: false,
            enableColumnReorder: false,
            autoEdit: false,
            rowHeight: 35,
            fullWidthRows: true,
            autoHeight: true
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

        // initialize the model
        dataView = new Slick.Data.DataView({inlineFilters: true});
        dataView.beginUpdate();
        dataView.setItems(data);
        dataView.setFilter(filterItems);
        dataView.endUpdate();
        dataView.getItemMetadata = (row) => {
            let item = dataView.getItem(row);
            let metaData = {columns: {total: {}}};
            if (parseFloat(item.total.toFixed(2)) !== parseFloat(item.total_month)) {
                metaData.cssClasses = 'bg-invalid-row';
            }

            return metaData
        };

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
            if (args.cell === 2) {
                return false;
            }
            if (!args.item.editable) {
                return false;
            }
        });

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

            if (args.cell === 1) {
                updatePlannedBudget();
            }
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
            for (let i = 3; i < grid.getColumns().length; i++) {
                rowTotal += row[grid.getColumns()[i].field] || 0;
            }
            row.total_month = parseFloat(rowTotal.toFixed(2));
            dataView.updateItem(row.id, row);

            if (row.parent != null) {
                let parent = dataView.getItem(row.parent);
                rowTotal = 0;

                for (let i = 3; i < grid.getColumns().length; i++) {
                    rowTotal += parent[grid.getColumns()[i].field] || 0;
                }
                parent.total_month = parseFloat(rowTotal.toFixed(2));
                dataView.updateItem(parent.id, parent);
            }
        };

        $.each(dataView.getItems(), (index, item) => {
            let rowTotal = 0;
            for (let i = 3; i < grid.getColumns().length; i++) {
                rowTotal += item[grid.getColumns()[i].field] || 0;
            }
            item.total_month = parseFloat(rowTotal.toFixed(2));
            dataView.updateItem(item.id, item);
        });

        grid.onValidationError.subscribe((e, args) => {
            notify(args.validationResults.msg, 'warning');
        });
        // End Grid

        @if(!isset($currentExpenditure) || !$currentExpenditure)
        let planned_budget = 0;

        /**
         * Actualiza gráfica y resumen del presupuesto
         */
        const updatePlannedBudget = () => {
            planned_budget = 0;
            $.each(dataView.getItems(), (index, item) => {
                planned_budget += item.indent === 0 ? parseFloat(item.total.toFixed(2)) : 0;
            });

            let referential_budget = parseFloat('{{ $referential_budget }}');
            let difference = referential_budget - planned_budget;
            $('#planned_budget').text('$ ' + $.number(planned_budget, 2));
            $('#difference_budget').text('$ ' + $.number(difference, 2));

            chart.update(planned_budget * 100 / referential_budget);
        };

        $('#chart').easyPieChart({
            easing: "easeOutElastic",
            delay: 3e3,
            barColor: "#26B99A",
            trackColor: "#fff",
            scaleColor: !1,
            lineWidth: 20,
            trackWidth: 16,
            lineCap: "butt",
            onStep: function (a, b, c) { // No ES6
                $(this.el).find(".percent").text(c.toFixed(2))
            }
        });

        let chart = $('#chart').data('easyPieChart');

        updatePlannedBudget();
        @endif

        $('#btn-save').on('click', () => {
            let valid = true;

            if (!valid) {
                notify('{{ trans('activities.messages.errors.budget_planning') }}', 'warning')
            } else {
                @if(isset($currentExpenditure) && $currentExpenditure)
                pushRequest('{{ route('store.budget_planning.current_expenditure_elements.budget.plans_management', ['subprogramId' => $subprogram->id, 'isPlanning' => 1]) }}', null, () => {
                    toggleSidebar()
                }, 'POST', {
                    items: dataView.getItems(),
                    '_token': '{{ csrf_token() }}',
                    currentExpenditure: '{{ $currentExpenditure }}'
                });
                @else
                pushRequest('{{ route('store_budget_planning.list.activities.projects.plans_management', ['projectId' => $entity->id]) }}', null, null, 'POST', {
                    items: dataView.getItems(),
                    '_token': '{{ csrf_token() }}',
                    fromBudgetAdjustment: {{ isset($from_budget_adjustment) ? $from_budget_adjustment : 0 }}
                });
                @endif
            }
        });

        $(window).resize(function () {
            grid.resizeCanvas();
        });
    });
</script>
