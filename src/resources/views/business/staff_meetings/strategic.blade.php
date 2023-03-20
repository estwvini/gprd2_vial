<div class="x_panel shadow" id="activity-list">
    <div class="x_title">
        <h2 class="text-primary"><i class="fa fa-flag"></i> {{ trans('staff_meetings.labels.strategic_activities') }}
            (<span data-bind="text: countCompleted()"></span>/<span data-bind="text: strategicActivities().length"></span>)
        </h2>
        <ul class="nav navbar-right panel_toolbox">
            <li style="float: right"><a class="collapse-link"><i style="color: #808285 !important;" class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="check-list-wrapper">
            <ul class="to_do">
                @if(in_array($meeting->status, \App\Models\Business\StaffMeeting::STATUS_EDITABLE))
                    <li class="check-list-item">
                        <div>
                            <i class="fa fa-plus color-green-light"></i>
                            <div class="check-list-item-title">
                                <input type="text" data-bind="textInput: newActivity, event: { keyup: addNewActivity }" class="text-border-less"
                                       placeholder="Agregar una actividad estratégica"
                                       maxlength="120" value="">
                            </div>
                        </div>
                    </li>
            @endif

            <!-- ko foreach: strategicActivities() -->
                <li class="check-list-item">
                    <div style="align-items: start">
                        <div class="checkbox">
                            <label>
                                <!-- ko if: $parent.is_approved() -->
                                <input type="checkbox" data-bind="iCheck: is_completed">
                                <!-- /ko -->
                            </label>
                        </div>

                        <div class="check-list-item-title" style="line-height: normal" data-bind="click: $root.editActivity">
                            <div class="mb-3">
                                <span data-bind="text: name" class="fw-b"></span>
                            </div>
                            <div>
                                <ul>
                                    <!-- ko foreach: tasks() -->
                                    <li style="list-style: inside;"><span data-bind="text: $data"></span></li>
                                    <!-- /ko -->
                                </ul>
                            </div>
                            <div>
                                <!-- ko if: alertCount() > 0 -->
                                <span class="text-danger"><i class="fa fa-bell"></i> {{ trans('staff_meetings.labels.alert_activities') }}
                                    (<span data-bind="text: alertCount"></span>)</span>
                                <!-- /ko -->

                                <!-- ko if: coordinationCount() > 0 -->
                                <span class="text-info ml-5"><i class="fa fa-refresh">

                                    </i> {{ trans('staff_meetings.labels.coordination_activities') }} (<span data-bind="text: coordinationCount"></span>)</span>
                                <!-- /ko -->

                                <!-- ko if: requires_media_coverage() -->
                                <span class="text-success ml-5"><i class="fa fa-phone-square"></i> </span>
                                <!-- /ko -->

                                <!-- ko if: is_public_purchase() -->
                                <span class="text-success ml-5"><i class="fa fa-dollar"></i> </span>
                                <!-- /ko -->

                                <!-- ko if: date_end() != '' -->
                                <span data-bind="text: date_end, class: cssDateEnd" style="font-size: smaller" class="badge ml-5"></span>
                                <!-- /ko -->

                            </div>
                        </div>
                        <!-- ko if: readonly() -->
                        <div class="check-list-trash">
                        <span title="Eliminar" data-bind="click: $root.deleteActivity">
                            <i class="fa fa-trash red"></i>
                        </span>
                        </div>
                        <!-- /ko -->
                        <!-- ko if: is_extra() -->
                        <div class="mr-4">
                            <span style="font-size: smaller" class="badge badge-success text-danger">NUEVA</span>
                        </div>
                        <!-- /ko -->
                        <div>
                            <span data-bind="text: status, class: cssActivityStatus" style="font-size: smaller" class="badge"></span>
                        </div>
                    </div>
                </li>
                <!-- /ko -->
            </ul>
        </div>
    </div>
</div>

