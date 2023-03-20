@permission('edit.create.threshold')

@inject('PlanIndicator', 'App\Models\Business\PlanIndicator')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('thresholds.threshold.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-thermometer"></i> {{ trans('thresholds.threshold.labels.edit') }}
                    </h2>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form role="form"
                          action="{{ route('update.create.threshold') }}"
                          method="post"
                          class="form-horizontal form-label-left" id="thesholdUpdateFm" novalidate>

                        @method('PUT')
                        @csrf

                        @foreach ($entities as $key => $entity)
                            <input type="hidden" value="{{ $entity->id }}" name="id {{ $key }}">
                            @if($key == 0|| $key == 3|| $key == 6)
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    {{ $PlanIndicator::types()[$entity->type] }}
                                </div>
                                <div class="item form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12 ln_solid"></div>
                                </div>
                            @endif
                            <div class="col-md-6 col-sm-8 col-xs-12 col-sm-offset-2 col-md-offset-3">
                                <div class="form-row">

                                    @if(($key + 1) % 3 == 0)
                                        <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                            <label>{{ trans('thresholds.threshold.labels.acceptable') }}</label>
                                        </div>
                                    @elseif($key==0 || $key==3 || $key == 6)
                                        <div class="form-group col-md-3 col-xs-3">
                                            <label>{{ trans('thresholds.threshold.labels.unacceptable') }}</label>
                                        </div>
                                    @else
                                        <div class="form-group col-md-3 col-xs-3">
                                            <label>{{ trans('thresholds.threshold.labels.alert') }}</label>
                                        </div>

                                    @endif
                                    <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                        <input type="number" name="min {{ $key }}" id="min {{ $key }}"
                                               class="form-control col-md-7 col-sm-10 col-xs-10"
                                               value="{{ $entity->min }}"/>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                        <input type="number" name="max {{ $key }}" id="max {{ $key }}"
                                               class="form-control col-md-7 col-sm-10 col-xs-10"
                                               value="{{ $entity->max }}"/>
                                    </div>
                                    <div class="form-group col-md-1 col-sm-1 col-xs-1">
                                        @if(($key + 1)% 3 == 0)
                                            <label><i class="fa fa-circle fa-2x"
                                                      style="color: #3c763d;"></i></label>
                                        @elseif($key == 0 || $key == 3 || $key == 6)
                                            <label><i class="glyphicon glyphicon-stop fa-2x"
                                                      style="color: #e74c3c;"></i></label>
                                        @else
                                            <label><i class="glyphicon glyphicon-triangle-top fa-2x"
                                                      style="color: #f39c12;"></i></label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @endforeach

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <div class="ln_solid"></div>

                            <a href="{{ route('dashboard.app') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>

                            <button id="submitButton" type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.accept') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        let $thesholdUpdateFm = $('#thesholdUpdateFm');

        let validator = $thesholdUpdateFm.validate($.extend(false, $validateDefaults, {
            rules: {
                'min 0': {
                    required: true
                },
                'max 0': {
                    required: true
                },
                'min 1': {
                    required: true
                },
                'max 1': {
                    required: true
                },
                'min 2': {
                    required: true
                },
                'max 2': {
                    required: true
                },
                'min 3': {
                    required: true
                },
                'max 3': {
                    required: true
                },
                'min 4': {
                    required: true
                },
                'max 4': {
                    required: true
                },
                'min 5': {
                    required: true
                },
                'max 5': {
                    required: true
                },
                'min 6': {
                    required: true
                },
                'max 6': {
                    required: true
                },
                'min 7': {
                    required: true
                },
                'max 7': {
                    required: true
                },
                'min 8': {
                    required: true
                },
                'max 8': {
                    required: true
                }
            }
        }));

        $thesholdUpdateFm.ajaxForm($.extend(false, $formAjaxDefaults, {}));

    });
</script>

@else
    @include('errors.403')
    @endpermission
