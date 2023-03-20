@inject('File', '\App\Models\System\File')
<div class="x_title">
    <div class="row">
        <div class="col-md-4">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="componentsTracking">
                    <h6>{{ trans('files.labels.components') }}</h6>
                </label>
                <div class="col-md-9">
                    <div class="input-group">
                        <select class="form-control select2" name="componentsTracking" id="componentsTracking">
                            <option value="0">{{ trans('files.placeholders.components') }}</option>
                            @foreach($File::FILTER_TRACKING as $indicator)
                                <option value="{{ $loop->iteration }}">{{ $indicator }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-addon clear-selection"
                              data-toggle="tooltip"
                              data-placement="right"
                              data-original-title="{{ trans('app.labels.clear_selection') }}">
                            <span class="glyphicon glyphicon-erase"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7" id="projectsTrackingDiv" style="display: none">
            <div class="item form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="projectsTracking">
                    <h6>{{ trans('files.labels.projects') }}</h6>
                </label>
                <div class="col-md-10">
                    <div class="input-group">
                        <select class="form-control select2" name="projectsTracking" id="projectsTracking">
                            <option value="0">{{ trans('files.placeholders.option') }}</option>
                            @foreach($allProjects as $allProject)
                                <option value="{{ $allProject->id }}">{{ $allProject->name }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-addon clear-selection"
                              data-toggle="tooltip"
                              data-placement="right"
                              data-original-title="{{ trans('app.labels.clear_selection') }}">
                            <span class="glyphicon glyphicon-erase"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="x_content">
    <table class="table table-striped" id="tracking_tb">
        <thead>
        <tr>
            <th></th>
            <th>{{ trans('files.labels.name') }}</th>
            <th>{{ trans('files.labels.user') }}</th>
            <th>{{ trans('files.labels.creation_date') }}</th>
            <th></th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        $('.select2').select2({});

        let componentsTrackingSelect = $('#componentsTracking');
        let projectsTrackingSelect = $('#projectsTracking');

        let dataTableProject = build_datatable($('#tracking_tb'), {
            ajax: {
                url: '{!! route('data_tracking.index.files') !!}',
                data: (d) => {
                    return $.extend({}, d, {
                        componentsTrackingSelect: !componentsTrackingSelect.find('option:selected').val() ? '' : componentsTrackingSelect.find('option:selected').val(),
                        projectsTrackingSelect: !projectsTrackingSelect.find('option:selected').val() ? '' : projectsTrackingSelect.find('option:selected').val()
                    });
                },
                dataSrc: function (response) {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '30%', sortable: true, searchable: true},
                {data: 'user', width: '30%', sortable: true, searchable: true},
                {data: 'created_at', width: '20%', sortable: true, searchable: true},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

        // Initialize clear selection buttons
        $('.input-group').each((index, element) => {
            let criterionSelectTracking = $(element).find('select');
            let criterionClearButtonTracking = $(element).find('span.input-group-addon');

            criterionClearButtonTracking.on('click', () => {
                criterionSelectTracking.val(0).trigger('change');
            })
        });

        componentsTrackingSelect.on('change', () => {
            if (componentsTrackingSelect.val() == {{ $File::FILTER_TWO }}) {
                $('#projectsTrackingDiv').show();
            } else {
                $('#projectsTrackingDiv').hide();
            }
            dataTableProject.draw();
        });

        projectsTrackingSelect.on('change', () => {
            dataTableProject.draw();
        });

    });
</script>