@inject('AdminActivity', 'App\Models\Business\AdminActivity')
@inject('ActivityType', 'App\Models\Business\Catalogs\ActivityType')

<div class="row">
    <div class="form-group col-md-2 col-xs-12">
        <label class="control-label" for="responsible_unit_id">
            {{ trans('admin_activities.labels.responsible_unit') }}
        </label>
        <select class="form-control select2-filter" id="responsible_unit_id">
            <option value="">{{ trans('app.labels.all') }}</option>
            @foreach($responsibleUnits as $unit)
                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-2 col-xs-12">
        <label class="control-label" for="assigned_user_id_filter">
            {{ trans('admin_activities.labels.assigned') }}
        </label>
        <select class="form-control select2-filter" id="assigned_user_id_filter">
            <option value="">{{ trans('app.labels.all') }}</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->fullName() }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-2 col-xs-12">
        <label class="control-label" for="activity_type_id_filter">
            {{ trans('admin_activities.labels.activity_type') }}
        </label>
        <select class="form-control select2-filter" id="activity_type_id_filter">
            <option value="">{{ trans('app.labels.all') }}</option>
            @foreach($ActivityType::all() as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-2 col-xs-12">
        <label class="control-label" for="status-filter">
            {{ trans('admin_activities.labels.status') }}
        </label>
        <select class="form-control select2-filter" id="status-filter">
            <option value="">{{ trans('app.labels.all') }}</option>
            @foreach($AdminActivity::STATUS as $status)
                <option value="{{ $status }}">{{ trans('admin_activities.labels.status_' . $status) }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-2 col-xs-12">
        <label class="control-label" for="priority-filter">
            {{ trans('admin_activities.labels.priority') }}
        </label>
        <select class="form-control select2-filter" id="priority-filter">
            <option value="">{{ trans('app.labels.all') }}</option>
            @foreach($AdminActivity::PRIORITIES as $priority)
                <option value="{{ $priority }}">{{ trans('admin_activities.labels.priority_' . $priority) }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mt-2 mb-3">
    <div class="item form-group">
        <label class="control-label col-md-1 col-sm-1 col-xs-1" for="assigned_by_me">
            {{ trans('admin_activities.labels.assigned_by_me') }}
        </label>
        <div class="col-md-1 col-sm-1 col-xs-1">
            <input type="checkbox" id="assigned_by_me" class="js-switch"/>
        </div>
    </div>
</div>
<table class="table h30 click" id="activities_tb">
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th>{{ trans('admin_activities.labels.assigned') }}</th>
        <th>{{ trans('admin_activities.labels.responsibleUnit') }}</th>
        <th>{{ trans('admin_activities.labels.activity') }}</th>
        <th>{{ trans('admin_activities.labels.status') }}</th>
        <th>{{ trans('admin_activities.labels.priority') }}</th>
        <th>{{ trans('admin_activities.labels.date_init') }}</th>
        <th>{{ trans('admin_activities.labels.date_end') }}</th>
    </tr>
    </thead>
</table>

<script>
    $(() => {
        let $table = build_datatable($('#activities_tb'), {
            lengthMenu: [50, 75, 100],
            ajax: {
                url: '{!! route('data.index.admin_activities.execution') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            responsible_unit_id: $('#responsible_unit_id').val(),
                            assigned_user_id: $('#assigned_user_id_filter').val(),
                            activity_type_id: $('#activity_type_id_filter').val(),
                            status: $('#status-filter').val(),
                            priority: $('#priority-filter').val(),
                            assigned_by_me: $('#assigned_by_me').is(":checked")
                        }
                    });
                }
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'photo', width: '5%'},
                {data: 'assigned_user_id', width: '20%'},
                {data: 'responsibleUnit', width: '20%'},
                {data: 'name', width: '30%'},
                {data: 'status', width: '10%'},
                {data: 'priority', width: '10%'},
                {data: 'date_init', width: '10%', class: 'text-center'},
                {data: 'date_end', width: '5%', class: 'text-center'}
            ]
        });

        $('#activities_tb tbody').on('click', 'tr', (e) => {
            let data = $table.row(e.currentTarget).data();
            let url = '{{ route('edit.admin_activities.execution', ['id' => '__ID__']) }}'
            url = url.replace('__ID__', data['id']);
            pushRequest(url);
        });

        $('.select2-filter').select2({}).on('change', () => {
            $table.draw();
        });

        $('#assigned_by_me').on('change', () => {
            $table.draw();
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
                default:
                    return "{{ trans('app.labels.all') }}"
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
                default:
                    return "{{ trans('app.labels.all') }}"
            }
        };

        $('#status-filter').select2({
            minimumResultsForSearch: -1,
            templateSelection: formatStatus,
            templateResult: formatStatus
        });

        $('#priority-filter').select2({
            minimumResultsForSearch: -1,
            templateSelection: formatPriority,
            templateResult: formatPriority
        });
    });
</script>