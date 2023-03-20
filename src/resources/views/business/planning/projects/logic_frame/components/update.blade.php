@if(currentUser()->can($urlEditComponent))
    <div class="row" id="model">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('components.labels.edit') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" method="post"
                          action="{{ route($urlUpdateComponent, ['componentId' => $component->id]) }}"
                          class="form-horizontal form-label-left" id="component_create_fm" novalidate>

                        @csrf

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                {{ trans('app.headers.name') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" @if(!$addOrDelete) disabled @endif
                                value="{{  $component->name }}"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assumptions">
                                {{ trans('components.labels.assumptions') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="assumptions" id="assumptions"
                                      class="form-control col-md-7 col-sm-7 col-xs-12">{{ $component->assumptions }}</textarea>
                            </div>
                        </div>

                        @if(!$structureModule)
                            <div class="accordion row" role="tablist" aria-multiselectable="true">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel">
                                        <a class="panel-heading collapsed" role="tab" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseThreeA" aria-expanded="false">
                                            <h4 class="panel-title">{{ trans('projects.labels.indicators') }}</h4>
                                        </a>
                                        <div id="collapseThreeA" class="panel-collapse collapse" role="tabpanel"
                                             aria-expanded="false" style="height: 0">
                                            <div class="panel-body">
                                                @if($addOrDelete)
                                                    <a href="{{ route($urlCreateComponentIndicator, ['componentId' => $component->id]) }}"
                                                       data-ajaxify="#edit_area"
                                                       class="btn btn-xs btn-success ajaxify pull-right">
                                                        <i class="fa fa-plus"></i></a>
                                                @endif
                                                <div id="indicators_activity_list">
                                                    @include('business.planning.projects.logic_frame.components.indicators.index', ['indicators' => $component->indicators])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <button class="btn btn-info" id="cancel_component">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </button>
                            <button type="submit" class="btn btn-success">
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

            let $form = $('#component_create_fm');

            $form.validate($.extend(false, $validateDefaults, {
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 500
                    }
                }
            }));
            $form.ajaxForm($.extend(false, $formAjaxDefaults, {
                success: (response) => {
                    processResponse(response, '#components_list', () => {
                        $validateDefaults.rules = {};
                        $validateDefaults.messages = {};
                        $('#edit_area').empty();
                    });
                }
            }));

            $('#cancel_component').on('click', () => {
                $('#edit_area').empty();
            });

        });

    </script>

@else
    @include('errors.403')
@endif
