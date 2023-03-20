<div id="activity-alert-list">
    <div class="check-list-wrapper">
        <p><i class="fa fa-info-circle text-primary fs-l-"></i> Para adicionar y guardar la actividad presione ENTER</p>
        <ul class="to_do">
            @if(in_array($activity->meeting->status, \App\Models\Business\StaffMeeting::STATUS_EDITABLE))
                <li class="check-list-item">
                    <div>
                        <i class="fa fa-plus"></i>
                        <div class="check-list-item-title">
                            <input type="text" data-bind="textInput: newActivity, event: { keyup: addNewActivity }" class="text-border-less"
                                   placeholder="Agregar una alerta"
                                   maxlength="120" value="">
                        </div>
                    </div>
                </li>
            @endif
        <!-- ko foreach: activities() -->
            <li class="check-list-item">
                <div>
                    <div class="checkbox">
                        <label>
                        </label>
                    </div>
                    <div class="check-list-item-title" style="line-height: normal">
                        <div class="mb-1">
                            <span data-bind="text: name" class="fw-b"></span>
                        </div>
                        <div>

                        </div>
                    </div>
                    <!-- ko if: readonly() -->
                    <div class="check-list-trash">
                        <span title="Eliminar" data-bind="click: $root.deleteActivity">
                            <i class="fa fa-trash red"></i>
                        </span>
                    </div>
                    <!-- /ko -->
                </div>
            </li>
            <!-- /ko -->
        </ul>
    </div>
</div>

<script>
    $(() => {
        var Activity = function () {
            this.id = '';
            this.name = '';
            this.type = ko.observable('');
            this.status = ko.observable('');

            this.readonly = () => {
                return '{{ $activity->meeting->status }}' === '{{ \App\Models\Business\StaffMeeting::STATUS_DRAFT }}'
            }

            this.cssActivityStatus = ko.computed(() => {
                switch (this.status()) {
                    case '{{ \App\Models\Business\StaffActivity::STATUS_DRAFT }}':
                        return 'badge-warning'
                    case '{{ \App\Models\Business\StaffActivity::STATUS_CLOSED }}':
                        return 'badge-success'
                }
                return '';
            });
        };

        var viewModel = function () {
            var self = this;
            self.activities = ko.observableArray([]);
            self.newActivity = ko.observable();

            self.addNewActivity = (type, event) => {
                if (event && event.which === 13 && self.newActivity().trim() !== '') {
                    var item = new Activity();
                    item.name = self.newActivity().trim().replaceAll('"', '');
                    item.type('{{ \App\Models\Business\StaffActivity::TYPE_ALERT }}');
                    item.status('{{ \App\Models\Business\StaffActivity::STATUS_DRAFT }}');
                    $.ajax('{{ route('store.activity.staff') }}', {
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: item.name,
                            meeting_id: '{{ $activity->meeting->id }}',
                            parent_id: '{{ $activity->id }}',
                            type: item.type()
                        },
                    }).done(function (response) {
                        item.id = response.id
                        vm.activities.unshift(item);
                        self.newActivity('');
                        $('#alert_count').html(vm.activities().length);
                    }).fail(function (request, error) {
                        notify('Ha ocurrido un error al intentar crear la alerta', 'error', 'Error!');
                    })
                }
                return true;
            }

            self.deleteActivity = (data) => {
                let url = '{{ route('delete.activity.staff', '__ID__') }}';
                url = url.replace('__ID__', data.id)
                confirmModal('Está seguro que desea eliminar la alerta', () => {
                    pushRequest(url, null, (response) => {
                        if (response.success) {
                            self.activities.remove(data);
                            $('#alert_count').html(vm.activities().length);
                        }
                    }, 'DELETE', {'_token': '{{ csrf_token() }}'});
                });
            }
        }

        var vm = new viewModel();

        let activities = JSON.parse('{!! str_replace("\u0022", "\\\\\"", json_encode($activity->alerts, JSON_HEX_APOS | JSON_HEX_QUOT)) !!}'
            .replace(/\n/g, "\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t").replace(/\\/g, "\\\\"));

        $.each(activities, (index, value) => {
            let item = new Activity();
            item.id = value.id;
            item.name = value.name;
            item.description = value.description;
            item.type(value.type);
            item.status(value.status);
            vm.activities.push(item);
        });

        ko.applyBindings(vm, document.getElementById('activity-alert-list'));
    });
</script>
