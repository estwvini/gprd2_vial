<div class="x_panel shadow">
    <div class="x_title">
        <h2 class="text-primary"><i class="fa fa-edit color-blue"></i> {{ trans('staff_meetings.labels.edit') }}
        </h2>
        <ul class="nav navbar-right panel_toolbox">
            <li style="float: right">
                <span style="font-size: smaller; color: #FFFFFF !important;"
                      class="badge badge-{{ \App\Models\Business\StaffActivity::STATUS_BG[$activity->status] }}">{{ $activity->status }}</span>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form role="form" class="form-label-left" id="create_activity">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" for="name">
                    {{ trans('app.headers.name') }} <span class="required text-danger">*</span>
                </label>
                <input type="text" id="name" name="name" maxlength="120" autocomplete="off"
                       class="form-control" value="{{ $activity->name }}"/>
            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" for="institutions">
                    {{ trans('staff_meetings.labels.beneficiaries') }}
                </label>
                <select class="form-control" id="institutions" name="institutions[]" multiple>
                    <option value=""></option>
                    @foreach($institutions as $inst)
                        <option value="{{ $inst->id }}" @if($activity->institutions->contains($inst->id)) selected @endif>{{ $inst->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group has-feedback col-md-6 col-sm-12 col-xs-12">
                <label class="control-label" for="date_end">
                    {{ trans('staff_meetings.labels.date_end') }}
                </label>
                <input name="date_init" id="date_end" value="{{ $activity->date_end }}"
                       class="form-control has-feedback-left readonly-white"
                       placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                <label class="control-label" for="scope">
                    {{ trans('staff_meetings.labels.scope') }}
                </label>
                <select class="form-control" id="scope" name="scope">
                    <option value="">{{ trans('app.labels.select') }}</option>
                    @foreach(\App\Models\Business\StaffActivity::SCOPES as $scope)
                        <option value="{{ $scope }}" @if($activity->scope == $scope) selected @endif>{{ $scope }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label class="control-label" for="requires_media_coverage">
                    {{ trans('staff_meetings.labels.requires_media_coverage') }}
                </label>
                <div>
                    <input type="checkbox" class="flat" name="requires_media_coverage" id="requires_media_coverage" @if($activity->requires_media_coverage) checked @endif>
                </div>
            </div>

            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label class="control-label" for="is_public_purchase">
                    {{ trans('staff_meetings.labels.is_public_purchase') }}
                </label>
                <div>
                    <input type="checkbox" class="flat" name="is_public_purchase" id="is_public_purchase" @if($activity->is_public_purchase) checked @endif>
                </div>
            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="false"
                           aria-controls="collapseOne">
                            <h4 class="panel-title"><i class="fa fa-bell text-danger"></i>
                                {{ trans('staff_meetings.labels.alert_activities') }} <span>(<span id="alert_count">{{ count($activity->alerts ?? []) }}</span>)</span></h4>
                        </a>
                        <div id="collapseOne1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="">
                            <div class="panel-body">
                                @include('business.staff_meetings.alert')
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false"
                           aria-controls="collapseTwo">
                            <h4 class="panel-title"><i class="fa fa-refresh text-primary"></i>
                                {{ trans('staff_meetings.labels.coordination_activities') }}
                                <span>(<span id="coordination_count">{{ count($activity->coordinations ?? [] ) }}</span>)</span></h4>
                        </a>
                        <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                @include('business.staff_meetings.coordination')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <h4>{{ trans('staff_meetings.labels.related_task_admin') }}</h4>
            </div>

            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label" for="project">
                    {{ trans('admin_activities.labels.assigned') }}
                </label>
                <select class="form-control select2" id="user">
                    <option value=0>{{ trans('app.labels.all') }}</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fullName() }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label" for="status">
                    {{ trans('admin_activities.labels.status') }}
                </label>
                <select class="form-control select2" id="status">
                    <option value="0"></option>
                    @foreach(\App\Models\Business\AdminActivity::STATUS as $status)
                        <option value="{{ $status }}" @if($status == \App\Models\Business\AdminActivity::STATUS_DRAFT) selected @endif></option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label" for="priority">
                    {{ trans('admin_activities.labels.priority') }}
                </label>
                <select class="form-control select2" id="priority">
                    <option value="0"></option>
                    @foreach(\App\Models\Business\AdminActivity::PRIORITIES as $priority)
                        <option value="{{ $priority }}" @if($priority == \App\Models\Business\AdminActivity::PRIORITY_URGENT) selected @endif></option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" for="adminActivities">
                    {{ trans('admin_activities.labels.activity') }}
                </label>
                <div class="check-list-wrapper" id="adminActivities">
                    <ul class="to_do">
                        <!-- ko foreach: adminActivities() -->
                        <li class="check-list-item">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" data-bind="iCheck: selected">
                                    </label>
                                </div>
                                <div class="check-list-item-title" style="line-height: normal">
                                    <div class="mb-3">
                                        <span data-bind="text: name" class="fw-b"></span>
                                    </div>
                                    <div>
                                        <span class="fs-sm fw-b">{{ trans('app.headers.date_init') }}:</span> <span data-bind="text: dateInit" class="mr-3 fs-sm"></span>
                                        <span class="fs-sm fw-b">{{ trans('app.headers.date_end') }}:</span> <span data-bind="text: dateEnd" class="mr-3 fs-sm"></span>
                                        <span><i data-bind="class: cssPriority"></i></span> <span class="fs-sm fw-b" data-bind="text: priorityName"></span>
                                    </div>
                                </div>
                                <div>
                                    <span class="fs-25"><i data-bind="class: cssStatus"></i></span>
                                </div>
                            </div>
                        </li>
                        <!-- /ko -->
                    </ul>
                </div>
            </div>

            <div class="form-group row">
            </div>

            <div class="ln_solid"></div>

            <div class="form-group row pull-right">
                <div class="col-md-12">
                    <button class="btn btn-info"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                    <button id="save_btn" type="button" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(() => {

        var AdminActivity = function () {
            this.id = '';
            this.name = '';
            this.status = ko.observable('');
            this.priority = ko.observable('');
            this.dateInit = '';
            this.dateEnd = '';
            this.selected = ko.observable(false);

            this.cssStatus = ko.computed(() => {
                switch (this.status()) {
                    case '{{ \App\Models\Business\AdminActivity::STATUS_DRAFT }}':
                        return 'fa fa-circle-o';
                    case '{{ \App\Models\Business\AdminActivity::STATUS_IN_PROGRESS }}':
                        return 'color-blue fa fa-adjust fa-rotate-90';
                    case '{{ \App\Models\Business\AdminActivity::STATUS_COMPLETED }}':
                        return 'green fa fa-check-circle';
                }
                return '';
            });

            this.cssPriority = ko.computed(() => {
                switch (this.priority()) {
                    case '{{ \App\Models\Business\AdminActivity::PRIORITY_LOW }}':
                        return 'color-blue fa fa-long-arrow-down';
                    case '{{ \App\Models\Business\AdminActivity::PRIORITY_IMPORTANT }}':
                        return 'red fa fa-exclamation';
                    case '{{ \App\Models\Business\AdminActivity::PRIORITY_MEDIUM }}':
                        return 'green fa fa-minus';
                    case '{{ \App\Models\Business\AdminActivity::PRIORITY_URGENT }}':
                        return 'red fa fa-bell';

                }
                return '';
            });

            this.priorityName = ko.computed(() => {
                switch (this.priority()) {
                    case '{{ \App\Models\Business\AdminActivity::PRIORITY_LOW }}':
                        return '{{ trans('admin_activities.labels.priority_' . \App\Models\Business\AdminActivity::PRIORITY_LOW) }}';
                    case '{{ \App\Models\Business\AdminActivity::PRIORITY_IMPORTANT }}':
                        return '{{ trans('admin_activities.labels.priority_' . \App\Models\Business\AdminActivity::PRIORITY_IMPORTANT) }}';
                    case '{{ \App\Models\Business\AdminActivity::PRIORITY_MEDIUM }}':
                        return '{{ trans('admin_activities.labels.priority_' . \App\Models\Business\AdminActivity::PRIORITY_MEDIUM) }}';
                    case '{{ \App\Models\Business\AdminActivity::PRIORITY_URGENT }}':
                        return '{{ trans('admin_activities.labels.priority_' . \App\Models\Business\AdminActivity::PRIORITY_URGENT) }}';

                }
                return '';
            });
        };

        var viewModel = function () {
            var self = this;
            self.adminActivities = ko.observableArray([]);

            self.selectedTasks = ko.computed(() => {
                return self.adminActivities().filter(item => item.selected()).map(item => item.id);
            });
        }

        var vm = new viewModel();

        let adminActivities = JSON.parse('{!! str_replace("\u0022", "\\\\\"", json_encode($activity->activitiesRelated, JSON_HEX_APOS | JSON_HEX_QUOT)) !!}'
            .replace(/\n/g, "\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t").replace(/\\/g, "\\\\"));

        $.each(adminActivities, (index, value) => {

            if (value.relatable_type === String.raw`{{ \App\Models\Business\AdminActivity::class }}`) {
                let item = new AdminActivity();
                item.id = value.relatable.id;
                item.name = value.relatable.name;
                item.status(value.relatable.status);
                item.priority(value.relatable.priority);
                item.dateInit = value.relatable.date_init ? value.relatable.date_init : 'N/A';
                item.dateEnd = value.relatable.date_end ? value.relatable.date_end : 'N/A';
                item.selected(true)
                vm.adminActivities.push(item);
            }

        });

        ko.bindingHandlers.iCheck = {
            init: function (element, valueAccessor, allBindings, viewModel) {
                $(element).iCheck({
                    checkboxClass: "icheckbox_flat-green"
                });
                $(element).on('ifChanged', function () {
                    let observable = valueAccessor();
                    observable($(element)[0].checked);
                });
            },
            update: function (element, valueAccessor) {
                let value = ko.unwrap(valueAccessor());
                if (value) {
                    $(element).iCheck('check');
                } else {
                    $(element).iCheck('uncheck');
                }
            }
        };

        ko.applyBindings(vm, document.getElementById('adminActivities'));

        const formatStatus = (status) => {

            switch (status.id) {
                case '{{ \App\Models\Business\AdminActivity::STATUS_DRAFT }}':
                    return $("<span><i class='fa fa-circle-o'></i> {{ trans('admin_activities.labels.status_' . \App\Models\Business\AdminActivity::STATUS_DRAFT) }}</span>");
                case '{{\App\Models\Business\AdminActivity::STATUS_IN_PROGRESS}}':
                    return $("<span><i class='color-blue fa fa-adjust fa-rotate-90'></i> {{ trans('admin_activities.labels.status_' . \App\Models\Business\AdminActivity::STATUS_IN_PROGRESS) }}</span>");
                case '{{\App\Models\Business\AdminActivity::STATUS_COMPLETED}}':
                    return $("<span><i class='green fa fa-check-circle'></i> {{ trans('admin_activities.labels.status_' . \App\Models\Business\AdminActivity::STATUS_COMPLETED) }}</span>");
                case '0':
                    return $("<span><i class='color-blue fa fa-tasks w-10 text-center'></i> {{ trans('app.labels.all') }}</span>");
            }
        };

        const formatPriority = (priority) => {

            switch (priority.id) {
                case '{{\App\Models\Business\AdminActivity::PRIORITY_URGENT}}':
                    return $("<span><i class='red fa fa-bell w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . \App\Models\Business\AdminActivity::PRIORITY_URGENT) }}</span>");
                case '{{\App\Models\Business\AdminActivity::PRIORITY_IMPORTANT}}':
                    return $("<span><i class='red fa fa-exclamation w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . \App\Models\Business\AdminActivity::PRIORITY_IMPORTANT) }}</span>");
                case '{{\App\Models\Business\AdminActivity::PRIORITY_MEDIUM}}':
                    return $("<span><i class='green fa fa-minus w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . \App\Models\Business\AdminActivity::PRIORITY_MEDIUM) }}</span>");
                case '{{ \App\Models\Business\AdminActivity::PRIORITY_LOW }}':
                    return $("<span><i class='color-blue fa fa-long-arrow-down w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . \App\Models\Business\AdminActivity::PRIORITY_LOW) }}</span>");
                case '0':
                    return $("<span><i class='color-blue fa fa-tasks w-10 text-center'></i> {{ trans('app.labels.all') }}</span>");
            }
        };

        $('#status').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            minimumResultsForSearch: -1,
            templateSelection: formatStatus,
            templateResult: formatStatus
        }).on('change', (e) => {
            filter();
        });

        $('#priority').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            minimumResultsForSearch: -1,
            templateSelection: formatPriority,
            templateResult: formatPriority
        }).on('change', (e) => {
            filter();
        });

        $('#user').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
        }).on('change', (e) => {
            filter();
        });

        $("#institutions").select2({
            placeholder: '{{ trans('app.labels.select') }}',
            multiple: true
        });

        $('#date_end').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'es-es',
            useCurrent: false,
            ignoreReadonly: true,
            minDate: moment('{{ $activity->meeting->start }}', 'YYYY-MM-DD').millisecond(0).second(0).minute(0).hour(0),
            maxDate: moment('{{ $activity->meeting->end }}', 'YYYY-MM-DD').millisecond(0).second(59).minute(59).hour(23)
        });

        let filter = () => {
            pushRequest('{{ route('search.activity.staff') }}', null, (response) => {
                vm.adminActivities.remove((item) => !item.selected());
                $.each(response, (index, value) => {
                    let item = new AdminActivity();
                    item.id = value.id;
                    item.name = value.name;
                    item.status(value.status);
                    item.priority(value.priority);
                    item.dateInit = value.date_init ? value.date_init : 'N/A';
                    item.dateEnd = value.date_end ? value.date_end : 'N/A';
                    let actExist = ko.utils.arrayFirst(vm.adminActivities(), function (act) {
                        return act.id === item.id;
                    });
                    if (!actExist) {
                        vm.adminActivities.push(item);
                    }
                });

            }, 'get', {
                'type': 2,
                'userId': $('#user').val() !== '0' ? $('#user').val() : '',
                'status': $('#status').val() !== '0' ? $('#status').val() : '',
                'priority': $('#priority').val() !== '0' ? $('#priority').val() : '',
            }, false)
        };
        filter();

        let $form = $('#create_activity');

        $form.validate($.extend(false, $validateDefaults, {
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 120
                }
            }
        }));

        $form.validate($validateDefaults);

        $('#save_btn').on('click', () => {
            if ($form.valid()) {
                pushRequest('{{ route('update.activity.staff', $activity->id) }}', null, () => {
                    $modal.modal('hide');
                }, 'put', {
                    _token: '{{ csrf_token() }}',
                    name: $('#name').val(),
                    institutions: $('#institutions').val(),
                    date_end: $('#date_end').val(),
                    scope: $('#scope').val(),
                    requires_media_coverage: $('#requires_media_coverage')[0].checked ? 1 : 0,
                    is_public_purchase: $('#is_public_purchase')[0].checked ? 1 : 0,
                    tasks: vm.selectedTasks(),
                    relatable_type: String.raw`{{ \App\Models\Business\AdminActivity::class }}`,
                    redirect: 1,
                }, false);
            }
        });
    });
</script>
