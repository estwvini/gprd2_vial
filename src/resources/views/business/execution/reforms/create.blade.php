@php use App\Models\Business\Tracking\Reform; @endphp
@php use App\Repositories\Repository\Business\Tracking\ReformRepository; @endphp
@permission('create.reforms.reforms_reprogramming.execution')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>
                @if($pageView === Reform::TYPE_CREATE)
                    {{ trans('reforms.labels.create') }}
                @else
                    {{ trans('reforms.labels.edit') }}
                @endif
            </h3>
        </div>
    </div>

    <div class="title_right hidden-xs">
        <ol class="breadcrumb pull-right">
            @permission('index.reforms.reforms_reprogramming.execution')
            <li>
                <a class="ajaxify" href="{{ route('index.reforms.reforms_reprogramming.execution') }}">
                    {{ trans('reforms.title') }}
                </a>
            </li>
            @endpermission

            <li class="active">
                @if($pageView === Reform::TYPE_CREATE)
                    {{ trans('app.labels.new') }}
                @else
                    {{ trans('app.labels.edit') }}
                @endif
            </li>
        </ol>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="form-group col-md-1 col-sm-6 col-xs-6">
            <label class="control-label" for="number">
                {{ trans('reforms.labels.number') }}
            </label>
            <input type="text" class="form-control" id="number" autocomplete="off" readonly
                   value="{{ ReformRepository::MOV_REFORM_TYPE }} - {{ $reform->acu_tip }}">
        </div>

        <div class="form-group col-md-2 col-sm-6 col-xs-6">
            <label class="control-label" for="type">
                {{ trans('reforms.labels.type') }}
            </label>
            <select class="form-control" id="type" data-column="3">
                <option value="{{ ReformRepository::REFORMS_TYPE_TRANSFER_0 }}"
                        @if($reform->incremen === ReformRepository::REFORMS_TYPE_TRANSFER_0) selected @endif>
                    {{ trans('reforms.labels.type_transfer') }}</option>
                <option value="{{ ReformRepository::REFORMS_TYPE_INCREASE_1 }}"
                        @if($reform->incremen === ReformRepository::REFORMS_TYPE_INCREASE_1) selected @endif>
                    {{ trans('reforms.labels.type_increase') }}</option>
                <option value="{{ ReformRepository::REFORMS_TYPE_DECREASE_2 }}"
                        @if($reform->incremen === ReformRepository::REFORMS_TYPE_DECREASE_2) selected @endif>
                    {{ trans('reforms.labels.type_decrease') }}</option>
            </select>
        </div>

        <div class="form-group col-md-2 col-sm-6 col-xs-6">
            <label class="control-label" for="approved_date">
                {{ trans('reforms.labels.approved_date') }}
            </label>
            <div class="input-group mb-0">
                <input type="text" class="form-control" id="approved_date" autocomplete="off" readonly value="{{ $reform->fec_apr }}">
                <span class="input-group-addon clear-selection">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>

        <div class="form-group col-md-2 col-sm-6 col-xs-6">
            <label class="control-label" for="assigned_date">
                {{ trans('reforms.labels.assigned_date') }}
            </label>
            <div class="input-group mb-0">
                <input type="text" class="form-control picker readonly-white" id="assigned_date" autocomplete="off" readonly value="{{ $reform->fec_asi }}">
                <span class="input-group-addon clear-selection">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>

        <div class="form-group col-md-2 col-sm-6 col-xs-6">
            <label class="control-label">
                {{ trans('reforms.labels.state') }}
            </label>
            <p class="mt-2">
                <span class="label @if($reform->estado == ReformRepository::OPERATION_STATE_APPROVED_3) label-success
                                   @elseif($reform->estado == ReformRepository::OPERATION_STATE_SQUARE_2) label-warning
                                   @else label-danger @endif fs-m">{{ trans('reforms.labels.status_' . $reform->estado) }}</span>
            </p>
        </div>

        <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <label class="control-label" for="description">
                {{ trans('reforms.labels.description') }}
            </label>
            <textarea type="text" class="form-control" id="description">{{ $reform->des_cab }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-search"></i> {{ trans('reforms.labels.search_budget_item') }}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row mb-2">
                        <div class="form-group col-md-4 pl-0">
                            <label class="control-label">
                                {{ trans('reforms.labels.budget_item_type') }}
                            </label>
                            <div class="btn-group-vertical" data-toggle="buttons">
                                <label class="btn btn-default active">
                                    <input type="radio" name="budget_type" checked value="2"> {{ trans('reforms.labels.budget_type_income') }}
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="budget_type" value="1"> {{ trans('reforms.labels.budget_type_expense') }}
                                </label>
                            </div>
                        </div>
                        <div id="expense_filters" style="display: none">
                            <div class="form-group col-md-4 mb-0">
                                <label class="control-label" for="executing_unit">
                                    {{ trans('reforms.labels.executing_unit') }}
                                </label>
                                <select class="form-control select2" id="executing_unit">
                                    <option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>
                                    @foreach($executingUnits as $unit)
                                        <option value="{{ $unit->code }}" data-id="{{ $unit->id }}">
                                            {{ $unit->code }} - {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4 mb-0">
                                <label class="control-label" for="project">
                                    {{ trans('reforms.labels.project') }}
                                </label>
                                <select class="form-control select2" id="project" disabled>
                                    <option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-8 col-md-offset-4 mb-0">
                                <label class="control-label" for="activity">
                                    {{ trans('reforms.labels.activity') }}
                                </label>
                                <select class="form-control select2" id="activity" disabled>
                                    <option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <table class="table" id="budget_items_tb">
                        <thead>
                        <tr>
                            <th>{{ trans('app.labels.select') }}</th>
                            <th>{{ trans('reforms.labels.item') }}</th>
                            <th>{{ trans('reforms.labels.balance') }}</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-6" id="new_reform_context">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-plus"></i> {{ trans('reforms.labels.add_item') }}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label" for="item_code">
                                {{ trans('reforms.labels.item') }}
                            </label>
                            <input type="text" class="form-control" id="item_code" readonly data-bind="value: selectedItem().cuenta">
                        </div>

                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label" for="item_name">
                                {{ trans('app.headers.name') }}
                            </label>
                            <textarea type="text" class="form-control" id="item_name" readonly data-bind="value: selectedItem().nom_cue"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label" for="item_description">
                                {{ trans('app.headers.description') }}
                            </label>
                            <textarea type="text" class="form-control" id="item_description" readonly data-bind="value: selectedItem().description_item"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label" for="item_increase">
                                {{ trans('reforms.labels.increase') }}
                            </label>
                            <div class="input-group">
                                 <span class="input-group-addon warning">
                                <span class="fa fa-dollar"></span>
                            </span>
                                <input type="text" class="form-control" id="item_increase"
                                       data-bind="value: selectedItem().val_deb, attr: { readonly: !enabledIncreaseInputs() } " min="0">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label" for="item_decrease" data-bind="text: labelDecreaseInput()">
                            </label>
                            <div class="input-group">
                                 <span class="input-group-addon warning">
                                <span class="fa fa-dollar"></span>
                            </span>
                                <input type="text" class="form-control" id="item_decrease"
                                       data-bind="value: selectedItem().val_cre, attr: { readonly: !enabledDecreaseInputs() }" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="ln_solid mt-0 ml-10 mr-10"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <button data-bind='click: onClickAddItem' class="btn btn-success">
                                <i class="fa fa-plus"></i> {{ trans('app.labels.add') }}
                            </button>
                        </div>
                    </div>

                    <fieldset>
                        <legend class="scheduler-border">
                            <i class="fa fa-money"></i> {{ trans('reforms.labels.details') }}
                        </legend>
                        <div class="row">
                            <table class="table table-responsive scroll-table-x" id="budget_items_detail_tb">
                                <thead>
                                <tr>
                                    <th class="w-50">{{ trans('reforms.labels.item') }}</th>
                                    <th class="w-10">{{ trans('reforms.labels.increase') }}</th>
                                    <th class="w-10">{{ trans('reforms.labels.decrease') }}</th>
                                    <th class="w-10">{{ trans('app.labels.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="h-0 bg-green fw-b text-center" data-bind="visible: incomeItems().length">
                                    <td colspan="5">{{ trans('reforms.labels.budget_type_income') }}</td>
                                </tr>
                                <!-- ko foreach: incomeItems -->
                                <tr>
                                    <td data-bind="html: description"></td>
                                    <td data-bind="text: val_deb" class="text-center"></td>
                                    <td data-bind="html: decrease" class="text-center"></td>
                                    <td class="text-center">
                                        <button data-bind='click: $root.removeItem' class="btn btn-danger btn-xs"
                                                role="button" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('reforms.messages.actions.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button data-bind='click: $root.editItem' class="btn btn-success btn-xs"
                                                role="button" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('reforms.messages.actions.edit') }}">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- /ko -->

                                <tr data-bind="css: subTotalIncomeBg, visible: (incomeItems().length && reformType() == '{{ ReformRepository::REFORMS_TYPE_TRANSFER_0 }}')"
                                    class="fw-b">
                                    <td class="text-right" colspan="1">{{ trans('reforms.labels.sub_total_income') }}</td>
                                    <td class="text-center" data-bind="text: subTotalIncreaseIncome"></td>
                                    <td class="text-center" data-bind="text: subTotalDecreaseIncome"></td>
                                    <td></td>
                                </tr>

                                <tr class="h-0 bg-green fw-b text-center" data-bind="visible: expenseItems().length">
                                    <td colspan="4">{{ trans('reforms.labels.budget_type_expense') }}</td>
                                </tr>
                                <!-- ko foreach: expenseItems -->
                                <tr>
                                    <td data-bind="html: description"></td>
                                    <td data-bind="text: val_deb" class="text-center"></td>
                                    <td data-bind="html: decrease" class="text-center"></td>
                                    <td class="text-center">
                                        <button data-bind='click: $root.removeItem' class="btn btn-danger btn-xs"
                                                role="button" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('reforms.messages.actions.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button data-bind='click: $root.editItem' class="btn btn-success btn-xs"
                                                role="button" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('reforms.messages.actions.edit') }}">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- /ko -->

                                <tr data-bind="css: subTotalExpenseBg, visible: (expenseItems().length && reformType() == '{{ ReformRepository::REFORMS_TYPE_TRANSFER_0 }}')"
                                    class="fw-b">
                                    <td class="text-right" colspan="1">{{ trans('reforms.labels.sub_total_expense') }}</td>
                                    <td class="text-center" data-bind="text: subTotalIncreaseExpense"></td>
                                    <td class="text-center" data-bind="text: subTotalDecreaseExpense"></td>
                                    <td></td>
                                </tr>

                                <tr data-bind="css: totalBg" class="fw-b">
                                    <td class="text-right" colspan="1">{{ trans('app.labels.footer_total') }}</td>
                                    <td class="text-center" data-bind="text: totalIncrease"></td>
                                    <td class="text-center" data-bind="text: totalDecrease"></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="ln_solid mt-0 ml-10 mr-10"></div>
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <a href="{{ route('index.reforms.reforms_reprogramming.execution') }}" class="btn btn-info ajaxify">
                                    <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                                </a>
                                <button class="btn btn-warning" id="update_btn">
                                    <i class="fa fa-save"></i> {{ trans('app.labels.save') }}
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        let budget_items_tb = build_datatable($('#budget_items_tb'), {
            ajax: {
                url: '{!! route('data.create.reforms.reforms_reprogramming.execution') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            budget_item_type: $('input[type=radio][name=budget_type]:checked').val(),
                            executing_unit: $("#executing_unit").val(),
                            project: $('#project').find(':selected').data('code'),
                            activity: $("#activity").val()
                        }
                    });
                }
            },
            scrollX: true,
            responsive: false,
            scrollCollapse: true,
            order: [],
            columns: [
                {data: 'actions', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'description', width: '85%', sortable: false},
                {data: 'balance', width: '10%', class: 'text-center', sortable: false}
            ],
            fnRowCallback: (nRow, aData) => {
                $(nRow).find('a').bind('click', (e) => {
                    e.preventDefault();
                    let item = new BudgetItem(
                        aData.cuenta,
                        aData.nom_cue,
                        aData.identifi,
                        aData.balance
                    );
                    let url = '{{ route('search.create.reforms.reforms_reprogramming.execution', ['code' => '__CODE__']) }}'
                    url = url.replace('__CODE__', aData.cuenta)
                    pushRequest(url, null, (response) => {
                        if (response.success && response.item) {
                            item.description_item(response.item.description);
                        }
                        vm.selectedItem(item);
                    })
                });
            },
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            }
        });

        $('.picker').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'es-es',
            ignoreReadonly: true,
            minDate: moment('{{ $minDate }}', 'YYYY-MM-DD'),
            maxDate: moment('{{ $maxDate }}', 'YYYY-MM-DD')
        });

        $('.picker').on('dp.change', (e) => {
            $('#approved_date').val($(e.currentTarget).val());
        });

        $('.clear-selection').on('click', () => {
            $('.picker').datetimepicker('show');
        });

        $('#type').on('change', (e) => {
            vm.reformType($(e.currentTarget).val());
        });

        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', (e) => {

            if ($(e.currentTarget).attr('id') === 'executing_unit') {
                $('#project').html('');
                $('#project').prop("disabled", true);
                $('#project').append('<option value="0" data-code="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>');

                $('#activity').html('');
                $('#activity').prop("disabled", true);
                $('#activity').append('<option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>');

                if ($('#executing_unit').val() !== '0') {// '0' default option

                    let url = '{{ route('projects.create.reforms.reforms_reprogramming.execution', ['executingUnitId' => '__ID__']) }}';
                    url = url.replace('__ID__', $('#executing_unit').find(':selected').data('id'));

                    pushRequest(url, null, (response) => {
                        $.each(response, (index, value) => {
                            $('#project').append("<option value=" + value.id + " data-code=" + value.fullCode + ">" + value.project.cup + ' - ' + value.project.name + "</option>");
                        });
                        $('#project').select2({});
                        if (response.length > 0) {
                            $('#project').prop("disabled", false);
                        }
                    }, 'get', null, false);
                }
            } else if ($(e.currentTarget).attr('id') === 'project') {
                $('#activity').html('');
                $('#activity').prop("disabled", true);
                $('#activity').append('<option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>');

                if ($('#project').val() !== '0') {// '0' default option

                    let url = '{{ route('activities.create.reforms.reforms_reprogramming.execution', ['projectId' => '__ID__']) }}';
                    url = url.replace('__ID__', $('#project').val());

                    pushRequest(url, null, (response) => {
                        let opt = [];
                        $.each(response, (index, value) => {
                            opt.push({
                                id: value.code,
                                text: value.code + ' - ' + value.name,
                            });
                        });
                        $('#activity').select2({
                            data: opt
                        });
                        if (opt.length > 0) {
                            $('#activity').prop("disabled", false);
                        }
                    }, 'get', null, false)
                }
            }
            budget_items_tb.draw();
        });

        $('input[type=radio][name=budget_type]').on('change', () => {
            // '1' expense budget item
            if ($('input[type=radio][name=budget_type]:checked').val() == '{{ ReformRepository::BUDGET_ITEM_EXPENSE }}') {
                $('#expense_filters').show();
                $('#project').html('');
                $('#project').prop("disabled", true);
                $('#project').append('<option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>');

                $('#activity').html('');
                $('#activity').prop("disabled", true);
                $('#activity').append('<option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>');

                $('#executing_unit').val('0').trigger('change');
            } else {
                $('#expense_filters').hide();
            }
            budget_items_tb.draw();
        });

        class BudgetItem {
            constructor(cuenta, nom_cue, asociac, balance, sec_det, desc, val_deb, val_cre) {
                this.cuenta = ko.observable(cuenta);
                this.nom_cue = ko.observable(nom_cue);
                this.val_deb = ko.observable(val_deb || 0);
                this.val_cre = ko.observable(val_cre || 0);
                this.asociac = ko.observable(asociac);
                this.sec_det = sec_det;
                this.balance = ko.observable(balance || 0);
                this.description = ko.pureComputed(() => {
                    return this.cuenta() + ' <br/> ' + this.nom_cue()
                });

                this.decrease = ko.pureComputed(() => {
                    if (parseFloat(this.val_cre()) > this.balance() &&
                        vm.reformType() !== '{{ ReformRepository::REFORMS_TYPE_INCREASE_1 }}') {
                        return "<span class='label label-warning'>" + this.val_cre() + "</span>";
                    }

                    return this.val_cre();
                });

                this.description_item = ko.observable(desc || '');
            }
        }

        class ViewModel {
            constructor() {
                this.reformType = ko.observable('{{ $reform->incremen }}');
                this.selectedItem = ko.observable(new BudgetItem());
                this.incomeItems = ko.observableArray([]);
                this.expenseItems = ko.observableArray([]);

                this.totalIncrease = ko.observable(0);
                this.subTotalIncreaseIncome = ko.observable(0);
                this.subTotalIncreaseExpense = ko.observable(0);

                this.totalDecrease = ko.observable(0);
                this.subTotalDecreaseIncome = ko.observable(0);
                this.subTotalDecreaseExpense = ko.observable(0);

                this.incomeItems.subscribe(() => {
                    this.totalIncrease(0);
                    this.totalDecrease(0);
                    this.subTotalIncreaseIncome(0);
                    this.subTotalIncreaseExpense(0);
                    this.subTotalDecreaseIncome(0);
                    this.subTotalDecreaseExpense(0);

                    this.incomeItems().forEach((item) => {
                        this.totalIncrease((parseFloat(this.totalIncrease()) + parseFloat(item.val_deb())).toFixed(2));
                        this.totalDecrease((parseFloat(this.totalDecrease()) + parseFloat(item.val_cre())).toFixed(2));

                        this.subTotalIncreaseIncome((parseFloat(this.subTotalIncreaseIncome()) + parseFloat(item.val_deb())).toFixed(2));
                        this.subTotalDecreaseIncome((parseFloat(this.subTotalDecreaseIncome()) + parseFloat(item.val_cre())).toFixed(2));
                    });

                    this.expenseItems().forEach((item) => {
                        this.totalIncrease((parseFloat(this.totalIncrease()) + parseFloat(item.val_deb())).toFixed(2));
                        this.totalDecrease((parseFloat(this.totalDecrease()) + parseFloat(item.val_cre())).toFixed(2));

                        this.subTotalIncreaseExpense((parseFloat(this.subTotalIncreaseExpense()) + parseFloat(item.val_deb())).toFixed(2));
                        this.subTotalDecreaseExpense((parseFloat(this.subTotalDecreaseExpense()) + parseFloat(item.val_cre())).toFixed(2));
                    });
                });
                this.expenseItems.subscribe(() => {
                    this.totalIncrease(0);
                    this.totalDecrease(0);
                    this.subTotalIncreaseIncome(0);
                    this.subTotalDecreaseIncome(0);
                    this.subTotalIncreaseExpense(0);
                    this.subTotalDecreaseExpense(0);

                    this.expenseItems().forEach((item) => {
                        this.totalIncrease((parseFloat(this.totalIncrease()) + parseFloat(item.val_deb())).toFixed(2));
                        this.totalDecrease((parseFloat(this.totalDecrease()) + parseFloat(item.val_cre())).toFixed(2));

                        this.subTotalIncreaseExpense((parseFloat(this.subTotalIncreaseExpense()) + parseFloat(item.val_deb())).toFixed(2));
                        this.subTotalDecreaseExpense((parseFloat(this.subTotalDecreaseExpense()) + parseFloat(item.val_cre())).toFixed(2));
                    });

                    this.incomeItems().forEach((item) => {
                        this.totalIncrease((parseFloat(this.totalIncrease()) + parseFloat(item.val_deb())).toFixed(2));
                        this.totalDecrease((parseFloat(this.totalDecrease()) + parseFloat(item.val_cre())).toFixed(2));

                        this.subTotalIncreaseIncome((parseFloat(this.subTotalIncreaseIncome()) + parseFloat(item.val_deb())).toFixed(2));
                        this.subTotalDecreaseIncome((parseFloat(this.subTotalDecreaseIncome()) + parseFloat(item.val_cre())).toFixed(2));
                    });
                });

                this.removeItem = (data) => {
                    $('button[data-toggle="tooltip"]').tooltip('hide');
                    if (data.asociac() == '{{ ReformRepository::BUDGET_ITEM_EXPENSE }}') {// 1 - budget type expense
                        this.expenseItems.remove((item) => {
                            return item.cuenta() === data.cuenta();
                        });
                    } else {// 2 - budget type income
                        this.incomeItems.remove((item) => {
                            return item.cuenta() === data.cuenta();
                        });
                    }
                };

                this.editItem = (data) => {
                    this.selectedItem().cuenta(data.cuenta());
                    this.selectedItem().nom_cue(data.nom_cue());
                    this.selectedItem().balance(data.balance());
                    this.selectedItem().val_deb(data.val_deb());
                    this.selectedItem().val_cre(data.val_cre());
                    this.selectedItem().asociac(data.asociac());
                    this.selectedItem().sec_det = data.sec_det;
                    this.selectedItem().description_item(data.description_item());
                };

                this.onClickAddItem = () => {
                    if (this.selectedItem().cuenta()) {
                        this.removeItem(this.selectedItem());
                        if (parseFloat(this.selectedItem().val_cre()) > this.selectedItem().balance() &&
                            this.reformType() !== '{{ ReformRepository::REFORMS_TYPE_INCREASE_1 }}') {
                            notify('{{ trans('reforms.messages.warning.balance') }}', 'warning')
                        }
                        if (this.selectedItem().asociac() == '{{ ReformRepository::BUDGET_ITEM_EXPENSE }}') {// 1 - budget type expense
                            this.expenseItems.push(new BudgetItem(
                                this.selectedItem().cuenta(),
                                this.selectedItem().nom_cue(),
                                this.selectedItem().asociac(),
                                this.selectedItem().balance(),
                                this.selectedItem().sec_det,
                                this.selectedItem().description_item(),
                                parseFloat(this.selectedItem().val_deb()).toFixed(2),
                                parseFloat(this.selectedItem().val_cre()).toFixed(2))
                            );
                        } else { // 2 - budget type income
                            this.incomeItems.push(new BudgetItem(
                                this.selectedItem().cuenta(),
                                this.selectedItem().nom_cue(),
                                this.selectedItem().asociac(),
                                this.selectedItem().balance(),
                                this.selectedItem().sec_det,
                                this.selectedItem().description_item(),
                                parseFloat(this.selectedItem().val_deb()).toFixed(2),
                                parseFloat(this.selectedItem().val_cre()).toFixed(2))
                            );
                        }
                        this.selectedItem(new BudgetItem());
                        $('button[data-toggle="tooltip"]').tooltip();
                    }
                };

                this.initItems = (item) => {
                    if ('{{ $reform->incremen }}' === '{{ ReformRepository::REFORMS_TYPE_INCREASE_1 }}') {
                        if (item.asociac == '{{ ReformRepository::BUDGET_ITEM_EXPENSE }}') { // 1 - budget type expense
                            this.expenseItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.balance,
                                item.sec_det,
                                '',
                                0.00,
                                parseFloat(item.val_deb).toFixed(2)));

                        } else {// 2 - budget type income
                            this.incomeItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.balance,
                                item.sec_det,
                                '',
                                parseFloat(item.val_deb).toFixed(2),
                                0.00)
                            );
                        }
                    } else if ('{{ $reform->incremen }}' === '{{ ReformRepository::REFORMS_TYPE_DECREASE_2 }}') {
                        if (item.asociac == '{{ ReformRepository::BUDGET_ITEM_EXPENSE }}') { // 1 - budget type expense
                            this.expenseItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.balance,
                                item.sec_det,
                                '',
                                0.00,
                                Math.abs(parseFloat(item.val_deb)).toFixed(2)));

                        } else {// 2 - budget type income
                            this.incomeItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.balance,
                                item.sec_det,
                                '',
                                Math.abs(parseFloat(item.val_deb)).toFixed(2),
                                0.00)
                            );
                        }
                    } else {
                        if (item.asociac == '{{ ReformRepository::BUDGET_ITEM_EXPENSE }}') { // 1 - budget type expense
                            this.expenseItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.balance,
                                item.sec_det,
                                '',
                                parseFloat(item.val_deb).toFixed(2),
                                parseFloat(item.val_cre).toFixed(2)));

                        } else {// 2 - budget type income
                            this.incomeItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.balance,
                                item.sec_det,
                                '',
                                parseFloat(item.val_deb).toFixed(2),
                                parseFloat(item.val_cre).toFixed(2))
                            );
                        }
                    }
                };

                this.totalBg = ko.pureComputed(() => {

                    if (this.totalIncrease() !== this.totalDecrease()) {
                        return 'tr-table-total-invalid';
                    } else {
                        return 'tr-table-total-valid';
                    }
                });

                this.subTotalIncomeBg = ko.pureComputed(() => {

                    if (this.subTotalIncreaseIncome() !== this.subTotalDecreaseIncome()) {
                        return 'tr-table-total-invalid';
                    } else {
                        return 'tr-table-total-valid';
                    }
                });

                this.subTotalExpenseBg = ko.pureComputed(() => {

                    if (this.subTotalIncreaseExpense() !== this.subTotalDecreaseExpense()) {
                        return 'tr-table-total-invalid';
                    } else {
                        return 'tr-table-total-valid';
                    }
                });

                this.enabledDecreaseInputs = ko.pureComputed(() => {

                    if (this.selectedItem().asociac() == '{{ ReformRepository::BUDGET_ITEM_EXPENSE }}') { // 1 - budget type expense
                        return true;
                    } else {
                        return this.reformType() == '{{ ReformRepository::REFORMS_TYPE_TRANSFER_0 }}';
                    }
                });

                this.enabledIncreaseInputs = ko.pureComputed(() => {

                    if (this.selectedItem().asociac() == '{{ ReformRepository::BUDGET_ITEM_INCOME }}') { // 2 - budget type income
                        return true;
                    } else {
                        return this.reformType() == '{{ $ReformRepository::REFORMS_TYPE_TRANSFER_0 }}';
                    }
                });

                this.labelDecreaseInput = ko.pureComputed(() => {

                    if (this.selectedItem().asociac() == '{{ ReformRepository::BUDGET_ITEM_EXPENSE }}' &&
                        this.reformType() == '{{ ReformRepository::REFORMS_TYPE_INCREASE_1 }}') { // 1 - budget type expense
                        return 'Incremento';
                    } else {
                        return 'Disminución';
                    }
                });
            }
        }

        let vm = new ViewModel();
        ko.applyBindings(vm, document.getElementById('new_reform_context'));

        let reformDetails = $.parseJSON('{!! str_replace('\u0022', "\\\\\"", json_encode($reform->details, JSON_HEX_APOS | JSON_HEX_QUOT)) !!}'
            .replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));

        $.each(reformDetails, (index, value) => {
            vm.initItems(value);
        });

        $('#update_btn').on('click', () => {

            pushRequest('{{ route('update.create.reforms.reforms_reprogramming.execution') }}', null, null, 'post', {
                _token: '{{ csrf_token() }}',
                reform: {
                    anio: parseInt({{ $reform->anio }}),
                    codemp: '{{ $reform->codemp }}',
                    sig_tip: '{{ $reform->sig_tip }}',
                    acu_tip: '{{ $reform->acu_tip }}',
                    fec_cre: '{{ $reform->fec_cre }}',
                    cre_por: '{{ $reform->cre_por }}',
                    fec_apr: $('#approved_date').val(),
                    fec_asi: $('#assigned_date').val(),
                    des_cab: $('#description').val(),
                    incremen: $('#type').val(),
                    budget_items: $.merge($.merge([], ko.toJS(vm.incomeItems)), ko.toJS(vm.expenseItems))
                }
            });

        });

        /**
         * Ajusta tamaño de los componentes cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            budget_items_tb.draw();
        });

        $("#item_increase, #item_decrease").inputFilter((value) => {
            return /^\d{0,13}[.]?\d{0,2}$/.test(value);
        });
    })
</script>

@else
    @include('errors.403')
    @endpermission
