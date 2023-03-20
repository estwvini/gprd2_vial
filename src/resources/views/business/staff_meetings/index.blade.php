@permission('index.staff')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('staff_meetings.title') }}</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-md-1">
                        <select name="" id="year" class="select2">
                            <option></option>
                            <option value="0">{{ trans('app.labels.year') }}</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <select name="" id="week" class="select2">
                            <option></option>
                            <option value="0">{{ trans('staff_meetings.labels.week') }}</option>
                            @foreach(range(1,52) as $week)
                                <option value="{{ $week }}">{{ $week }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="" id="department" class="select2">
                            <option></option>
                            <option value="0">{{ trans('staff_meetings.labels.department') }}</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <form action="{{ route('store.staff') }}" method="POST" id="staff_fm">
                            @csrf
                            <button type="submit" class="btn btn-box-tool pull-right">
                                <i class="fa fa-plus"></i> {{ trans('app.labels.create') }}
                            </button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped" id="meeting_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('staff_meetings.labels.week') }}</th>
                            <th>{{ trans('staff_meetings.labels.department') }}</th>
                            <th>{{ trans('app.headers.date_init') }}</th>
                            <th>{{ trans('app.headers.date_end') }}</th>
                            <th>{{ trans('app.headers.status') }}</th>
                            <th>{{ trans('app.labels.actions') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        let datatable = build_datatable($('#meeting_tb'), {
            ajax: {
                url: '{!! route('data.index.staff') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        year: $("#year").val(),
                        week: $("#week").val(),
                        department: $("#department").val(),
                    });
                },
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'week', width: '5%', sortable: true, searchable: true},
                {data: 'department.name', width: '30%', sortable: true, searchable: true},
                {data: 'start', width: '20%', sortable: true, searchable: true, class: 'text-center'},
                {data: 'end', width: '20%', sortable: true, searchable: true, class: 'text-center'},
                {data: 'status', width: '10%', sortable: true, searchable: true, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });
        $('#staff_fm').ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response);
                datatable.draw();
            }
        }));

        $('#year').select2({
            placeholder: "{{ trans('app.labels.year') }}",
        }).on('change', (e) => {
            datatable.draw();
        });
        $('#week').select2({
            placeholder: "{{ trans('staff_meetings.labels.week') }}",
        }).on('change', (e) => {
            datatable.draw();
        });
        $('#department').select2({
            placeholder: "{{ trans('staff_meetings.labels.department') }}",
        }).on('change', (e) => {
            datatable.draw();
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission