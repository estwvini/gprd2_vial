@permission($permission)

<div id="plan-tree" class="x_panel">
    <div class="x_title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h2 class="align-center">{{ trans('plans.labels.planStructure', ['scope' => trans('plans.labels.'.$scope)])}}</h2>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script>
    $(() => {

        $('#plan-tree').tree({
            data: '{!! $json !!}',
            selectParents: true
        })
    });
</script>

@else
    @include('errors.403')

    @endpermission
