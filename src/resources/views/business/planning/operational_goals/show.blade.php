@permission('show.operational_goals.plans_management')
@inject('OperationalGoal', '\App\Models\Business\Planning\OperationalGoal')

<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('operational_goals.labels.details') }}</h2>

        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <form role="form" class="form-horizontal form-label-left" id="currentExpenditureElementFormCreate" novalidate>

                    <div class="pb-4">{!! $route !!}</div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_code">
                            {{ trans('operational_goals.labels.code') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input disabled name="element_code" id="element_code"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   value="{{ $entity->code }}"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_name">
                            {{ trans('operational_goals.labels.name') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input disabled name="element_name" id="element_name"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   value="{{ $entity->name }}"/>
                        </div>
                    </div>

                    <div class="pull-right">
                        <button id="acceptBtn" type="button" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.accept') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

        $('#acceptBtn').click(() => {
            $('#load-area').empty()

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })
        })
    })

</script>

@else
    @include('errors.403')
@endpermission