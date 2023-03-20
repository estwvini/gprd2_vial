<div>
    <div class="page-title">
        <div class="w-100 title_left">
            <h3>{{ trans('staff_meetings.labels.weekly_planning') }} #{{ $meeting->start->weekOfYear}} / {{ $meeting->start->year }} / {{ $meeting->department->name }}</h3>
            <span class='label label-{{ \App\Models\Business\StaffMeeting::STATUS_BG[$meeting->status] }}'>{{ $meeting->status }}</span> {{ ucfirst($meeting->start->formatLocalized('%B')) }}
            ({{ $meeting->start->day . '-' . $meeting->end->day}})
            <a href="{{ route('index.staff') }}" class="btn btn-default pull-right btn-sm ajaxify">
                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
            </a>
            @if($meeting->status != \App\Models\Business\StaffMeeting::STATUS_CLOSED)
                <button id="close-planning" class="btn btn-sm btn-success pull-right">
                    <i class="fa fa-check"></i> @if($meeting->status == \App\Models\Business\StaffMeeting::STATUS_DRAFT) {{ trans('staff_meetings.labels.approve') }}
                    @else {{ trans('staff_meetings.labels.close') }} @endif
                </button>
            @endif
            <button class="btn btn-warning pull-right btn-sm" id="btn-note">
                <i class="fa fa-check-circle-o"></i> {{ trans('app.labels.note') }}
            </button>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row mt-3" id="editor-content">
        @if($meeting->status != \App\Models\Business\StaffMeeting::STATUS_CLOSED)
            <div class="col-md-6 col-sm-12" data-bind="visible: show">
                <h4 class="text-primary"><i class="fa fa-sticky-note-o"></i> {{ trans('app.labels.note') }}</h4>
                <div id="editor">{!! $meeting->description !!}</div>
                <div class="mt-2 text-right">
                    <button class="btn btn-default btn-sm" data-bind="click: hideEditor">
                        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                    </button>
                    <button class="btn btn-success btn-sm mr-0" id="btn-save-note">
                        <i class="fa fa-save"></i> {{ trans('app.labels.save') }}
                    </button>
                </div>
            </div>
        @else
            <div class="col-md-6 col-sm-12" data-bind="visible: show">
                <h4 class="text-primary"><i class="fa fa-sticky-note-o"></i> {{ trans('app.labels.note') }}</h4>
                <div class="content-read">
                    <div>{!! $meeting->description !!}</div>
                </div>
                <div class="mt-2 text-right">
                    <button class="btn btn-default btn-sm" data-bind="click: hideEditor">
                        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                    </button>
                </div>
            </div>
        @endif
    </div>

    <div class="row mt-3">
        <div class="col-md-6 col-sm-12 col-xs-12">
            @include('business.staff_meetings.project_panel')
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel shadow">
                <div class="x_title">
                    <h2 class="text-primary"><i class="fa fa-line-chart"></i> {{ trans('staff_meetings.labels.weekly_progress') }}
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li style="float: right"><a class="collapse-link"><i style="color: #808285 !important;" class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @include('business.staff_meetings.chart', ['departmentId' => $meeting->department_id])
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6 col-sm-12 col-xs-12">
            @include('business.staff_meetings.results')
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6 col-sm-12 col-xs-12">
            @include('business.staff_meetings.strategic')
            @include('business.staff_meetings.admin')
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12" id="edit-activities">
        </div>
    </div>
</div>

<script>
    $(() => {
        $('#close-planning').on('click', () => {
            let msg = 'Está seguro que desea cambiar la planificación a estado: ' + '{{ \App\Models\Business\StaffMeeting::STATUS_NEXT[$meeting->status] }}';
            confirmModal(msg, () => {
                pushRequest('{{ route('update.staff', $meeting->id) }}', null, null, 'put', {
                    _token: '{{ csrf_token() }}',
                    status: '{{ \App\Models\Business\StaffMeeting::STATUS_NEXT[$meeting->status] }}'
                });
            });
        })

        @if($meeting->status != \App\Models\Business\StaffMeeting::STATUS_CLOSED)
        var quill = new Quill('#editor', {
            theme: 'snow',
            bounds: '#editor',
            modules: {
                toolbar: [[{
                    header: [1, 2, 3, !1]
                }], [{
                    font: []
                }], ['bold', 'italic', 'underline'], [{
                    list: 'ordered'
                }, {
                    list: 'bullet'
                }, {
                    align: []
                }], ['link'], [{
                    color: []
                }, {
                    background: []
                }], ['clean']]
            }
        });
        @endif

        var viewModel = function () {
            var self = this;
            self.show = ko.observable(false);

            self.showEditor = () => {
                self.show(true)
            }

            self.hideEditor = () => {
                self.show(false)
            }
        }

        var vm = new viewModel();
        ko.applyBindings(vm, document.getElementById('editor-content'));

        $('#btn-note').on('click', function () {
            vm.showEditor(true);
        })

        $('#btn-save-note').on('click', () => {
            pushRequest('{{ route('update.staff', $meeting->id) }}', null, null, 'put', {
                _token: '{{ csrf_token() }}',
                description: quill.root.innerHTML
            });
        })

        $('.collapse-link').on('click', function () {
            var $BOX_PANEL = $(this).closest('.x_panel'),
                $ICON = $(this).find('i'),
                $BOX_CONTENT = $BOX_PANEL.find('.x_content');

            // fix for some div with hardcoded fix class
            if ($BOX_PANEL.attr('style')) {
                $BOX_CONTENT.slideToggle(200, function () {
                    $BOX_PANEL.removeAttr('style');
                });
            } else {
                $BOX_CONTENT.slideToggle(200);
                $BOX_PANEL.css('height', 'auto');
            }

            $ICON.toggleClass('fa-chevron-up fa-chevron-down');
        });

    });
</script>
