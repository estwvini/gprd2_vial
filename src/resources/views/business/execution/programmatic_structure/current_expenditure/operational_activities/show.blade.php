@permission('show.operational_activities.current_expenditure_elements.programmatic_structure.execution')
@inject('AdminActivity', 'App\Models\Business\AdminActivity' )

<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('operational_activities.labels.details') }}</h2>

        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <form role="form" method="post" class="form-horizontal form-label-left">

                    <div class="pb-4">{!! $route !!}</div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_code">
                            {{ trans('operational_activities.labels.code') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input disabled name="element_code" id="element_code" maxlength="45"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('operational_activities.placeholders.code') }}"
                                   value="{{ $entity->code }}" disabled/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_name">
                            {{ trans('operational_activities.labels.name') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input disabled name="element_name" id="element_name" maxlength="500"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('operational_activities.placeholders.name') }}"
                                   value="{{ $entity->name }}"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="responsible_unit_id">
                            {{ trans('operational_activities.labels.responsibleUnit') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select disabled class="form-control select2" id="responsible_unit_id" name="responsible_unit_id">
                                <option value=""></option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" @if($department->id === $entity->responsible_unit_id) selected @endif>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="executing_unit_id">
                            {{ trans('operational_activities.labels.executingUnit') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select disabled class="form-control select2" id="executing_unit_id" name="executing_unit_id">
                                <option value=""></option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" @if($department->id === $entity->executing_unit_id) selected @endif>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pull-right">
                        @permission('store.create.admin_activities.execution')
                        <button id="adminActivityBtn" type="button" class="btn btn-primary"><i class="fa fa-arrow-up">
                            </i> {{ trans('admin_activities.labels.admin_tracking') }}</button>
                        @endpermission
                        <button id="acceptBtn" type="button" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.accept') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

        let selectInputs = $('.select2')

        // Initialize selects
        selectInputs.select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        })

        let clear = () => {
            $('#load-area').empty()

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })
        };

        $('#acceptBtn').click(() => {
            clear();
        })

        $('#adminActivityBtn').on('click', () => {
            pushRequest('{{ route('store.create.admin_activities.execution') }}', null, () => {
                clear();
            }, 'post', {
                _token: '{{ csrf_token() }}',
                activity: {
                    name: '{{ $entity->name }}',
                    assigned_user_id: '{{ currentUser()->id }}',
                    status: '{{ $AdminActivity::STATUS_DRAFT }}',
                    priority: '{{ $AdminActivity::PRIORITY_MEDIUM }}'
                }
            });
        });
    })
</script>

@else
    @include('errors.403')
    @endpermission