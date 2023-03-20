<div class="x_panel shadow" id="activity-results-list">
    <div class="x_title">
        <h2 class="text-success"><i class="fa fa-check-circle-o"></i>
            {{ trans('staff_meetings.labels.result_activities') . ' ' . trans('staff_meetings.labels.week') . ' #' . $previous_week }}
            (<span data-bind="text: activities().length"></span>): {{ trans('staff_meetings.labels.strategics') }}: (<span data-bind="text: countStrategic()"></span>)
            {{ trans('staff_meetings.labels.admins') }}: (<span data-bind="text: countAdmin()"></span>)
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
                <!-- ko foreach: activities -->
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
                        <div>
                            <span data-bind="text: type, class: cssType" style="font-size: smaller" class="badge"></span>
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
            this.type = ko.observable('');
            this.status = ko.observable('');

            this.cssType = ko.computed(() => {
                switch (this.type()) {
                    case '{{ \App\Models\Business\StaffActivity::TYPE_STRATEGIC }}':
                        return 'badge-success'
                    case '{{ \App\Models\Business\StaffActivity::TYPE_ADMIN }}':
                        return 'badge-info'
                }
                return '';
            });
        };

        var viewModel = function () {
            var self = this;
            self.activities = ko.observableArray([])

            self.countStrategic = ko.computed(() => {
                return self.activities().filter(item => item.type() === '{{ \App\Models\Business\StaffActivity::TYPE_STRATEGIC }}').length;
            });
            self.countAdmin = ko.computed(() => {
                return self.activities().filter(item => item.type() === '{{ \App\Models\Business\StaffActivity::TYPE_ADMIN }}').length;
            });

            self.sortActivities = function () {
                self.activities.sort(function (left, right) {
                    return left.type() === right.type() ? 0 : (left.type() < right.type() ? 1 : -1)
                });
            }
        }

        var vm = new viewModel();

        let activities = JSON.parse('{!! str_replace("\u0022", "\\\\\"", json_encode($results, JSON_HEX_APOS | JSON_HEX_QUOT)) !!}'
            .replace(/\n/g, "\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t").replace(/\\/g, "\\\\"));

        $.each(activities, (index, value) => {
            if (value.status === '{{ \App\Models\Business\StaffActivity::STATUS_CLOSED }}') {
                let item = new Activity();
                item.id = value.id;
                item.name = value.name;
                item.description = value.description;
                item.type(value.type);
                item.status(value.status);
                vm.activities.push(item);
            }
        });

        vm.sortActivities();

        ko.applyBindings(vm, document.getElementById('activity-results-list'));
    });
</script>