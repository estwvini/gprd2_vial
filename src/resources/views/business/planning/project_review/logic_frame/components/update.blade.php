@permission('edit.components.projects_review.plans_management')
<div class="row" id="model">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ trans('components.labels.edit') }}</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-horizontal form-label-left">
                    @csrf

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                            {{ trans('app.headers.name') }} <span></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" id="name"
                                   value="{{  $component->name }}"
                                   class="form-control col-md-7 col-sm-7 col-xs-12 disabledInputs"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assumptions">
                            {{ trans('components.labels.assumptions') }}
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="assumptions" id="assumptions"
                                      class="form-control col-md-7 col-sm-7 col-xs-12 disabledInputs">{{  $component->assumptions }}</textarea>
                        </div>
                    </div>

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
                                        <div id="indicators_activity_list">
                                            @include('business.planning.project_review.logic_frame.components.indicators.index', ['indicators' => $component->indicators])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(() => {

        $(".disabledInputs").prop('disabled', true);

        $('#cancel_component').on('click', () => {
            $('#edit_area').empty();
        });

    });
</script>
@else
    @include('errors.403')
    @endpermission
