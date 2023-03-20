@permission('show.reforms.reforms_reprogramming.execution')
@inject('ReformRepository', '\App\Repositories\Repository\Business\Tracking\ReformRepository')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> {{ trans('reforms.labels.details') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form method="post" role="form" id="date_fm" novalidate action="{{ route('approve.show.reforms.reforms_reprogramming.execution', [
                    'companyCode' => $entity->codemp, 'year' => $entity->anio, 'operationType' => $entity->sig_tip, 'operationNumber' => $entity->acu_tip ]) }}">
                @csrf

                <div class="row">
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label class="control-label" for="number">
                            {{ trans('reforms.labels.number') }}
                        </label>
                        <input type="text" class="form-control" id="number" autocomplete="off" readonly value="{{ $entity->sig_tip }} - {{ $entity->acu_tip }}">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label class="control-label" for="type">
                            {{ trans('reforms.labels.type') }}
                        </label>
                        <input type="text" class="form-control" id="type" autocomplete="off" readonly value="{{ $entity->type }}">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label class="control-label" for="approved_date">
                            {{ trans('reforms.labels.approved_date') }} <span class="text-danger">*</span>
                        </label>
                        <div class="input-group mb-0">
                            <input type="text" class="form-control mt-0 @if($entity->estado == $ReformRepository::OPERATION_STATE_SQUARE_2) picker readonly-white @endif"
                                   id="approved_date" name="approved_date" autocomplete="off" readonly required
                                   @if($entity->estado == $ReformRepository::OPERATION_STATE_APPROVED_3) value="{{ $entity->fec_apr }}" @endif>
                            <span class="input-group-addon clear-selection show-picker">
                                <span class="fa fa-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label class="control-label" for="assigned_date">
                            {{ trans('reforms.labels.assigned_date') }}
                        </label>
                        <div class="input-group mb-0">
                            <input type="text" class="form-control" id="assigned_date" autocomplete="off" readonly value="{{ $entity->fec_asi }}">
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
                            <span class="label @if($entity->estado == $ReformRepository::OPERATION_STATE_APPROVED_3) label-success
                                               @elseif($entity->estado == $ReformRepository::OPERATION_STATE_SQUARE_2) label-warning
                                               @else label-danger @endif fs-m">{{ trans('reforms.labels.status_' . $entity->estado) }}</span>
                        </p>
                    </div>
                </div>

                <div class="row">
                    @if($entity->estado == $ReformRepository::OPERATION_STATE_SQUARE_2)
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">

                            <label class="control-label" for="file">
                                {{ trans('reforms.labels.file') }} <span class="text-danger">*</span>
                            </label>
                            <input type="file" name="file" id="file" required
                                   class="form-control" accept="application/pdf" data-rule-required="true"
                                   data-msg-accept="{{ trans('files.messages.validation.file_extension') }}"/>
                        </div>
                    @elseif($entity->estado == $ReformRepository::OPERATION_STATE_APPROVED_3 && isset($file))
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">

                            <label class="control-label" for="file">
                                {{ trans('reforms.labels.file') }}:
                            </label>
                            <a href="{{ route('download.show.reforms.reforms_reprogramming.execution', ['name' => $file->name]) }}" class="h4">
                                <i class="fa fa-download text-success"></i> {{ $file->name }}
                            </a>
                        </div>
                    @endif
                    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                        <label class="control-label" for="description">
                            {{ trans('reforms.labels.description') }}
                        </label>
                        <textarea type="text" class="form-control" readonly id="description">{{ $entity->des_cab }}</textarea>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12" id="new_reform_context">
                    <fieldset>
                        <legend class="scheduler-border text-center">
                            <i class="fa fa-money"></i> {{ trans('reforms.labels.details') }}
                        </legend>
                        <div class="alert alert-warning" role="alert" data-bind="visible: showMsjBalance">
                            {{ trans('reforms.messages.exceptions.balance') }}
                        </div>
                        <div class="alert alert-warning" role="alert" data-bind="visible: showMsjBalanceDisapproved">
                            {{ trans('reforms.messages.exceptions.balance_disapproved') }}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="budget_items_detail_tb">
                                    <thead>
                                    <tr>
                                        <th class="w-30">{{ trans('reforms.labels.item') }}</th>
                                        <th class="w-30">{{ trans('reforms.labels.description') }}</th>
                                        <th class="w-10">{{ trans('reforms.labels.balance') }}</th>
                                        <th class="w-10">{{ trans('reforms.labels.increase') }}</th>
                                        <th class="w-10">{{ trans('reforms.labels.decrease') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="h-0 bg-green fw-b text-center" data-bind="visible: incomeItems().length">
                                        <td colspan="5">{{ trans('reforms.labels.budget_type_income') }}</td>
                                    </tr>
                                    <!-- ko foreach: incomeItems -->
                                    <tr data-bind="css: fontColor">
                                        <td data-bind="text: cuenta"></td>
                                        <td data-bind="text: nom_cue"></td>
                                        <td data-bind="text: balance" class="text-center"></td>
                                        <td data-bind="text: val_deb" class="text-center"></td>
                                        <td data-bind="text: val_cre" class="text-center"></td>
                                    </tr>
                                    <!-- /ko -->

                                    <tr data-bind="css: subTotalIncomeBg, visible: (incomeItems().length && reformType() == '{{ $ReformRepository::REFORMS_TYPE_TRANSFER_0 }}')"
                                        class="fw-b">
                                        <td class="text-right" colspan="3">{{ trans('reforms.labels.sub_total_income') }}</td>
                                        <td class="text-center" data-bind="text: subTotalIncreaseIncome"></td>
                                        <td class="text-center" data-bind="text: subTotalDecreaseIncome"></td>
                                    </tr>

                                    <tr class="h-0 bg-green fw-b text-center" data-bind="visible: expenseItems().length">
                                        <td colspan="5">{{ trans('reforms.labels.budget_type_expense') }}</td>
                                    </tr>
                                    <!-- ko foreach: expenseItems -->
                                    <tr data-bind="css: fontColor">
                                        <td data-bind="text: cuenta"></td>
                                        <td data-bind="text: nom_cue"></td>
                                        <td data-bind="text: balance" class="text-center"></td>
                                        <td data-bind="text: val_deb" class="text-center"></td>
                                        <td data-bind="text: val_cre" class="text-center"></td>
                                    </tr>
                                    <!-- /ko -->

                                    <tr data-bind="css: subTotalExpenseBg, visible: (expenseItems().length && reformType() == '{{ $ReformRepository::REFORMS_TYPE_TRANSFER_0 }}')"
                                        class="fw-b">
                                        <td class="text-right" colspan="3">{{ trans('reforms.labels.sub_total_expense') }}</td>
                                        <td class="text-center" data-bind="text: subTotalIncreaseExpense"></td>
                                        <td class="text-center" data-bind="text: subTotalDecreaseExpense"></td>
                                    </tr>

                                    <tr data-bind="css: totalBg" class="fw-b">
                                        <td class="text-right" colspan="3">{{ trans('app.labels.footer_total') }}</td>
                                        <td class="text-center" data-bind="text: totalIncrease"></td>
                                        <td class="text-center" data-bind="text: totalDecrease"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer text-center">
        <button data-dismiss="modal" class="btn btn-info">
            <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
        </button>
        @if($entity->estado == $ReformRepository::OPERATION_STATE_SQUARE_2)
            <button class="btn btn-success" id="approve_btn">
                <i class="fa fa-save"></i> {{ trans('app.labels.approve') }}
            </button>
        @endif
        @if($entity->estado == $ReformRepository::OPERATION_STATE_APPROVED_3)
            <button class="btn btn-danger" id="disapprove_btn">
                <i class="fa fa-thumbs-down"></i> {{ trans('reforms.labels.disapprove') }}
            </button>
        @endif
    </div>
</div>

<script>
    $(() => {

        let reforms_tb = $('#reforms_tb').DataTable();

        $('#disapprove_btn').on('click', () => {
            pushRequest('{{ route('disapprove.show.reforms.reforms_reprogramming.execution', [
            'companyCode' => $entity->codemp, 'year' => $entity->anio, 'operationType' => $entity->sig_tip, 'operationNumber' => $entity->acu_tip ]) }}', null, (response) => {
                if (!response.success) {
                    if (response.items && response.items.length > 0) {
                        vm.showMsjBalanceDisapproved(true);
                        $.each(response.items, (index, value) => {
                            vm.incomeItems().forEach((item) => {
                                if (item.cuenta() === value.cuenta) {
                                    item.balance(value.balance);
                                    item.to_disapprove(true);
                                    item.to_disapprove.notifySubscribers();
                                }
                            });

                            vm.expenseItems().forEach((item) => {
                                if (item.cuenta() === value.cuenta) {
                                    item.balance(value.balance);
                                    item.to_disapprove(true);
                                    item.to_disapprove.notifySubscribers();
                                }
                            });
                        });
                    }
                } else {
                    $modal_xl.modal('hide');
                    reforms_tb.draw();
                }
            }, 'get');
        });

        $('#approve_btn').on('click', () => {
            if (date_fm.valid()) {
                date_fm.submit();
            }
        });

        $('.picker').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'es-es',
            ignoreReadonly: true,
            minDate: moment('{{ $minDate }}', 'YYYY-MM-DD'),
            maxDate: moment('{{ $maxDate }}', 'YYYY-MM-DD')
        });

        $('.show-picker').on('click', () => {
            $('#approved_date').datetimepicker('show');
        });

        let date_fm = $('#date_fm');
        date_fm.validate($validateDefaults);
        date_fm.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    if (!response.success) {
                        if (response.items && response.items.length > 0) {
                            vm.showMsjBalance(true);
                            $.each(response.items, (index, value) => {
                                vm.incomeItems().forEach((item) => {
                                    if (item.cuenta() === value.cuenta) {
                                        item.balance(value.balance);
                                    }
                                });

                                vm.expenseItems().forEach((item) => {
                                    if (item.cuenta() === value.cuenta) {
                                        item.balance(value.balance);
                                    }
                                });
                            });
                        }
                    } else {
                        $modal_xl.modal('hide');
                        reforms_tb.draw();
                    }
                });
            }
        }));

        class BudgetItem {
            constructor(cuenta, nom_cue, asociac, sec_det, val_deb, val_cre, balance) {
                this.cuenta = ko.observable(cuenta);
                this.nom_cue = ko.observable(nom_cue);
                this.val_deb = ko.observable(val_deb || 0);
                this.val_cre = ko.observable(val_cre || 0);
                this.asociac = ko.observable(asociac);
                this.sec_det = sec_det;
                this.balance = ko.observable(balance);
                this.to_disapprove = ko.observable(false);

                this.fontColor = ko.pureComputed(() => {

                    this.to_disapprove();
                    if ('{{ $entity->estado }}' == '{{ $ReformRepository::OPERATION_STATE_DRAFT_1 }}') {
                        return '';
                    }
                    if ('{{ $entity->estado }}' == '{{ $ReformRepository::OPERATION_STATE_SQUARE_2 }}') {
                        if ('{{ $entity->incremen }}' === '{{ $ReformRepository::REFORMS_TYPE_TRANSFER_0 }}') {
                            if (this.val_cre() > 0 && (this.balance() - this.val_cre()) < 0) {
                                vm.showMsjBalance(true);
                                return 'text-danger fw-b';
                            }
                        } else if ('{{ $entity->incremen }}' === '{{ $ReformRepository::REFORMS_TYPE_DECREASE_2 }}') {
                            if (this.asociac() == '{{ $ReformRepository::BUDGET_ITEM_INCOME }}') {
                                if (Math.abs(this.val_deb()) > 0 && (this.balance() - Math.abs(this.val_deb())) < 0) {
                                    vm.showMsjBalance(true);
                                    return 'text-danger fw-b';
                                }
                            }
                        }
                    }

                    if ('{{ $entity->estado }}' == '{{ $ReformRepository::OPERATION_STATE_APPROVED_3 }}' && this.to_disapprove()) {
                        if ('{{ $entity->incremen }}' === '{{ $ReformRepository::REFORMS_TYPE_TRANSFER_0 }}') {
                            if (this.val_deb() > 0 && (this.balance() - this.val_deb()) < 0) {
                                vm.showMsjBalanceDisapproved(true);
                                return 'text-danger fw-b';
                            }
                        } else if ('{{ $entity->incremen }}' === '{{ $ReformRepository::REFORMS_TYPE_INCREASE_1 }}') {
                            if (this.val_deb() > 0 && (this.balance() - this.val_deb()) < 0) {
                                vm.showMsjBalanceDisapproved(true);
                                return 'text-danger fw-b';
                            }
                        }
                    }

                    return '';
                });
            }
        }

        class ViewModel {
            constructor() {
                this.showMsjBalance = ko.observable(false);
                this.showMsjBalanceDisapproved = ko.observable(false);
                this.reformType = ko.observable('{{ $entity->incremen }}');
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

                this.initItems = (item) => {
                    if ('{{ $entity->incremen }}' === '{{ $ReformRepository::REFORMS_TYPE_INCREASE_1 }}') {
                        if (item.asociac == '{{ $ReformRepository::BUDGET_ITEM_EXPENSE }}') { // 1 - budget type expense
                            this.expenseItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.sec_det,
                                0.00,
                                parseFloat(item.val_deb).toFixed(2),
                                parseFloat(item.balance).toFixed(2)));

                        } else {// 2 - budget type income
                            this.incomeItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.sec_det,
                                parseFloat(item.val_deb).toFixed(2),
                                0.00,
                                parseFloat(item.balance).toFixed(2))
                            );
                        }
                    } else if ('{{ $entity->incremen }}' === '{{ $ReformRepository::REFORMS_TYPE_DECREASE_2 }}') {
                        if (item.asociac == '{{ $ReformRepository::BUDGET_ITEM_EXPENSE }}') { // 1 - budget type expense
                            this.expenseItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.sec_det,
                                0.00,
                                Math.abs(parseFloat(item.val_deb)).toFixed(2),
                                parseFloat(item.balance).toFixed(2)));

                        } else {// 2 - budget type income
                            this.incomeItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.sec_det,
                                Math.abs(parseFloat(item.val_deb)).toFixed(2),
                                0.00,
                                parseFloat(item.balance).toFixed(2))
                            );
                        }
                    } else {
                        if (item.asociac == '{{ $ReformRepository::BUDGET_ITEM_EXPENSE }}') { // 1 - budget type expense
                            this.expenseItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.sec_det,
                                parseFloat(item.val_deb).toFixed(2),
                                parseFloat(item.val_cre).toFixed(2),
                                parseFloat(item.balance).toFixed(2)));

                        } else {// 2 - budget type income
                            this.incomeItems.push(new BudgetItem(
                                item.cuenta,
                                item.nom_cue,
                                item.asociac,
                                item.sec_det,
                                parseFloat(item.val_deb).toFixed(2),
                                parseFloat(item.val_cre).toFixed(2),
                                parseFloat(item.balance).toFixed(2)));
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
            }
        }

        let vm = new ViewModel();
        ko.applyBindings(vm, document.getElementById('new_reform_context'));

        let reformDetails = $.parseJSON('{!! str_replace("\u0022", "\\\\\"", json_encode($entity->details, JSON_HEX_APOS | JSON_HEX_QUOT)) !!}'
            .replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));

        $.each(reformDetails, (index, value) => {
            vm.initItems(value);
        });

    })
</script>

@else
    @include('errors.403')
    @endpermission