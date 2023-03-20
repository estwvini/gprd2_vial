@role('developer')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('configuration.setting.title') }}
                <small>{{ trans('configuration.title') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bars"></i> {{ trans('configuration.setting.title') }}</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped" id="config_settings_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('configuration.setting.labels.key') }}</th>
                            <th>{{ trans('configuration.setting.labels.value') }}</th>
                            <th>{{ trans('app.headers.description') }}</th>
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
    $(function () {
        var $table = $('#config_settings_tb');

        build_datatable($table, {
            ajax: '{!! route('data.index.settings.configuration') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'key', width: '20%'},
                {data: 'value', width: '35%'},
                {data: 'description', width: '35%'},
                {data: 'actions', sortable: false, searchable: false, width: '10%', class: 'text-center'}
            ]
        });

    });
</script>

@else
    @include('errors.403')
@endrole