@inject('AdminActivity', 'App\Models\Business\AdminActivity' )
@inject('ActivityType', 'App\Models\Business\Catalogs\ActivityType' )
@inject('Reason', 'App\Models\Business\Catalogs\Reason' )

<div class="modal-content" id="myModal">
    <div class="modal-header">
        <div class="pull-right">
            @permission('delete.admin_activities.execution')
            <button class="btn btn-danger btn-xs mb-0" data-dismiss="modal" data-toggle="modal" data-id="{{ $entity->id }}" data-target="#admin-act-delete">
                <i class="fa fa-trash"></i> {{ trans('app.labels.delete') }}</button>
            @endpermission
            <button class="btn btn-info btn-xs mb-0" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
            <button id="save_btn_top" type="button" class="btn btn-success btn-xs mb-0"><i class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
        </div>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit color-blue"></i> {{ trans('admin_activities.labels.edit') }}</h4>
    </div>
    <div class="modal-body">
        <form role="form" action="#" class="form-label-left" id="create_activity" novalidate>
            <div class="form-group  @if($entity->status === $AdminActivity::STATUS_COMPLETED &&
                                    currentUser()->getDepartmentInCharge() && $entity->responsible_unit_id === currentUser()->getDepartmentInCharge()->id )
                    col-md-6 col-sm-6 col-xs-12 @else  col-md-12 col-sm-12 col-xs-12" @endif>
                <label class="control-label" for="name">
                    {{ trans('app.headers.name') }} <span class="required text-danger">*</span>
                </label>
                <input type="text" id="name" name="name" maxlength="200" placeholder="{{ trans('admin_activities.placeholders.name') }}" autocomplete="off"
                       class="form-control" value="{{ $entity->name }}"/>
            </div>
            @if($entity->status === $AdminActivity::STATUS_COMPLETED &&
                currentUser()->getDepartmentInCharge() && $entity->responsible_unit_id === currentUser()->getDepartmentInCharge()->id )
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label" for="qualification">
                        {{ trans('admin_activities.labels.qualification') }} <span class="required text-danger">*</span>
                    </label>
                    <select class="form-control select22" id="qualification" name="qualification">
                        @foreach($AdminActivity::QUALIFICATION as $qualification)
                            <option value="{{ $qualification }}" @if($qualification == $entity->qualification) selected @endif></option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                <label class="control-label" for="assigned_user_id">
                    {{ trans('admin_activities.labels.assigned') }} <span class="required text-danger">*</span>
                </label>
                <select class="form-control select22" id="assigned_user_id" name="assigned_user_id" required>
                    @if (count($users) > 1)
                        <option value=""></option>
                    @endif
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($user->id == $entity->assigned_user_id) selected @endif>
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label class="control-label" for="status">
                    {{ trans('admin_activities.labels.status') }} <span class="required text-danger">*</span>
                </label>
                <select class="form-control select22" id="status" name="status">
                    @foreach($AdminActivity::STATUS as $status)
                        <option value="{{ $status }}" @if($status == $entity->status) selected @endif></option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label class="control-label" for="priority">
                    {{ trans('admin_activities.labels.priority') }} <span class="required text-danger">*</span>
                </label>
                <select class="form-control select22" id="priority" name="priority">
                    @foreach($AdminActivity::PRIORITIES as $priority)
                        <option value="{{ $priority }}" @if($priority == $entity->priority) selected @endif></option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                <label class="control-label" for="activity_type_id">
                    {{ trans('admin_activities.labels.activity_type') }} <span class="required text-danger">*</span>
                </label>
                <select class="form-control select22" id="activity_type_id" name="activity_type_id">
                    <option value=""></option>
                    @foreach($ActivityType::all() as $type)
                        <option value="{{ $type->id }}" @if($type->id == $entity->activity_type_id) selected @endif>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6 col-sm-12 col-xs-12 mb-5" id="reason_wrapper">
                <label class="control-label" for="reason_id">
                    {{ trans('admin_activities.labels.cancel_reason') }} <span class="required text-danger">*</span>
                </label>
                <select class="form-control select22" id="reason_id" name="reason_id" @if($entity->status != $AdminActivity::STATUS_CANCELED) disabled @endif>
                    <option value="">{{ trans("app.placeholders.select") }}</option>
                    @foreach($Reason::where('type', '=', $Reason::TYPE_CANCEL)->get() as $reason)
                        <option value="{{ $reason->id }}" @if($reason->id == $entity->reason_id) selected @endif>{{ $reason->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group has-feedback col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label class="control-label" for="date_init">
                    {{ trans('admin_activities.labels.date_init') }}
                </label>
                <input name="date_init" id="date_init" value="{{ $entity->date_init ? date('d-m-Y', strtotime($entity->date_init)) : '' }}"
                       class="form-control has-feedback-left readonly-white"
                       placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label class="control-label" for="date_end">
                    {{ trans('admin_activities.labels.date_end') }}
                </label>
                <input name="date_init" id="date_end" value="{{ $entity->date_end ? date('d-m-Y', strtotime($entity->date_end)) : '' }}"
                       class="form-control has-feedback-left readonly-white"
                       placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label class="control-label" for="planned_hours">
                    {{ trans('admin_activities.labels.planned_hours') }}
                </label>
                <input name="planned_hours" id="planned_hours" data-bind="value: plannedHours, valueUpdate: 'afterkeydown'"
                       class="form-control has-feedback-left" autocomplete="off"/>
                <span class="fa fa-clock-o form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <label class="control-label" for="time_spent">
                    {{ trans('admin_activities.labels.time_spent') }}
                </label>
                <div class="time-spent-progress pt-2" data-bind="visible: !timeSpentEditing(), click: eventClickEditTimeSpent" style="line-height: 30px;">
                    <div class="progress progress_sm mb-0">
                        <div class="progress-bar" data-bind="attr: {style: timeSpentProgressStyle()}, class: progressTimeComplete()">
                            <span class="sr-only"></span>
                        </div>
                        <div class="progress-bar progress-bar-warning" data-bind="visible: self.timeRemaining < 0, attr: { style: percentOverTimeStyle()}">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                    <div>
                        <span class="pull-left time-spent">{{ trans('admin_activities.labels.registered') }}: <span class="time-spent" data-bind="text: timeSpent"></span>h</span>
                        <span class="pull-right time-remaining" data-bind="attr: { style: showTimeRemainingStyle()}">
                            {{ trans('admin_activities.labels.remaining') }}:<span class="time-remaining" data-bind="text: timeRemaining()"></span>h</span>
                        <span class="pull-right time-remaining" data-bind="attr: {style: showTimeOverStyle()}">
                            {{ trans('admin_activities.labels.over') }}: <span class="time-over" data-bind="text: timeRemaining() * -1"></span>h</span>
                    </div>
                </div>

                <input name="time_spent" id="time_spent" class="form-control has-feedback-left" autocomplete="off"
                       data-bind="value: timeSpent, visible: timeSpentEditing(), event: { keyup: eventEditTimeSpent, blur: eventEditTimeSpent }"/>
                <span class="fa fa-history form-control-feedback left mt-2 green" aria-hidden="true" data-bind="importantVisible: timeSpentEditing()"></span>

            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" for="description">
                    {{ trans('admin_activities.labels.description') }}
                </label>
                <textarea type="text" id="description" name="description" placeholder="{{ trans('admin_activities.placeholders.description') }}" autocomplete="off"
                          class="form-control" rows="3">{{ $entity->description ?? '' }}</textarea>
            </div>

            <div id="check-list-context" class="col-md-12 col-sm-12 col-xs-12">
                <div class="widget_summary">
                    <div class="w_left w_25">
                        <label>
                            <span><i class="fa fa-check-square-o green"></i> {{ trans('admin_activities.labels.check_list') }}</span>
                            <span data-bind="text: countCompleted()"></span>
                        </label>
                    </div>
                    <div class="w_center w-75">
                        <div class="progress mb-0">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                 data-bind="text: percentCompleted() + '%', attr: {style: checkListProgressStyle()}">
                            </div>
                        </div>
                    </div>
                </div>
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

        <label class="ml-10 mr-10 mt-3"><i class="fa fa-paperclip color-blue"></i>
            {{ trans('admin_activities.labels.attachments') }}
        </label>

        <div id="dynamic_files" class="mr-10 ml-10">
            @include('business.execution.admin_activities.partial.files', ['entity' => $entity])
        </div>

        <form action="{{ route('upload.edit.admin_activities.execution', ['id' => $entity->id]) }}"
              class="dropzone ml-10 mr-10 min-h-150" id="upload_files" method="post"
              enctype="multipart/form-data">
            @csrf
            <div class="dz-message needsclick">
                <i class="fa fa-3x fa-cloud-upload mb-3"></i> <br>
                <span class="text-uppercase">{{ trans('admin_activities.labels.attachments_zone') }}</span> <br>
                <span>{{ trans('admin_activities.labels.automatic_upload') }}</span>
            </div>
        </form>

        <form id="comment_form" action="{{ route('comment.edit.admin_activities.execution', ['idActivity' => $entity->id]) }}" class="form-label-left mt-3" method="post">
            @csrf
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" for="comment">
                    <i class="fa fa-comments color-blue"></i> {{ trans('admin_activities.labels.comments') }}
                </label>
                <textarea type="text" id="comment" name="comment" placeholder="{{ trans('admin_activities.placeholders.comments') }}"
                          autocomplete="off" class="form-control" rows="2"></textarea>
                <button id="send_btn" type="submit" class="btn btn-default btn-xs pull-right mt-2 mr-0">
                    <i class="fa fa-send"></i> {{ trans('admin_activities.labels.send') }}
                </button>
            </div>
        </form>

        <div class="ml-10 mr-10" id="comments">
            @include('business.execution.admin_activities.partial.comments', ['entity' => $entity])
        </div>

    </div>

    <div class="modal-footer">
        <button class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
        <button id="save_btn" type="button" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
    </div>
</div>

<script>
    $(() => {

        new Dropzone($("#upload_files").get(0), {
            maxFilesize: 25,
            init: function () {
                this.on("success", function (file, response) {
                    processResponse(response, '#dynamic_files')
                });
            },
        });

        const formatStatus = (status) => {

            switch (status.id) {
                case '{{ $AdminActivity::STATUS_DRAFT }}':
                    return $("<span><i class='fa fa-circle-o'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_DRAFT) }}</span>");
                case '{{$AdminActivity::STATUS_IN_PROGRESS}}':
                    return $("<span><i class='color-blue fa fa-adjust fa-rotate-90'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_IN_PROGRESS) }}</span>");
                case '{{$AdminActivity::STATUS_COMPLETED}}':
                    return $("<span><i class='green fa fa-check-circle'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_COMPLETED) }}</span>");
                case '{{$AdminActivity::STATUS_CANCELED}}':
                    return $("<span><i class='red fa fa-ban'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_CANCELED) }}</span>");
            }
        };

        const formatQualification = (qualification) => {

            switch (qualification.id) {
                case '{{ $AdminActivity::QUALIFICATION_EXCELLENT }}':
                    return $("<span> {{ trans('admin_activities.labels.qualification_'.$AdminActivity::QUALIFICATION_EXCELLENT) }}</span>");
                case '{{$AdminActivity::QUALIFICATION_VERY_GOOD}}':
                    return $("<span> {{ trans('admin_activities.labels.qualification_'.$AdminActivity::QUALIFICATION_VERY_GOOD) }}</span>");
                case '{{$AdminActivity::QUALIFICATION_SATISFACTORY}}':
                    return $("<span> {{ trans('admin_activities.labels.qualification_'.$AdminActivity::QUALIFICATION_SATISFACTORY) }}</span>");
                case '{{$AdminActivity::QUALIFICATION_DEFICIENT}}':
                    return $("<span> {{ trans('admin_activities.labels.qualification_'.$AdminActivity::QUALIFICATION_DEFICIENT) }}</span>");
                case '{{$AdminActivity::QUALIFICATION_UNACCEPTABLE}}':
                    return $("<span> {{ trans('admin_activities.labels.qualification_'.$AdminActivity::QUALIFICATION_UNACCEPTABLE) }}</span>");
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
        }).on('change', (e) => {
            if ($(e.currentTarget).val() === '{{ $AdminActivity::STATUS_CANCELED }}') {
                selectReason.prop('disabled', false);
                $("#reason_id", $form).rules("add", "required");
            } else {
                selectReason.val('').change();
                selectReason.prop('disabled', true);
                $("#reason_id", $form).rules("remove", "required");
            }
            validator.element($("#reason_id", $form));
        });

        $('#qualification').select2({
            minimumResultsForSearch: -1,
            templateSelection: formatQualification,
            templateResult: formatQualification
        });

        $('#priority').select2({
            minimumResultsForSearch: -1,
            templateSelection: formatPriority,
            templateResult: formatPriority
        });

        let selectReason = $('#reason_id').select2({
            minimumResultsForSearch: -1
        }).on('change', () => {
            validator.element($("#reason_id", $form));
        });

        // Add datetimepicker
        $('#date_init, #date_end').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            useCurrent: false,
            ignoreReadonly: true,
            minDate: moment('{{ $minDate }}', 'DD-MM-YYYY').millisecond(0).second(0).minute(0).hour(0),
            maxDate: moment('{{ $maxDate }}', 'DD-MM-YYYY').millisecond(0).second(59).minute(59).hour(23)
        });


        $('#date_init, #date_end').on('dp.hide', (e) => {
            setTimeout(() => {
                $(e.currentTarget).data('DateTimePicker').viewDate(moment('{{ $minDate }}', 'DD-MM-YYYY').millisecond(0).second(0).minute(0).hour(0))
            }, 1);
        });

        $('#date_init').on('dp.change', (e) => {
            $('#date_end').data('DateTimePicker').minDate(e.date)
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

            self.plannedHours = ko.observable(0);
            self.timeSpent = ko.observable(0);
            this.timeSpentEditing = ko.observable(false);
            this.showTimeRemaining = ko.observable(false);
            this.showTimeOver = ko.observable(false);


            self.countCompleted = ko.computed(() => {
                return self.listItems().filter(item => item.completed()).length + ' / ' + self.listItems().length;
            });

            self.percentCompleted = ko.computed(() => {
                if (self.listItems().length > 0) {
                    return (self.listItems().filter(item => item.completed()).length * 100 / self.listItems().length).toFixed(0);
                } else {
                    return 0;
                }
            });

            self.timeRemaining = ko.computed(() => {
                return parseFloat((self.plannedHours() - self.timeSpent()).toFixed(1));
            });

            self.percentTimeSpent = ko.computed(() => {
                if (self.plannedHours() > 0 && self.timeRemaining() >= 0) {
                    self.showTimeRemaining(true);
                    self.showTimeOver(false);
                    return (self.timeSpent() * 100 / self.plannedHours()).toFixed(0);
                } else if (self.timeRemaining() < 0) {
                    self.showTimeRemaining(false);
                    self.showTimeOver(true);
                    return (self.plannedHours() * 100 / self.timeSpent()).toFixed(0);
                } else {
                    self.showTimeRemaining(false);
                    self.showTimeOver(false);
                    return 0;
                }
            });

            self.percentOverTimeStyle = ko.computed(() => {
                return self.timeRemaining() < 0 ? "width: " + (100 - self.percentTimeSpent()).toFixed(0) + '%' : 0;
            });

            self.timeSpentProgressStyle = ko.computed(() => {
                return "width: " + self.percentTimeSpent() + "%;";
            });

            self.showTimeOverStyle = ko.computed(() => {
                if (self.showTimeOver()) {
                    return "display: initial";
                } else {
                    return "display: none !important";
                }
            });

            self.showTimeRemainingStyle = ko.computed(() => {
                if (self.showTimeRemaining()) {
                    return "display: initial";
                } else {
                    return "display: none !important";
                }
            });

            self.progressTimeComplete = ko.computed(() => {
                if (self.plannedHours() > 0 && self.timeRemaining() === 0.0) {
                    return "progress-bar-success";
                } else {
                    return "progress-bar-primary";
                }
            });

            self.eventClickEditTimeSpent = (data) => {
                data.timeSpentEditing(true);
            }

            self.eventEditTimeSpent = (data, event) => {
                if (event.which === 13 || event.type === 'blur') {
                    data.timeSpentEditing(false);
                }
                return true;
            }

            self.checkListProgressStyle = ko.computed(() => {
                return "min-width: 2em; width: " + self.percentCompleted() + "%;";
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

        let check_list = JSON.parse('{!! $entity->check_list !!}'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));

        $.each(check_list, (index, value) => {
            let item = new ListItem();
            item.name(value.name);
            item.completed(value.completed);
            vm.listItems.push(item);
        });

        vm.plannedHours(parseFloat('{{ $entity->planned_hours ?? '0' }}'))
        vm.timeSpent(parseFloat('{{ $entity->time_spent ?? '0' }}'))

        ko.bindingHandlers.iCheck = {
            init: function (element, valueAccessor) {
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

        ko.bindingHandlers.importantVisible = {
            update: function (element, valueAccessor) {
                let show = ko.utils.unwrapObservable(valueAccessor());
                if (!show)
                    element.style.setProperty("display", "none", "important")
                else
                    element.style.display = "";

            }
        };

        ko.applyBindings(vm, document.getElementById('create_activity'));

        $('#planned_hours, #time_spent').number(true, 1);

        let $form = $('#create_activity');

        let validator = $form.validate($.extend(false, $validateDefaults, {
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 200
                },
                assigned_user_id: {
                    required: true
                },
                status: {
                    required: true
                },
                priority: {
                    required: true
                },
                activity_type_id: {
                    required: true
                }
            }
        }));

        let activities_tb = $('#activities_tb').DataTable();

        $form.validate($validateDefaults);

        $('#save_btn, #save_btn_top').on('click', () => {

            if ($('#file_alert').length && ($('#status').val() === '{{ $AdminActivity::STATUS_COMPLETED }}')) {
                notify("{{ trans('admin_activities.messages.validation.no_files_completed') }}", 'warning');
                return false;
            }

            if ($form.valid()) {
                pushRequest('{{ route('update.edit.admin_activities.execution') }}', null, () => {
                    $modal.modal('hide');
                    activities_tb.draw();
                }, 'put', {
                    _token: '{{ csrf_token() }}',
                    activity: {
                        id: '{{ $entity->id }}',
                        name: $('#name').val(),
                        assigned_user_id: $('#assigned_user_id').val(),
                        status: $('#status').val(),
                        qualification: $('#qualification').val(),
                        priority: $('#priority').val(),
                        date_init: $('#date_init').val(),
                        date_end: $('#date_end').val(),
                        description: $('#description').val(),
                        check_list: JSON.stringify(ko.toJS(vm.listItems)),
                        activity_type_id: $('#activity_type_id').val(),
                        reason_id: $('#reason_id').val(),
                        planned_hours: $('#planned_hours').val(),
                        time_spent: $('#time_spent').val(),
                        created_by_id: '{{ $entity->created_by_id}}',
                        responsible_unit_id: '{{ $entity->responsible_unit_id}}',
                    }
                });
            }
        });

        let $commentForm = $('#comment_form')

        $commentForm.validate($.extend(false, $validateDefaults, {
            rules: {
                comment: {
                    required: true,
                    minlength: 3,
                    maxlength: 200
                }
            }
        }));

        $commentForm.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                $commentForm.trigger("reset");
                processResponse(response, '#comments');
            }
        }));

    });
</script>