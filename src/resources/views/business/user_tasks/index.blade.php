<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('user_tasks.title') }}</h3>
        </div>
        <div class="title_right">
            <a id="export_modal" class="pull-right fs-l" href="#" data-toggle="modal" data-target="#modal-report-filters">
                <i class="fa fa-file-pdf-o text-success"></i>
                {{ trans('reports.labels.report') }}
            </a>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row" id="task-list">
        <div class="col-md-2">
            <div class="form-group has-feedback ">
                <input id="date_at" value="{{ $date }}"
                       class="form-control has-feedback-left readonly-white"
                       autocomplete="off" readonly/>
                <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
            </div>

            <div class="form-group mt-4">
                <label class="control-label" for="work_time">
                    {{ trans('admin_activities.labels.time_spent') }}
                </label>
                <div class="time-spent-progress pt-2" style="line-height: 30px;">
                    <div class="progress progress_sm mb-0">
                        <div class="progress-bar" data-bind="attr: {style: timeSpentProgressStyle()}, class: progressTimeComplete()">
                            <span class="sr-only"></span>
                        </div>
                        <div class="progress-bar progress-bar-warning" data-bind="visible: self.timeRemaining < 0, attr: { style: percentOverTimeStyle()}">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                    <div>
                        <span class="pull-left time-spent">{{ trans('admin_activities.labels.registered') }}: <span class="time-spent" data-bind="text: totalWork()"></span>h</span>
                        <span class="pull-right time-remaining" data-bind="attr: { style: showTimeRemainingStyle()}">
                            {{ trans('admin_activities.labels.remaining') }}: <span class="time-remaining" data-bind="text: timeRemaining()"></span>h</span>
                        <span class="pull-right time-remaining" data-bind="attr: {style: showTimeOverStyle()}">
                            {{ trans('admin_activities.labels.over') }}: <span class="time-over" data-bind="text: timeRemaining() * -1"></span>h</span>
                    </div>
                </div>
            </div>
        </div>
        <div data-bind="class: cssTaskList()">
            <div class="check-list-wrapper">
                <ul class="to_do">
                    <li class="check-list-item">
                        <div>
                            <i class="fa fa-plus"></i>
                            <div class="check-list-item-title">
                                <input type="text" data-bind="textInput: newTask, event: { keyup: addNewTask }" class="text-border-less"
                                       placeholder="Agregar una tarea" maxlength="120" value="">
                            </div>
                        </div>
                    </li>
                    <!-- ko foreach: pendingTasks() -->
                    <li class="check-list-item">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" data-bind="iCheck: is_completed">
                                </label>
                            </div>
                            <div class="check-list-item-title" data-bind="click: $root.selectTask" style="line-height: normal">
                                <div class="mb-1">
                                    <span data-bind="text: name" class="fw-b"></span>
                                </div>
                                <div>
                                    <span class="fs-sm">Horas:</span> <span data-bind="text: work_time" class="mr-3 fs-sm"></span>
                                    <span data-bind="text: type, class: cssTaskType" style="font-size: smaller" class="badge"></span>
                                </div>
                            </div>
                            <div class="check-list-trash">
                                <span title="Eliminar" data-bind="click: $root.deleteTask">
                                    <i class="fa fa-trash red"></i>
                                </span>
                            </div>
                        </div>
                    </li>
                    <!-- /ko -->

                    <li data-bind="if: completedTasks().length > 0" style="background: none; font-size: large; font-weight: bold">
                        Completadas <span data-bind="text: completedTasks().length"></span>
                    </li>

                    <!-- ko foreach: completedTasks() -->
                    <li class="check-list-item">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" data-bind="iCheck: is_completed">
                                </label>
                            </div>
                            <div class="check-list-item-title" data-bind="click: $root.selectTask" style="line-height: normal">
                                <div class="mb-1">
                                    <span style="text-decoration: line-through;" data-bind="text: name" class="fw-b"></span>
                                </div>
                                <div>
                                    <span class="fs-sm">Horas:</span> <span data-bind="text: work_time" class="mr-3 fs-sm"></span>
                                    <span data-bind="text: type, class: cssTaskType" style="font-size: smaller" class="badge"></span>
                                </div>
                            </div>
                            <div class="check-list-trash">
                                <span title="Eliminar" data-bind="click: $root.deleteTask">
                                    <i class="fa fa-trash red"></i>
                                </span>
                            </div>
                        </div>
                    </li>
                    <!-- /ko -->
                </ul>
            </div>
        </div>
        <!-- ko if: selectedTask() -->
        <div class="col-md-3">
            <form role="form" action="#" id="update_task" novalidate>
                <div class="form-group">
                    <label class="control-label" for="name">
                        {{ trans('app.headers.name') }} <span class="required text-danger">*</span>
                    </label>
                    <input type="text" id="name" name="name" maxlength="200" class="form-control" data-bind="value: selectedTask().name"/>
                </div>

                <div class="form-group">
                    <label class="control-label" for="description">
                        {{ trans('admin_activities.labels.description') }}
                    </label>
                    <textarea type="text" id="description" name="description" data-bind="textInput: selectedTask().description"
                              placeholder="{{ trans('admin_activities.placeholders.description') }}"
                              class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label class="control-label">Tipo </label>
                    <div>
                        <div class="radio">
                            <label>
                                <input type="radio" data-bind="checked: selectedTask().type" value="Según Necesidad"> Según Necesidad
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" data-bind="checked: selectedTask().type" value="Planificada"> Planificada
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" data-bind="checked: selectedTask().type" value="Administrativa"> Administrativa
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="work_time">
                        Horas
                    </label>
                    <input type="number" id="work_time" class="form-control" data-bind="value: selectedTask().work_time"/>
                </div>
            </form>

            <button data-bind="click: cancel" class="btn btn-info"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
            <button data-bind="click: update" type="button" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
        </div>
        <!-- /ko -->

    </div>

    <div id="modal-report-filters" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">{{ trans('reports.labels.filters') }}</h4>
                </div>
                <div class="modal-body">
                    <dic class="row">
                        <div class="form-group has-feedback col-md-6">
                            <label class="control-label" for="date_from">
                                {{ trans('reforms.labels.from') }}
                            </label>
                            <input name="date_init" id="date_from" value="{{ now()->format('Y-m-d') }}"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" YYYY-MM-DD" autocomplete="off" readonly/>
                            <span class="fa fa-calendar form-control-feedback left mt-2 color-blue"
                                  aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback col-md-6">
                            <label class="control-label" for="date_to">
                                {{ trans('reforms.labels.to') }}
                            </label>
                            <input name="date_init" id="date_to" value="{{ now()->format('Y-m-d') }}"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" YYYY-MM-DD" autocomplete="off" readonly/>
                            <span class="fa fa-calendar form-control-feedback left mt-2 color-blue"
                                  aria-hidden="true"></span>
                        </div>
                    </dic>
                </div>
                <div class="modal-footer">
                    <button type="button" id="export_pdf" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-file-pdf-o"></i> {{ trans('app.labels.export.pdf') }}</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(() => {

        var Task = function () {
            this.id = '';
            this.name = '';
            this.description = null;
            this.is_completed = ko.observable(false);
            this.is_important = ko.observable(false);
            this.type = ko.observable("Según Necesidad");
            this.work_time = ko.observable(0).extend({
                min: {params: 0, message: 'Por favor, escribe un valor mayor o igual a {0}.'},
                max: {params: 8, message: 'Por favor, escribe un valor menor o igual a {0}.'}
            });
            this.rating = 0;

            this.cssTaskType = ko.computed(() => {
                switch (this.type()) {
                    case 'Según Necesidad':
                        return 'badge-warning'
                    case 'Planificada':
                        return 'badge-info'
                    case 'Administrativa':
                        return 'badge-success'
                }
                return '';
            });
        };

        var viewModel = function () {
            var self = this;
            self.tasks = ko.observableArray([]);
            self.newTask = ko.observable();
            self.selectedTask = ko.observable();

            this.showTimeRemaining = ko.observable(false);
            this.showTimeOver = ko.observable(false);

            self.addNewTask = (data, event) => {
                if (event.which === 13 && self.newTask().trim() !== '') {
                    var item = new Task();
                    item.name = self.newTask().trim();
                    $.ajax('{{ route('store.tasks') }}', {
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: item.name,
                            type: 'Según Necesidad',
                            date_at: $('#date_at').val()
                        },
                    }).done(function (response) {
                        item.id = response.id
                        vm.tasks.unshift(item);
                        self.newTask('');
                    }).fail(function (request, error) {
                        notify('Ha ocurrido un error al intentar crear la tarea', 'error', 'Error!');
                    })
                }
                return true;
            }

            self.pendingTasks = ko.computed(() => {
                return self.tasks().filter(item => !item.is_completed());
            });

            self.completedTasks = ko.computed(() => {
                return self.tasks().filter(item => item.is_completed());
            });

            self.totalWork = ko.computed(() => {
                let sum = 0;
                $.each(self.tasks(), (index, value) => {
                    sum += parseFloat(value.work_time()) || 0;
                });
                return sum;
            });

            self.timeRemaining = ko.computed(() => {
                return parseFloat((8 - self.totalWork()).toFixed(1));
            });

            self.percentWorkTime = ko.computed(() => {
                if (self.timeRemaining() >= 0) {
                    self.showTimeRemaining(true);
                    self.showTimeOver(false);
                    return (self.totalWork() * 100 / 8).toFixed(0);
                } else if (self.timeRemaining() < 0) {
                    self.showTimeRemaining(false);
                    self.showTimeOver(true);
                    return (8 * 100 / self.totalWork()).toFixed(0);
                } else {
                    self.showTimeRemaining(false);
                    self.showTimeOver(false);
                    return 0;
                }
            });

            self.percentOverTimeStyle = ko.computed(() => {
                return self.timeRemaining() < 0 ? "width: " + (100 - self.percentWorkTime()).toFixed(0) + '%' : 0;
            });

            self.timeSpentProgressStyle = ko.computed(() => {
                return "width: " + self.percentWorkTime() + "%;";
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
                if (self.timeRemaining() === 0.0) {
                    return "progress-bar-success";
                } else {
                    return "progress-bar-primary";
                }
            });

            self.selectTask = (data) => {
                let task = new Task();
                task.id = data.id;
                task.name = data.name;
                task.description = data.description;
                task.is_completed(data.is_completed());
                task.is_important(data.is_important());
                task.rating = data.rating;
                task.type(data.type());
                task.work_time(data.work_time());
                self.selectedTask(task);
            }

            self.cssTaskList = ko.computed(() => {
                if (self.selectedTask()) {
                    return "col-md-7";
                } else {
                    return "col-md-10";
                }
            });

            self.cancel = () => {
                self.selectedTask(null);
            }

            self.update = () => {
                let url = '{{ route('update.tasks',  '__ID__') }}';
                url = url.replace('__ID__', vm.selectedTask().id)

                pushRequest(url, null, null, 'put', {
                    _token: '{{ csrf_token() }}',
                    name: $('#name').val(),
                    description: $('#description').val(),
                    redirect: true,
                    date: $('#date_at').val(),
                    type: vm.selectedTask().type(),
                    work_time: vm.selectedTask().work_time(),
                });
            }

            self.deleteTask = (data) => {
                let url = '{{ route('delete.tasks', '__ID__') }}';
                url = url.replace('__ID__', data.id)
                confirmModal('Está seguro que desea eliminar la tarea', () => {
                    pushRequest(url, null, null, 'DELETE', {'_token': '{{ csrf_token() }}', date: $('#date_at').val()});
                });
            }
        }

        var vm = new viewModel();

        let tasks = JSON.parse('{!! str_replace("\u0022", "\\\\\"", json_encode($tasks, JSON_HEX_APOS | JSON_HEX_QUOT)) !!}'
            .replace(/\n/g, "\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));

        $.each(tasks, (index, value) => {
            let item = new Task();
            item.id = value.id;
            item.name = value.name;
            item.description = value.description;
            item.is_completed(value.is_completed);
            item.is_important(value.is_important);
            item.rating = value.rating;
            item.type(value.type);
            item.work_time(value.work_time);
            vm.tasks.push(item);
        });

        ko.bindingHandlers.iCheck = {
            init: function (element, valueAccessor, allBindings, viewModel) {
                $(element).iCheck({
                    checkboxClass: "icheckbox_flat-green"
                });

                $(element).on('ifChanged', function () {
                    let observable = valueAccessor();
                    observable($(element)[0].checked);
                    let url = '{{ route('update.tasks', '__ID__') }}';
                    url = url.replace('__ID__', viewModel.id)
                    $.ajax(url, {
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_completed: ko.unwrap(valueAccessor()) === true ? 1 : 0
                        },
                    }).done(function (response) {
                    }).fail(function (request, error) {
                        notify('Ha ocurrido un error al intentar actualizar la tarea', 'error', 'Error!');
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

        ko.bindingHandlers.iCheck2 = {
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

        ko.applyBindings(vm, document.getElementById('task-list'));

        $('#date_at').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            useCurrent: true,
            ignoreReadonly: true
        }).on('dp.change', (e) => {
            pushRequest('{{ route('index.tasks') }}', null, null, 'get', {
                date: $('#date_at').val()
            })
        });

        $('#work_time').number(true, 1);

        $('#date_from, #date_to').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'es-es',
            useCurrent: true,
            ignoreReadonly: true
        })

        $('#export_pdf').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                url: '{{ route('export.tasks') }}',
                method: 'GET',
                data: {
                    date_from: $('#date_from').val(),
                    date_to: $('#date_to').val(),
                },
                beforeSend: () => {
                    showLoading();
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: (response) => {
                    let a = document.createElement('a');
                    let url = window.URL.createObjectURL(response);
                    a.href = url;
                    a.download = '{{ trans('user_tasks.title') }}';
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);

                }
            }).always(() => {
                hideLoading();
            });
        });

    });
</script>
