$(() => {

    const KEY_CODES = {LEFT: 37, RIGHT: 39, TAB: 9};

    $.extend(true, window, {
        "Slick": {
            "Editors": {
                "Float": CustomFloatEditor,
                "NumericTotal": NumericTotalEditor,
            }
        }
    });

    function CustomFloatEditor(args) {
        let $input;
        let defaultValue;

        this.init = () => {
            let navOnLR = args.grid.getOptions().editorCellNavOnLRKeys;
            $input = $("<INPUT type=text class='editor-text' maxlength='13' max='9999999999.99'/>").number(true, 2)
                .appendTo(args.container)
                .on("keydown.nav", navOnLR ? handleKeydownLRNav : handleKeydownLRNoNav)
                .focus()
                .select();
        };

        this.destroy = () => {
            $input.remove();
        };

        this.focus = () => {
            $input.focus();
        };

        const getDecimalPlaces = () => {
            let rtn = args.column.editorFixedDecimalPlaces;
            if (typeof rtn == 'undefined') {
                rtn = CustomFloatEditor.DefaultDecimalPlaces;
            }
            return (!rtn && rtn !== 0 ? null : rtn);
        };

        this.loadValue = (item) => {
            defaultValue = item[args.column.field];

            let decPlaces = getDecimalPlaces();
            if (decPlaces !== null
                && (defaultValue || defaultValue === 0)
                && defaultValue.toFixed) {
                defaultValue = defaultValue.toFixed(decPlaces);
            }

            $input.val(defaultValue);
            $input[0].defaultValue = defaultValue;
            $input.select();
        };

        this.serializeValue = () => {
            let rtn = parseFloat($input.val());
            if (CustomFloatEditor.AllowEmptyValue) {
                if (!rtn && rtn !== 0) {
                    rtn = '';
                }
            } else {
                rtn = rtn || 0;
            }

            let decPlaces = getDecimalPlaces();
            if (decPlaces !== null
                && (rtn || rtn === 0)
                && rtn.toFixed) {
                rtn = parseFloat(rtn.toFixed(decPlaces));
            }

            return rtn;
        };

        this.applyValue = (item, state) => {
            item[args.column.field] = state;
        };

        this.isValueChanged = () => {
            return (!($input.val() === "" && defaultValue == null)) && ($input.val() !== defaultValue);
        };

        this.validate = () => {
            if (isNaN($input.val())) {
                return {
                    valid: false,
                    msg: "Please enter a valid number"
                };
            }

            if (args.column.validator) {
                let validationResults = args.column.validator($input.val());
                if (!validationResults.valid) {
                    return validationResults;
                }
            }

            return {
                valid: true,
                msg: null
            };
        };

        this.init();
    }

    CustomFloatEditor.DefaultDecimalPlaces = null;
    CustomFloatEditor.AllowEmptyValue = false;

    function NumericTotalEditor(args) {
        let $quantity, $unit_price, $total;
        let scope = this;

        this.init = () => {
            $quantity = $("<INPUT type=text style='width:60px' placeholder='Cant.' maxlength='10' max='999999.99'/>").number(true, 2)
                .appendTo(args.container)
                .bind("keydown", scope.handleKeyDown)
                .bind("change", () => {
                    $total.val(($quantity.val() * $unit_price.val()));
                });
            $(args.container).append("&nbsp; * &nbsp;");
            $unit_price = $("<INPUT type=text style='width:60px' placeholder='PU' maxlength='10' max='999999.99'/>").number(true, 2)
                .appendTo(args.container)
                .bind("keydown", scope.handleKeyDown)
                .bind("change", () => {
                    $total.val(($quantity.val() * $unit_price.val()));
                });
            $(args.container).append('<span style="background-color: white; padding: 5px;">=</span>');
            $total = $("<INPUT type=text style='width:60px' placeholder='Total.' readonly/>").number(true, 2).appendTo(args.container);
            scope.focus();
        };

        this.handleKeyDown = (e) => {
            if (e.keyCode === KEY_CODES.LEFT || e.keyCode === KEY_CODES.RIGHT || e.keyCode === KEY_CODES.TAB) {
                e.stopImmediatePropagation();
            }
        };

        this.destroy = () => {
            $(args.container).empty();
        };

        this.focus = () => {
            $quantity.focus();
        };

        this.serializeValue = () => {
            return {quantity: parseFloat($quantity.val()), unit_price: parseFloat($unit_price.val())};
        };

        this.applyValue = (item, state) => {
            item.quantity = state.quantity;
            item.unit_price = state.unit_price.toFixed(2);
            item.total = (state.quantity * state.unit_price).toFixed(2);
        };

        this.loadValue = (item) => {
            $quantity.val(item.quantity);
            $unit_price.val(item.unit_price);
            $total.val(item.total);
        };

        this.isValueChanged = () => {
            return args.item.quantity !== parseFloat($quantity.val()) || args.item.unit_price !== parseFloat($unit_price.val());
        };

        this.validate = () => {
            if (isNaN(parseFloat($quantity.val())) || isNaN(parseFloat($unit_price.val()))) {
                return {valid: false, msg: "Por favor, ingrese números válidos."};
            }
            if (parseFloat($quantity.val()) <= 0 || parseFloat($unit_price.val()) <= 0) {
                return {valid: false, msg: "Por favor, ingrese números mayores o igual a 1."};
            }
            return {valid: true, msg: null};
        };

        this.init();
    }

    const handleKeydownLRNav = (e) => {
        let cursorPosition = this.selectionStart;
        let textLength = this.value.length;
        if ((e.keyCode === KEY_CODES.LEFT && cursorPosition > 0) ||
            e.keyCode === KEY_CODES.RIGHT && cursorPosition < textLength - 1) {
            e.stopImmediatePropagation();
        }
    };

    const handleKeydownLRNoNav = (e) => {
        if (e.keyCode === KEY_CODES.LEFT || e.keyCode === KEY_CODES.RIGHT) {
            e.stopImmediatePropagation();
        }
    };
});

