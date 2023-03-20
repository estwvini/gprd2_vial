@inject('AdminActivity', 'App\Models\Business\AdminActivity' )
@inject('ActivityType', 'App\Models\Business\Catalogs\ActivityType' )

<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus green"></i> {{ trans('admin_activities.labels.new') }}</h4>
    </div>
    <div class="modal-body">
        <form role="form" action="#" class="form-label-left" id="create_activity" novalidate>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" for="name">
                    {{ trans('app.headers.name') }} <span class="required text-danger">*</span>
                </label>
                <input type="text" id="name" name="name" maxlength="200" placeholder="{{ trans('admin_activities.placeholders.name') }}" autocomplete="off"
                       class="form-control" value=""/>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                <label class="control-label" for="assigned_user_id">
                    {{ trans('admin_activities.labels.assigned') }} <span class="required text-danger">*</span>
                </label>
                <select class="form-control select22" id="assigned_user_id" name="assigned_user_id" required>
                    @if (count($users) > 1)
                        <option value=""></option>
                    @endif
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3 col-sm-12 col-xs-12 mb-5">
                <label class="control-label" for="status">
                    {{ trans('admin_activities.labels.status') }} <span class="required text-danger">*</span>
                </label>
                <select class="form-control select22" id="status" name="status">
                    @foreach($AdminActivity::STATUS as $status)
                        <option value="{{ $status }}"></option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3 col-sm-12 col-xs-12 mb-5">
                <label class="control-label" for="priority">
                    {{ trans('admin_activities.labels.priority') }} <span class="required text-danger">*</span>
                </label>
                <select class="form-control select22" id="priority" name="priority">
                    @foreach($AdminActivity::PRIORITIES as $priority)
                        <option value="{{ $priority }}" @if($priority == $AdminActivity::PRIORITY_MEDIUM) selected @endif></option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" for="activity_type_id">
                    {{ trans('admin_activities.labels.activity_type') }} <span class="required text-danger">*</span>
                </label>
                <select class="form-control select22" id="activity_type_id" name="activity_type_id">
                    <option value=""></option>
                    @foreach($ActivityType::all() as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group has-feedback col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <label class="control-label" for="date_init">
                    {{ trans('admin_activities.labels.date_init') }}
                </label>
                <input name="date_init" id="date_init"
                       class="form-control has-feedback-left readonly-white"
                       placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <label class="control-label" for="date_end">
                    {{ trans('admin_activities.labels.date_end') }}
                </label>
                <input name="date_init" id="date_end"
                       class="form-control has-feedback-left readonly-white"
                       placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label class="control-label" for="frequency">
                    {{ trans('admin_activities.labels.frequency') }}
                </label>
                <br>
                <select class="" id="frequency_number" name="frequency_number" style="display: none">
                    @for ($i = 1; $i < 30; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <select class="" id="frequency" name="frequency">
                    <option value="0" selected>{{ trans('admin_activities.labels.never') }}</option>
                    @foreach($AdminActivity::FREQUENCIES as $freq)
                        <option value="{{ $freq }}">{{ trans('admin_activities.labels.frequency_' . $freq) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group has-feedback col-lg-3 col-md-3 col-sm-3 col-xs-12" style="display: none" id="frequency_limit_wrapper">
                <label class="control-label" for="frequency_limit">
                    {{ trans('admin_activities.labels.frequency_limit') }}
                </label>
                <input name="frequency_limit" id="frequency_limit"
                       class="form-control has-feedback-left readonly-white"
                       placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" for="description">
                    {{ trans('admin_activities.labels.description') }}
                </label>
                <textarea type="text" id="description" name="description" placeholder="{{ trans('admin_activities.placeholders.description') }}" autocomplete="off"
                          class="form-control" rows="3"></textarea>
            </div>

            <div id="check-list-context" class="col-md-12 col-sm-12 col-xs-12">
                <label>
                    <span style="">{{ trans('admin_activities.labels.check_list') }} </span>
                    <span data-bind="text: countCompleted()"></span>
                </label>
                <div class="check-list-wrapper">
                    <ul>
                        <!-- ko foreach: listItems -->
                        <li class="check-list-item">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" data-bind="iCheck: completed">
                                    </label>
                                </div>
                                <span class="check-list-item-title"
                                      data-bind="text: name, css: { isChecked: completed }, visible: !editing(), click: $root.eventClickEdit"></span>
                                <div class="check-list-item-title" data-bind=" visible: editing">
                                    <input type="text" data-bind="textInput: name, hasFocus: editing, event: { keyup: $root.editListItem }" class="text-border-less"
                                           maxlength="120">
                                </div>
                                <div class="check-list-trash">
                                    <span title="Quitar elemento de la lista de comprobación" data-bind="click: $root.removeItem">
                                        <i class="fa fa-trash red"></i>
                                    </span>
                                </div>
                            </div>
                        </li>
                        <!-- /ko -->
                        <li class="check-list-item">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="flat" disabled>
                                    </label>
                                </div>
                                <div class="check-list-item-title">
                                    <input type="text" data-bind="textInput: newListItem, event: { keyup: addNewListItem }" class="text-border-less"
                                           placeholder="Agregar un elemento" maxlength="120" value="">
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </form>
    </div>

    <div class="modal-footer">
        <button class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
        <button id="save_btn" type="button" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
    </div>
</div>

<script>
    $(() => {

        const formatStatus = (status) => {

            switch (status.id) {
                case '{{ $AdminActivity::STATUS_DRAFT }}':
                    return $("<span><i class='fa fa-circle-o'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_DRAFT) }}</span>");
                case '{{$AdminActivity::STATUS_IN_PROGRESS}}':
                    return $("<span><i class='color-blue fa fa-adjust fa-rotate-90'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_IN_PROGRESS) }}</span>");
                case '{{$AdminActivity::STATUS_COMPLETED}}':
                    return $("<span><i class='green fa fa-check-circle'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_COMPLETED) }}</span>");
            }
        };

        const formatPriority = (priority) => {

            switch (priority.id) {
                case '{{$AdminActivity::PRIORITY_URGENT}}':
                    return $("<span><i class='red fa fa-bell w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . $AdminActivity::PRIORITY_URGENT) }}</span>");
                case '{{$AdminActivity::PRIORITY_IMPORTANT}}':
                    return $("<span><i class='red fa fa-exclamation w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . $AdminActivity::PRIORITY_IMPORTANT) }}</span>");
                case '{{$AdminActivity::PRIORITY_MEDIUM}}':
                    return $("<span><i class='green fa fa-minus w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . $AdminActivity::PRIORITY_MEDIUM) }}</span>");
                case '{{ $AdminActivity::PRIORITY_LOW }}':
                    return $("<span><i class='color-blue fa fa-long-arrow-down w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . $AdminActivity::PRIORITY_LOW) }}</span>");
            }
        };

        $('.select22').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            dropdownParent: $("#myModal")
        });

        $('#status').select2({
            minimumResultsForSearch: -1,
            templateSelection: formatStatus,
            templateResult: formatStatus
        });

        $('#priority').select2({
            minimumResultsForSearch: -1,
            templateSelection: formatPriority,
            templateResult: formatPriority
        });

        $('#frequency').on('change', () => {
            if ($('#frequency').val() !== '0') {
                $('#frequency_number').show();
                $('#frequency_limit_wrapper').show();
                $('#frequency_limit', $form).rules("add", "required");

                $('#date_end').val($('#date_init').val());
                $('#date_end').prop('disabled', true);

            } else {
                $('#frequency_number').hide();
                $('#frequency_limit_wrapper').hide();
                $("#frequency_limit", $form).rules("remove", "required");
                $('#date_end').prop('disabled', false);
            }
        })

        // Add datetimepicker
        $('#date_init, #date_end').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            useCurrent: false,
            ignoreReadonly: true,
            minDate: moment('{{ $minDate }}', 'DD-MM-YYYY').millisecond(0).second(0).minute(0).hour(0),
            maxDate: moment('{{ $maxDate }}', 'DD-MM-YYYY').millisecond(0).second(59).minute(59).hour(23)
        });

        $('#frequency_limit').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            useCurrent: true,
            ignoreReadonly: true,
            minDate: moment(),
            maxDate: moment('{{ $maxDate }}', 'DD-MM-YYYY').millisecond(0).second(59).minute(59).hour(23)
        });


        $(`#date_init, #date_end`).on('dp.hide', (e) => {
            setTimeout(() => {
                $(e.currentTarget).data('DateTimePicker').viewDate(moment('{{ $minDate }}', 'DD-MM-YYYY').millisecond(0).second(0).minute(0).hour(0))
            }, 1);
        });

        $('#date_init').on('dp.change', (e) => {
            $('#date_end').data('DateTimePicker').minDate(e.date)
            if ($('#frequency').val() !== '0') {
                $('#date_end').val($('#date_init').val());
            }
        });

        $('#date_end').on('dp.change', (e) => {
            $('#date_init').data('DateTimePicker').maxDate(e.date)
        });


        var ListItem = function () {
            this.name = ko.observable('');
            this.completed = ko.observable(false);
            this.editing = ko.observable(false);
        };

        var viewModel = function () {
            var self = this;
            self.listItems = ko.observableArray([]);
            self.newListItem = ko.observable('');

            self.countCompleted = ko.computed(() => {
                return self.listItems().filter(item => item.completed()).length + ' / ' + self.listItems().length;
            });

            self.addNewListItem = (data, event) => {
                if (event.which === 13 && self.newListItem().trim() !== '') {
                    var item = new ListItem();
                    item.name(self.newListItem().trim());
                    item.completed(false);
                    vm.listItems.push(item);
                    self.newListItem('');
                }
                return true;
            }

            self.editListItem = (data, event) => {
                if (event.which === 13 && data.name().trim() !== '') {
                    data.editing(false);
                }
                return true;
            }

            self.eventClickEdit = (data) => {
                data.editing(true);
            }

            self.removeItem = (data) => {
                self.listItems.remove(data);
            }
        }

        var vm = new viewModel();

        ko.bindingHandlers.iCheck = {
            init: function (element, valueAccessor) {
                $(element).iCheck({
                    checkboxClass: "icheckbox_flat-green"
                });

                $(element).on('ifChanged', function () {
                    var observable = valueAccessor();
                    observable($(element)[0].checked);
                });
            },
            update: function (element, valueAccessor) {
                var value = ko.unwrap(valueAccessor());
                if (value) {
                    $(element).iCheck('check');
                } else {
                    $(element).iCheck('uncheck');
                }
            }
        };

        ko.applyBindings(vm, document.getElementById('check-list-context'));

        let $form = $('#create_activity');

        $form.validate($.extend(false, $validateDefaults, {
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 200
                },
                assigned_user_id: {
                    required: true
                },
                activity_type_id: {
                    required: true
                }
            }
        }));

        let activities_tb = $('#activities_tb').DataTable();

        $form.validate($validateDefaults);

        $('#save_btn').on('click', () => {
            if ($form.valid()) {
                pushRequest('{{ route('store.create.admin_activities.execution') }}', '#calendar-view', () => {
                    $modal.modal('hide');
                    activities_tb.draw();
                    $('.md.nav-tabs a[href="#table"]').tab('show');
                }, 'post', {
                    _token: '{{ csrf_token() }}',
                    activity: {
                        name: $('#name').val(),
                        assigned_user_id: $('#assigned_user_id').val(),
                        status: $('#status').val(),
                        priority: $('#priority').val(),
                        date_init: $('#date_init').val(),
                        date_end: $('#date_end').val(),
                        description: $('#description').val(),
                        activity_type_id: $('#activity_type_id').val(),
                        check_list: JSON.stringify(ko.toJS(vm.listItems)),
                        frequency: $('#frequency').val(),
                        frequency_number: $('#frequency_number').val(),
                        frequency_limit: $('#frequency_limit').val()
                    }
                });
            }
        });

    });
</script>