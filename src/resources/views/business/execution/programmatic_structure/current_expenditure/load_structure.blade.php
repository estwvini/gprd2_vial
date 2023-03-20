<div id="current-expenditure-tree" class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('current_expenditure.labels.structure')}}</h2>

        <div class="clearfix"></div>
    </div>
</div>

<script>
    $(() => {
        $('#current-expenditure-tree').tree({
            data: '{!! $json !!}',
            selectParents: true
        })
    });
</script>