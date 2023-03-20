@permission('approve.plans.plans_management')

@include('business.planning.partials.justification.form', ['form' => true, 'action' => ($scope == \App\Models\Business\Plan::SCOPE_TERRITORIAL) ? trans('justifications.actions.verify') : trans('justifications.actions.approve')])

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('plans.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>

        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.plans.plans_management')
                <li>
                    <a href="{{ route('index.plans.plans_management') }}" class="ajaxify"> {{ trans('plans.title') }}</a>
                </li>
                @endpermission

                <li class="active"> @if($scope == \App\Models\Business\Plan::SCOPE_TERRITORIAL) {{ trans('plans.labels.VERIFIED') }} @else {{ trans('plans.labels.APPROVED') }} @endif</li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        @if($scope == \App\Models\Business\Plan::SCOPE_TERRITORIAL) {{ trans('plans.labels.verify') }} @else {{ trans('plans.labels.approve') }} @endif {{ trans('plans.labels.' . $scope) }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        @permission('index.plans.plans_management')
                        <li class="pull-right">
                            <a href="{{ route('index.plans.plans_management') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                        @endpermission
                    </ul>

                    <div class="clearfix"></div>
                </div>


                <form role="form" class="form-horizontal form-label-left" id="businessPlansApproveFm" novalidate>

                    <div class="x_content">

                        <input class="hidden" name="scope" id="scope" value="{{ $scope }}">

                        <span class="section">{{ trans('plans.labels.info') }} {{ trans('plans.labels.' . $scope) }}</span>

                        @if(!$allowApproval)
                            <div class="alert alert-warning align-center" role="alert">
                                {{ trans('plans.messages.warning.approvalNotAllowed.' . $scope) }}
                            </div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                {{ trans('plans.labels.name') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="name" id="name" maxlength="45"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('plans.placeholders.name') }}"
                                       value="{{ $entity->name }}" disabled/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vision">
                                {{ trans('plans.labels.vision') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea disabled name="vision" id="vision" class="form-control col-md-7 col-sm-7 col-xs-12">{{ $entity->vision }}</textarea>
                            </div>
                        </div>

                        @if($scope == \App\Models\Business\Plan::SCOPE_INSTITUTIONAL)
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mission">
                                    {{ trans('plans.labels.mission') }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea disabled name="mission" id="mission" class="form-control col-md-7 col-sm-7 col-xs-12">{{ $entity->mission }}</textarea>
                                </div>
                            </div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_year">
                                {{ trans('plans.labels.startYear') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="start_year" id="startYear" maxlength="4"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('plans.placeholders.startYear') }}"
                                       value="{{ $entity->start_year }}" disabled/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_year">
                                {{ trans('plans.labels.endYear') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="end_year" id="endYear" maxlength="4"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('plans.placeholders.endYear') }}"
                                       value="{{ $entity->end_year }}" disabled/>
                            </div>
                        </div>

                        <div class="separator col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>

                        <div id="load-tree" class="col-lg-5 col-md-5 col-sm-5 col-xs-10 mt-3 pl-0">


                        </div>

                        <div id="load-area" class="col-lg-7 col-md-7 col-sm-7 col-xs-10 mt-3 p-0">

                        </div>

                        <div class="separator col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>

                        <footer class="navbar-default navbar-fixed-bottom text-center">
                            @permission('index.plans.plans_management')
                            <a href="{{ route('index.plans.plans_management') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            @endpermission
                            <button id="btnApprove" class="btn btn-success" @if(!$allowApproval) disabled @endif>
                                <i class="fa fa-check"></i> {{ trans('plans.labels.' . $approvalType) }}
                            </button>
                        </footer>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        const url = '{!! route('loadstructure.approve.plans.plans_management', ['id' => $entity->id]) !!}'

        pushRequest(url, '#load-tree', function () {

        }, 'GET', {'_token': '{!! csrf_token() !!}'});

        @if($allowApproval)
        $('#btnApprove').click((e) => {
            e.preventDefault();

            let callback = (data = null, options = null) => {
                let url = '{!! route ('changestatus.approve.plans.plans_management', ['id' => $entity->id, 'status' => $approvalType] ) !!}';
                pushRequest(url, null, () => {

                }, 'POST', data, false, options);
            };

            justificationModal(callback, {'_token': '{{ csrf_token() }}'}, '{{ trans('plans.messages.confirm.approve.' . $approvalType) }}');
        })
        @endif
    });
</script>

@else
    @include('errors.403')

    @endpermission