<script>
    $(() => {
        var Activity = function () {
            this.id = '';
            this.name = '';
            this.alertCount = ko.observable(0);
            this.coordinationCount = ko.observable(0);
            this.type = ko.observable('');
            this.status = ko.observable('');
            this.is_extra = ko.observable(false);
            this.is_completed = ko.observable(false);
            this.requires_media_coverage = ko.observable(false);
            this.is_public_purchase = ko.observable(false);
            this.date_end = ko.observable('');

            this.tasks = ko.observableArray([]);

            this.readonly = () => {
                return '{{ $meeting->status }}' === '{{ \App\Models\Business\StaffMeeting::STATUS_DRAFT }}'
            }

            this.complete = ko.computed(() => {
                let complete = this.status() === '{{ \App\Models\Business\StaffActivity::STATUS_CLOSED }}'
                this.is_completed(complete);
            });

            this.cssActivityStatus = ko.computed(() => {
                switch (this.status()) {
                    case '{{ \App\Models\Business\StaffActivity::STATUS_DRAFT }}':
                        return 'badge-warning'
                    case '{{ \App\Models\Business\StaffActivity::STATUS_CLOSED }}':
                        return 'badge-success'
                }
                return '';
            });

            this.cssDateEnd = ko.computed(() => {
                if (this.date_end() !== '' && moment(this.date_end()) < moment() && this.status() === '{{ \App\Models\Business\StaffActivity::STATUS_DRAFT }}') {
                    return 'badge-danger'
                }

                if (this.date_end() !== '') {
                    return 'badge-success'
                }

                return '';
            });
        };

        var viewModel = function () {
            var self = this;
            self.activities = ko.observableArray([]);
            self.newActivity = ko.observable();

            this.is_approved = ko.computed(() => {
                return '{{ $meeting->status }}' === '{{ \App\Models\Business\StaffMeeting::STATUS_APPROVED }}'
            });

            self.addNewActivity = (type, event) => {
                if (event && event.which === 13 && self.newActivity().trim() !== '') {
                    var item = new Activity();
                    item.name = self.newActivity().trim().replaceAll('"', '');
                    item.type('{{ \App\Models\Business\StaffActivity::TYPE_STRATEGIC }}');
                    item.status('{{ \App\Models\Business\StaffActivity::STATUS_DRAFT }}');
                    $.ajax('{{ route('store.activity.staff') }}', {
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: item.name,
                            meeting_id: '{{ $meeting->id }}',
                            type: item.type()
                        },
                    }).done(function (response) {
                        item.id = response.id
                        item.is_extra(response.is_extra);
                        vm.activities.unshift(item);
                        self.newActivity('');
                    }).fail(function (request, error) {
                        notify('Ha ocurrido un error al intentar crear la actividad', 'error', 'Error!');
                    })
                }
                return true;
            }

            self.strategicActivities = ko.computed(() => {
                return self.activities().filter(item => item.type() === '{{ \App\Models\Business\StaffActivity::TYPE_STRATEGIC }}');
            });

            self.countCompleted = ko.computed(() => {
                return self.strategicActivities().filter(item => item.is_completed()).length;
            });

            self.deleteActivity = (data) => {
                let url = '{{ route('delete.activity.staff', '__ID__') }}';
                url = url.replace('__ID__', data.id)
                confirmModal('Está seguro que desea eliminar la actividad', () => {
                    pushRequest(url, null, null, 'DELETE', {'_token': '{{ csrf_token() }}'}, false);
                });
            }

            self.editActivity = (data) => {
                @if($meeting->status == \App\Models\Business\StaffMeeting::STATUS_DRAFT)
                let url = '{{ route('edit.activity.staff', '__ID__') }}';
                url = url.replace('__ID__', data.id)
                pushRequest(url, '#edit-activities', null, 'get', {'type': '{{ \App\Models\Business\StaffActivity::TYPE_STRATEGIC }}'}, false);
                @elseif($meeting->status == \App\Models\Business\StaffMeeting::STATUS_APPROVED)
                if (data.is_extra()) {
                    let url = '{{ route('edit.activity.staff', '__ID__') }}';
                    url = url.replace('__ID__', data.id)
                    pushRequest(url, '#edit-activities', null, 'get', {'type': '{{ \App\Models\Business\StaffActivity::TYPE_STRATEGIC }}'}, false);
                }
                @endif
            }
        }

        var vm = new viewModel();

        let activities = JSON.parse('{!! str_replace("\u0022", "\\\\\"", json_encode($meeting->activities, JSON_HEX_APOS | JSON_HEX_QUOT)) !!}'
            .replace(/\n/g, "\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t").replace(/\\/g, "\\\\"));

        $.each(activities, (index, value) => {
            let item = new Activity();
            item.id = value.id;
            item.name = value.name;
            item.description = value.description;
            item.type(value.type);
            item.status(value.status);
            item.alertCount(value.alert_count);
            item.coordinationCount(value.coordination_count);
            item.is_extra(value.is_extra);
            item.is_public_purchase(value.is_public_purchase);
            item.requires_media_coverage(value.requires_media_coverage);
            item.date_end(value.date_end);
            $.each(value.activities_related, (index, value) => {
                item.tasks.push(value.relatable.name);
            });
            vm.activities.push(item);
        });


        ko.bindingHandlers.iCheck = {
            init: function (element, valueAccessor, allBindings, viewModel) {
                $(element).iCheck({
                    checkboxClass: "icheckbox_flat-green"
                });

                $(element).on('ifChanged', function () {
                    let observable = valueAccessor();
                    observable($(element)[0].checked);
                    let url = '{{ route('update.activity.staff', '__ID__') }}';
                    url = url.replace('__ID__', viewModel.id)
                    $.ajax(url, {
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: ko.unwrap(valueAccessor()) === true ? '{{ \App\Models\Business\StaffActivity::STATUS_CLOSED }}' : '{{
                            \App\Models\Business\StaffActivity::STATUS_DRAFT }}'
                        },
                    }).done(function (response) {
                        viewModel.status(response.status);
                    }).fail(function (request, error) {
                        notify('Ha ocurrido un error al intentar actualizar la actividad', 'error', 'Error!');
                    })
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

        ko.applyBindings(vm, document.getElementById('activity-list'));
    });
</script>
