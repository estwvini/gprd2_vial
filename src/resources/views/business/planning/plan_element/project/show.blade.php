@permission('show.project.plan_elements.plans.plans_management')
<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('projects.labels.edit') }}</h2>

        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <form role="form" method="post"
                      enctype="multipart/form-data"
                      class="form-horizontal form-label-left" id="projectFormEdit">

                    <div class="pb-4">{!! $route !!}</div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="project_name">
                            {{ trans('plan_elements.labels.project_name') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="name" id="project_name" maxlength="100"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('projects.placeholders.name') }}" autocomplete="off"
                                   value="{{ $entity->name }}" disabled/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="cup">
                            {{ trans('projects.labels.cup') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="number" name="cup" id="cup" maxlength="3"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('projects.placeholders.cup') }}" autocomplete="off"
                                   value="{{ $entity->cup }}" disabled/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="description">
                            {{ trans('plan_elements.labels.description') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="description" id="description" class="form-control" disabled>{{ $entity->description }}</textarea>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="is_road">
                            {{ trans('plan_elements.labels.isRoad') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input disabled type="checkbox" name="is_road" id="is_road" class="js-switch" @if($entity->is_road) checked @endif/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="responsible_unit_id">
                            {{ trans('plan_elements.labels.responsibleUnit') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select disabled class="form-control select2 select2_type" id="responsible_unit_id" name="responsible_unit_id">
                                <option value="">{{ trans('app.labels.select') }}</option>
                                @foreach($responsibleUnits as $value)
                                    <option value="{{ $value->id }}" @if($entity->responsible_unit_id == $value->id) selected @endif >{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="zone">
                            {{ trans('projects.labels.zone') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="zone" id="zone" maxlength="100"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('projects.placeholders.zone') }}" autocomplete="off"
                                   value="{{ $entity->zone }}" disabled/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="date_init">
                            {{ trans('projects.labels.init_date') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="date_init" id="date_init"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" DD-MM-YYYY" autocomplete="off" readonly
                                   value="{{ date('d-m-Y', strtotime($entity->date_init)) }}" disabled/>
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="date_end">
                            {{ trans('projects.labels.end_date') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="date_end" id="date_end"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" DD-MM-YYYY" autocomplete="off" readonly
                                   value="{{ date('d-m-Y', strtotime($entity->date_end)) }}" disabled/>
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="month_duration">
                            {{ trans('projects.labels.month_duration') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="month_duration" id="month_duration" maxlength="100"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   disabled
                                   value="{{ $entity->month_duration }}"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="execution_term">
                            {{ trans('projects.labels.execution_term') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="execution_term" id="execution_term" maxlength="100"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   disabled
                                   value="{{ $entity->execution_term }}"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="tir">
                            {{ trans('projects.labels.tir') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="tir" id="tir"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   value="{{ $entity->tir }}" disabled/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="van">
                            {{ trans('projects.labels.van') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="van" id="van"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   value="{{ $entity->van }}" disabled/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="benefit_cost">
                            {{ trans('projects.labels.benefit_cost') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="benefit_cost" id="benefit_cost"
                                      class="form-control col-md-7 col-sm-7 col-xs-12"
                                      disabled placeholder="{{ trans('projects.placeholders.benefit_cost') }}">{{ $entity->benefit_cost }}</textarea>
                        </div>
                    </div>

                    <fieldset id="budgets_fieldset" class="mt-5">
                        <legend class="scheduler-border">{{ trans('projects.labels.annual_budgets') }}</legend>
                        <div id="load_annual_budgets">
                            @foreach($annualBudgets as $i => $budget)
                                <div class="item form-group">
                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="budgets">
                                        {{ trans('projects.labels.year') }} {{ ($i + 1) }} <span class="required text-danger">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" name="budgets[{{ $i }}]" id="budgets[{{ $i }}]" maxlength="16"
                                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                                   value="{{ $budget['pivot']['referential_budget'] }}"
                                                   disabled
                                            />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="referential_budget">
                                {{ trans('projects.labels.referential_budget') }}
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input name="referential_budget" id="referential_budget" maxlength="100"
                                           class="form-control col-md-7 col-sm-7 col-xs-12"
                                           disabled
                                           value="{{ $entity->referential_budget }}"/>
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <div class="pull-right">
                        <button id="acceptBtn" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.accept') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

        $('input[id*="budgets"]').each((index, element) => {
            $(element).number(true, 2)
        });

        $('#referential_budget').number(true, 2)

        $('#acceptBtn').click(() => {
            $('#load-area').empty();

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })
        })

    });

</script>

@endpermission