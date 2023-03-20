@inject('Role', '\App\Models\System\Role')
@inject('Project', '\App\Models\Business\Project')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" id="panel-profile">
            <div class="x_title">
                <h2><i class="fa fa-product-hunt"></i> {{ trans('projects.labels.editProfile') }}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                        <a href="{{ $urlBack }}" class="btn btn-box-tool ajaxify">
                            <i class="fa fa-times"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="x_panel well-lg">
                        <b>{{ trans('plan_elements.labels.OBJECTIVE') . ' ' . trans('projects.labels.strategic') }}
                            : </b>{{ $entity->subprogram->parent->parent->code . ' - ' . $entity->subprogram->parent->parent->description }}
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="x_panel well-lg">
                        <b>{{ trans('plan_elements.labels.PROGRAM') }}: </b>{{ $entity->subprogram->parent->code . ' - ' . $entity->subprogram->parent->description }}
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="x_panel well-lg">
                        <b>{{ trans('plan_elements.labels.SUBPROGRAM') }}: </b>{{ $entity->subprogram->code . ' - ' . $entity->subprogram->description }}
                    </div>
                </div>
            </div>

            <div class="x_content">
                <form role="form" action="{{ $url }}" method="post"
                      class="form-label-left" id="projects_update_fm" novalidate>

                    @method('PUT')
                    @csrf
                    <input type="hidden" value="profile" name="action_type">
                    <input type="hidden" value="0" name="edit_budget">


                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label" for="project_name">
                                {{ trans('app.headers.name') }} <span class="required text-danger">*</span>
                            </label>
                            <input type="text" id="project_name" name="name" maxlength="200" placeholder="{{ trans('projects.placeholders.name') }}" autocomplete="off"
                                   class="form-control" value="{{ $entity->name ?? ''}}"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                            <label class="control-label" for="cup">
                                {{ trans('projects.labels.cup') }}
                            </label>
                            <input type="text" id="cup" disabled
                                   class="form-control" value="{{ $entity->cup ?? '' }}"/>
                        </div>

                        <div class="form-group  col-md-3 col-sm-3 col-xs-12">
                            <label class="control-label" for="initial_budget">
                                {{ trans('projects.labels.initial_budget') }}
                            </label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" disabled id="initial_budget"
                                       class="form-control" value="{{ $entity->referential_budget ?? '' }}"/>
                            </div>
                        </div>

                        <div class="form-group  col-md-3 col-sm-3 col-xs-12">
                            <label class="control-label" for="month_duration">
                                {{ trans('projects.labels.month_duration') }}
                            </label>
                            <input type="text" id="month_duration" disabled class="form-control" value="{{ $entity->month_duration }}"/>
                        </div>

                        <div class="row">
                            <div class="form-group  col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="execution_term">
                                    {{ trans('projects.labels.execution_term') }}
                                </label>
                                <input type="text" id="execution_term" disabled class="form-control" value="{{ $entity->execution_term }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group  col-md-3 col-sm-3 col-xs-12">
                            <label class="control-label" for="created_at">
                                {{ trans('projects.labels.registration_date') }}
                            </label>
                            <input type="text" id="created_at" disabled class="form-control" value="{{ formatDate($entity->created_at, 'd-m-Y') }}"/>
                        </div>

                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                            <label class="control-label" for="date_init">
                                {{ trans('projects.labels.init_date') }}
                            </label>
                            <input type="text" id="date_init" disabled class="form-control" value="{{ formatDate($entity->date_init, 'd-m-Y') }}"/>
                        </div>

                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                            <label class="control-label" for="date_end">
                                {{ trans('projects.labels.end_date') }}
                            </label>
                            <input type="text" id="date_end" disabled class="form-control" value="{{ formatDate($entity->date_end, 'd-m-Y') }}"/>
                        </div>

                        <div class="form-group col-md-3 col-sm-3 col-xs-12 mt-5">
                            <label class="control-label " for="is_road">
                                {{ trans('projects.labels.is_road') }}
                            </label>
                            <input type="checkbox" id="is_road" class="js-switch form-control" disabled readonly @if($entity->is_road) checked @endif/>
                            <input type="hidden" name="is_road" value="@if($entity->is_road) on @endif">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group  col-md-3 col-sm-3 col-xs-12">
                            <label class="control-label" for="tir">
                                {{ trans('projects.labels.tir') }}
                            </label>
                            <input type="text" id="tir" disabled class="form-control" value="{{ $entity->tir }}"/>
                        </div>

                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                            <label class="control-label" for="van">
                                {{ trans('projects.labels.van') }}
                            </label>
                            <input type="text" id="van" disabled class="form-control" value="{{ $entity->van }}"/>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="date_end">
                                {{ trans('projects.labels.benefit_cost') }}
                            </label>
                            <textarea id="benefit_cost" disabled
                                      class="form-control">{{ $entity->benefit_cost }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="description">
                                {{ trans('app.headers.description') }}
                            </label>
                            <textarea name="description" id="description" class="form-control" disabled>{{ $entity->description ?? '' }}</textarea>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="responsibleUnit">
                                {{ trans('projects.labels.responsibleUnit') }}
                            </label>
                            <input type="text" id="responsibleUnit" disabled class="form-control" value="{{ $entity->responsibleUnit->name }}"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label" for="operational_goal_id">
                                {{ trans('projects.labels.operational_goal') }} <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2" id="operational_goal_id" name="operational_goal_id" required>
                                <option value=""></option>
                                @foreach($operationalGoals as $item)
                                    <option value="{{ $item->id }}"
                                            @if($item->id == $entity->operational_goal_id) selected @endif>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="executing_unit_id">
                                {{ trans('projects.labels.executingUnit') }} <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2" id="executing_unit_id" name="executing_unit_id" required
                                    @if(in_array($entity->status, [$Project::STATUS_IN_PROGRESS]) || currentUser()->hasRole($Role::LEADER))
                                        disabled
                                @endif >
                                <option value=""></option>
                                @foreach($executingUnits as $eu)
                                    <option value="{{ $eu->id }}" @if($eu->id == $entity->executing_unit_id) selected @endif>
                                        {{ $eu->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="leader_id">
                                {{ trans('projects.labels.leader') }} <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2" id="leader_id" required name="leader_id"
                                    @if(currentUser()->roles[0]->slug === $Role::LEADER)
                                        disabled
                                    @else
                                        @if(count($users) == 0) disabled @endif
                                @endif>
                                <option value=""></option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if($leader && $user->id == $leader->id) selected @endif>
                                        {{ $user->fullName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="qualitative_benefit">
                                {{ trans('projects.labels.qualitative_benefit') }} <span class="text-danger">*</span>
                            </label>
                            <textarea name="qualitative_benefit" id="qualitative_benefit" class="form-control" required
                                      placeholder="{{ trans('projects.placeholders.qualitative_benefit') }}">{{ $entity->qualitative_benefit ?? '' }}</textarea>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="requirements">
                                {{ trans('projects.labels.requirements') }}
                            </label>
                            <textarea name="requirements" id="requirements" class="form-control"
                                      placeholder="{{ trans('projects.placeholders.requirements') }}">{{ $entity->requirements ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="product_description_service">
                                {{ trans('projects.labels.product_description_service') }} <span class="text-danger">*</span>
                            </label>
                            <textarea name="product_description_service" id="product_description_service" class="form-control" required
                                      placeholder="{{ trans('projects.placeholders.product_description_service') }}">{{ $entity->product_description_service ?? '' }}</textarea>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="approval_criteria">
                                {{ trans('projects.labels.approval_criteria') }}
                            </label>
                            <textarea name="approval_criteria" id="approval_criteria" class="form-control"
                                      placeholder="{{ trans('projects.placeholders.approval_criteria') }}">{{ $entity->approval_criteria ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="general_risks">
                                {{ trans('projects.labels.general_risks') }}
                            </label>
                            <textarea name="general_risks" id="general_risks" class="form-control"
                                      placeholder="{{ trans('projects.placeholders.general_risks') }}">{{ $entity->general_risks ?? '' }}</textarea>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="phase">
                                {{ trans('projects.labels.phase') }} <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2" id="phase" name="phase">
                                <option value="">{{ trans('app.placeholders.select') }}</option>
                                @foreach($projectPhases as $pP => $projectPhase)
                                    <option value="{{ $pP }}" @if($pP === $entity->phase) selected @endif>
                                        {{ $projectPhase }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a href="{{ $urlBack }}" class="btn btn-info ajaxify">
                            <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-success" id="submitBtn">
                            <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        })

        let executingUnit = $('#executing_unit_id').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {
            validator.element("#executing_unit_id");

            leader.html('');
            leader.prop("disabled", true);
            leader.append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            let url = '{{ route($urlLoadUsers, ['departmentId'=> '__ID__']) }}';
            url = url.replace('__ID__', executingUnit.val());

            pushRequest(url, null, (response) => {
                let opt = [];
                $.each(response, (index, value) => {
                    opt.push({
                        id: value.id,
                        text: value.first_name + ' ' + value.last_name
                    });
                });
                leader.select2({
                    data: opt
                });
                leader.prop("disabled", false);
            }, 'get', null, false)
        });

        let leader = $('#leader_id').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {
            validator.element("#leader_id");
        });

        let $form = $('#projects_update_fm');

        $validateDefaults.rules = {
            name: {
                required: true,
                maxlength: 200,
                minlength: 3
            }
        };
        $validateDefaults.messages = {
            name: {
                remote: '{{ trans('projects.messages.validation.project_name_exists') }}'
            }
        };

        let validator = $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);

        var stack_center = {
            "dir1": "up",
            "dir2": "left",
            "firstpos1": 40,
            "firstpos2": ($(window).width() / 2) - (Number(PNotify.prototype.options.width.replace(/\D/g, '')) / 2)
        };

        $("#submitBtn").on('click', () => {
            if (!$form.valid()) {

                notify("{{ trans('projects.messages.validation.required_fields') }}", 'error', "Error", {
                    stack: stack_center,
                    addclass: 'stack-bottomright',
                    nonblock: {nonblock: !0},
                    delay: 5000,
                    buttons: {
                        sticker: false,
                        closer: false,
                    }
                });
            }
        });

    });
</script>