(function ($) {
    // Register namespace
    $.extend(true, window, {
        "Slick": {
            "AutoTooltips": AutoTooltips
        }
    });

    /**
     * AutoTooltips plugin to show/hide tooltips when columns are too narrow to fit content.
     * @constructor
     * @param {boolean} [options.enableForCells=true]        - Enable tooltip for grid cells
     * @param {boolean} [options.enableForHeaderCells=false] - Enable tooltip for header cells
     * @param {number}  [options.maxToolTipLength=null]      - The maximum length for a tooltip
     */
    function AutoTooltips(options) {
        var _grid;
        var _self = this;
        var _defaults = {
            enableForCells: true,
            enableForHeaderCells: false,
            maxToolTipLength: null
        };

        /**
         * Initialize plugin.
         */
        function init(grid) {
            options = $.extend(true, {}, _defaults, options);
            _grid = grid;
            if (options.enableForCells) _grid.onMouseEnter.subscribe(handleMouseEnter);
            if (options.enableForHeaderCells) _grid.onHeaderMouseEnter.subscribe(handleHeaderMouseEnter);
        }

        /**
         * Destroy plugin.
         */
        function destroy() {
            if (options.enableForCells) _grid.onMouseEnter.unsubscribe(handleMouseEnter);
            if (options.enableForHeaderCells) _grid.onHeaderMouseEnter.unsubscribe(handleHeaderMouseEnter);
        }

        /**
         * Handle mouse entering grid cell to add/remove tooltip.
         * @param {jQuery.Event} e - The event
         */
        function handleMouseEnter(e) {
            var cell = _grid.getCellFromEvent(e);
            if (cell) {
                var $node = $(_grid.getCellNode(cell.row, cell.cell));
                var text;
                if ($node.innerWidth() < $node[0].scrollWidth) {
                    text = $.trim($node.text());
                    if (options.maxToolTipLength && text.length > options.maxToolTipLength) {
                        text = text.substr(0, options.maxToolTipLength - 3) + "...";
                    }
                } else {
                    text = "";
                }
                $node.attr("title", text);
            }
        }

        /**
         * Handle mouse entering header cell to add/remove tooltip.
         * @param {jQuery.Event} e     - The event
         * @param {object} args.column - The column definition
         */
        function handleHeaderMouseEnter(e, args) {
            var column = args.column,
                $node = $(e.target).closest(".slick-header-column");
            if (!column.toolTip) {
                $node.attr("title", ($node.innerWidth() < $node[0].scrollWidth) ? column.name : "");
            }
        }

        // Public API
        $.extend(this, {
            "init": init,
            "destroy": destroy
        });
    }
})(jQuery);