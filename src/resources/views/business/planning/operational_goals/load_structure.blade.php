<div id="operational-goals-tree" class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('operational_goals.labels.structure')}}</h2>

        <div class="clearfix"></div>
    </div>
</div>

<script>
    $(() => {
        $('#operational-goals-tree').tree({
            data: '{!! $json !!}',
            selectParents: true
        })
    });
</script>