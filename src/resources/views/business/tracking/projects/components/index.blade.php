@permission('index.project_components.tracking')
<div class="page-title">
    <div class="col-md-11 col-sm-11 col-xs-11">
        <h3>{{ trans('components.title_tracking') }}</h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-list-alt"></i> {{ trans('indicator_tracking.labels.projects_list') }}
                </h2>
                <div class="clearfix"></div>
            </div>
            @permission('data.index.project_components.tracking')
            <div class="x_content">
                <table class="table" id="projects_tb">
                    <thead>
                    <tr>
                        <th></th>
                        <th><b>{{ trans('projects.labels.code') }}</b></th>
                        <th><b>{{ trans('app.headers.name') }}</b></th>
                        <th><b>{{ trans('projects.labels.executingUnit') }}</b></th>
                        <th><b>{{ trans('projects.labels.init_date') }}</b></th>
                        <th><b>{{ trans('projects.labels.end_date') }}</b></th>
                        <th><b>{{ trans('app.labels.actions') }}</b></th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="clearfix"></div>
            @endpermission
        </div>
    </div>
</div>

<script>
    $(() => {
        let dataTable = build_datatable($('#projects_tb'), {
            ajax: '{!! route('data.index.project_components.tracking') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false},
                {data: 'full_cup', width: '20%', sortable: false, class: 'text-center'},
                {data: 'name', width: '30%', class: 'text-center'},
                {data: 'executing_unit', width: '20%', class: 'text-center'},
                {data: 'init_date', width: '10%', class: 'text-center'},
                {data: 'end_date', width: '10%', class: 'text-center'},
                {
                    data: 'actions',
                    render: function (data, type, row) {
                        data = $.parseHTML(data, document, true);

                        if (row.components.length === 0) {
                            $('#components' + row.id + '-data' + row.id, data).attr('disabled', 'disabled');
                            $('#components' + row.id + '-data' + row.id, data).attr('data-original-title', '{{ trans('indicator_tracking.labels.no_components') }}');
                        }

                        // data = [comment, text, div]
                        return $(data[2]).get(0).outerHTML;
                    },
                    width: '10%', class: 'text-center', searchable: false, sortable: false
                }
            ]
        });

    });
</script>

@else
    @include('errors.403')
    @endpermission
