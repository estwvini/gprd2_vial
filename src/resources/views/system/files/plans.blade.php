@inject('File', '\App\Models\System\File')
@inject('Plan', '\App\Models\Business\Plan')
<div class="x_title">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plans">
                    <h6>{{ trans('files.labels.plans') }}</h6>
                </label>
                <div class="col-md-9">
                    <div class="input-group">
                        <select class="form-control select2" name="plans" id="plans">
                            <option value="0">{{ trans('files.placeholders.plans') }}</option>
                            @foreach($allPlans as $allPlan)
                                <option value="{{ $allPlan->id }}">{{ $allPlan->name }}</option>
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
        <div class="col-md-6">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="optionPlans">
                    <h6>{{ trans('files.labels.components') }}</h6>
                </label>
                <div class="col-md-9">
                    <div class="input-group">
                        <select class="form-control select2" name="optionPlans" id="optionPlans">
                            <option value="0">{{ trans('files.placeholders.option') }}</option>
                            @foreach($File::FILTER_PLANS as $indicator)
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

        <div class="col-md-12" id="strategicObjectivesPlansDiv" style="display: none">
            <div class="item form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="strategicObjectivesPlans">
                    <h6>{{ trans('files.labels.strategic_objectives') }}</h6>
                </label>
                <div class="col-md-10">
                    <div class="input-group">
                        <select class="form-control select2" name="strategicObjectivesPlans"
                                id="strategicObjectivesPlans">
                            <option value="0">{{ trans('files.placeholders.strategic_objectives') }}</option>
                            @foreach($findAllPlansOperational as $findAllPlanOperational)
                                <option value="{{ $findAllPlanOperational->id }}">{{ $findAllPlanOperational->description }}</option>
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
        <div class="col-md-12" id="operationalGoalsPlansDiv" style="display: none">
            <div class="item form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="operationalGoalsPlans">
                    <h6>{{ trans('files.labels.operational_objectives') }}</h6>
                </label>
                <div class="col-md-10">
                    <div class="input-group">
                        <select class="form-control select2" name="operationalGoalsPlans"
                                id="operationalGoalsPlans">
                            <option value="0">{{ trans('files.placeholders.operational_objectives') }}</option>
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
        <div class="col-md-3" id="yearPlansDiv" style="display: none">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="yearsPlans">
                    <h6>{{ trans('files.labels.select_year') }}</h6>
                </label>
                <div class="col-md-9">
                    <div class="input-group">
                        <select class="form-control select2" name="yearsPlans" id="yearsPlans">
                            <option value="0">{{ trans('files.placeholders.select_year') }}</option>
                            @foreach($years as $year)
                                <option value="{{ $year->id }}">{{ $year->year }}</option>
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
    <table class="table table-striped" id="plans_tb">
        <thead>
        <tr>
            <th></th>
            <th>{{ trans('files.labels.plan') }}</th>
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

        let plansSelect = $('#plans');
        let optionPlansSelect = $('#optionPlans');
        let strategicObjectivesPlansSelect = $('#strategicObjectivesPlans');
        let operationalGoalsPlansSelect = $('#operationalGoalsPlans');
        let yearsPlansSelect = $('#yearsPlans');

        let dataTablePlans = build_datatable($('#plans_tb'), {
            ajax: {
                url: '{!! route('data_plans.index.files') !!}',
                data: (d) => {
                    return $.extend({}, d, {
                        plansSelect: !plansSelect.find('option:selected').val() ? '' : plansSelect.find('option:selected').val(),
                        optionPlansSelect: !optionPlansSelect.find('option:selected').val() ? '' : optionPlansSelect.find('option:selected').val(),
                        strategicObjectivesPlansSelect: !strategicObjectivesPlansSelect.find('option:selected').val() ? '' : strategicObjectivesPlansSelect.find('option:selected').val(),
                        operationalGoalsPlansSelect: !operationalGoalsPlansSelect.find('option:selected').val() ? '' : operationalGoalsPlansSelect.find('option:selected').val(),
                        yearsPlansSelect: !yearsPlansSelect.find('option:selected').val() ? '' : yearsPlansSelect.find('option:selected').val()
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
                {data: 'plan', width: '10%', sortable: true, searchable: true},
                {data: 'name', width: '20%', sortable: true, searchable: true},
                {data: 'user', width: '20%', sortable: true, searchable: true},
                {data: 'created_at', width: '20%', sortable: true, searchable: true},
                {data: 'references_number', width: '10%', sortable: true, searchable: true},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

        // Initialize clear selection buttons
        $('.input-group').each((index, element) => {
            let criterionSelectPlans = $(element).find('select');
            let criterionClearButtonPlans = $(element).find('span.input-group-addon');

            criterionClearButtonPlans.on('click', () => {
                criterionSelectPlans.val('0').trigger('change');
            })
        });

        plansSelect.on('change', () => {

            $('#optionPlans').html('');
            $('#optionPlans').append('<option value="0">{{ html_entity_decode(trans("files.placeholders.option")) }}</option>');

            let dataSelect;

            if ($('#plans :selected').text() == '{{ $Plan::TYPE_PEI }}') {
                dataSelect = @json($File::FILTER_PLANS_PEI);
            } else {
                dataSelect = @json($File::FILTER_PLANS);
            }

            $.each(dataSelect, (index, value) => {
                index++;
                $('#optionPlans').append("<option value=" + index + ">" + value + "</option>");
            });

            dataTablePlans.draw();
        });

        strategicObjectivesPlansSelect.on('change', () => {
            searchOperationalGoals(strategicObjectivesPlansSelect.val());
            if (strategicObjectivesPlansSelect.val() != {{ $File::FILTER_ZERO }}) {
                $('#operationalGoalsPlansDiv').show();
            } else {
                $('#operationalGoalsPlansDiv').hide();
                $('#strategicObjectivesPlansDiv').hide();
                $('#yearPlansDiv').hide();
            }
            dataTablePlans.draw();
        });

        optionPlansSelect.on('change', () => {
            // Show year filters
            if (optionPlansSelect.val() == {{ $File::FILTER_THREE }}) {
                $('#strategicObjectivesPlansDiv').show();
            } else {
                $('#strategicObjectivesPlansDiv').hide();
                $('#operationalGoalsPlansDiv').hide();
                $('#yearPlansDiv').hide();
            }
            dataTablePlans.draw();
        });

        /**
         * Buscar procedimientos de compras públicas
         */
        let searchOperationalGoals = (ObjectiveId) => {

            $('#operationalGoalsPlans').html('');
            $('#operationalGoalsPlans').append('<option value="0">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            pushRequest('{{ route('search_operational_goals_plans.index.files') }}', null, (response) => {

                $.each(response, (index, value) => {
                    $('#operationalGoalsPlans').append("<option value=" + value.id + ">" + value.name + "</option>");
                });
            }, 'get', {
                ObjectiveId: ObjectiveId
            }, false);
        };

        operationalGoalsPlansSelect.on('change', () => {
            if (operationalGoalsPlansSelect.val() != {{ $File::FILTER_ZERO }}) {
                $('#yearPlansDiv').show();
            } else {
                $('#yearPlansDiv').hide();
            }
            dataTablePlans.draw();
        });

        yearsPlansSelect.on('change', () => {
            dataTablePlans.draw();
        });

    });
</script>