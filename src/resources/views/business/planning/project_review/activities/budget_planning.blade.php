<div id="myGrid" style="min-width: 900px;"></div>
<script>
    $(() => {

        // Grid
        /**
         * Formato de celda
         *
         * @param row
         * @param cell
         * @param value
         * @param columnDef
         * @param dataContext
         *
         * @returns {string}
         */
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

        /**
         * Formato de celda
         *
         * @param row
         * @param cell
         * @param value
         * @param columnDef
         * @param dataContext
         *
         * @returns {jQuery|string|string}
         */
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
            editable: false,
            enableCellNavigation: true,
            asyncEditorLoading: false,
            enableColumnReorder: false,
            autoEdit: false,
            rowHeight: 35,
            fullWidthRows: true,
            autoHeight: true
        };

        /**
         * Filtra filas de la tabla
         *
         * @param item
         *
         * @returns {boolean}
         */
        function filterItems(item) {        // No ES6
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

        dataView.onRowsChanged.subscribe((e, args) => {
            grid.invalidateRows(args.rows);
            grid.render();
        });

        $.each(dataView.getItems(), (index, item) => {
            let rowTotal = 0;
            for (let i = 3; i < grid.getColumns().length; i++) {
                rowTotal += parseFloat(item[grid.getColumns()[i].field]) || 0;
            }
            item.total_month = parseFloat(rowTotal.toFixed(2));
            dataView.updateItem(item.id, item);
        });

        $(window).resize(function () {
            grid.resizeCanvas();
        });
        // End Grid
    });
</script>
