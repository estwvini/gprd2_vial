@inject('File', '\App\Models\System\File')
<div class="x_title">
    <div class="row">
        <div class="col-md-7">
            <div class="item form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="projectsProjects">
                    <h6>{{ trans('files.labels.projects') }}</h6>
                </label>
                <div class="col-md-10">
                    <div class="input-group">
                        <select class="form-control select2" name="projectsProjects" id="projectsProjects">
                            <option value="0">{{ trans('files.placeholders.projects') }}</option>
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
        <div class="col-md-5">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="componentsProjects">
                    <h6>{{ trans('files.labels.components') }}</h6>
                </label>
                <div class="col-md-9">
                    <div class="input-group">
                        <select class="form-control select2" name="componentsProjects" id="componentsProjects">
                            <option value="0">{{ trans('files.placeholders.option') }}</option>
                            @foreach($File::FILTER_PROJECTS as $indicator)
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
    </div>
    <div class="clearfix"></div>
</div>
<div class="x_content">
    <table class="table table-striped" id="projects_tb">
        <thead>
        <tr>
            <th></th>
            <th>{{ trans('files.labels.projects') }}</th>
            <th>{{ trans('files.labels.name') }}</th>
            <th>{{ trans('files.labels.user') }}</th>
            <th>{{ trans('files.labels.creation_date') }}</th>
            <th>{{ trans('files.labels.references_number') }}</th>
            <th></th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        $('.select2').select2({});

        let projectsProjectsSelect = $('#projectsProjects');
        let componentsProjectsSelect = $('#componentsProjects');

        let dataTableProject = build_datatable($('#projects_tb'), {
            ajax: {
                url: '{!! route('data_projects.index.files') !!}',
                data: (d) => {
                    return $.extend({}, d, {
                        projectsProjectsSelect: !projectsProjectsSelect.find('option:selected').val() ? '' : projectsProjectsSelect.find('option:selected').val(),
                        componentsProjectsSelect: !componentsProjectsSelect.find('option:selected').val() ? '' : componentsProjectsSelect.find('option:selected').val()
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
                {data: 'project', width: '30%', sortable: true, searchable: true},
                {data: 'name', width: '30%', sortable: true, searchable: true},
                {data: 'user', width: '30%', sortable: true, searchable: true},
                {data: 'created_at', width: '20%', sortable: true, searchable: true},
                {data: 'references_number', width: '10%', sortable: true, searchable: true},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

        // Initialize clear selection buttons
        $('.input-group').each((index, element) => {
            let criterionSelectProjects = $(element).find('select');
            let criterionClearButtonProjects = $(element).find('span.input-group-addon');

            criterionClearButtonProjects.on('click', () => {
                criterionSelectProjects.val(0).trigger('change');
            })
        });

        projectsProjectsSelect.on('change', () => {
            dataTableProject.draw();
        });

        componentsProjectsSelect.on('change', () => {
            dataTableProject.draw();
        });

    });
</script>