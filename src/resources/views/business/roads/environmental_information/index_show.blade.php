<div class="row">

    <div class="x_title">
        <h2>{{ trans('environmental_information.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="environmental_information_tb">
        <thead>
        <tr>
            <th>{{ trans('environmental_information.labels.participa') }}</th>
            <th>{{ trans('environmental_information.labels.eval_riesg') }}</th>
            <th>{{ trans('environmental_information.labels.riesg_pot') }}</th>
            <th>{{ trans('environmental_information.labels.reserv_nat') }}</th>
            <th>{{ trans('environmental_information.labels.pueb_indig') }}</th>
            <th>{{ trans('environmental_information.labels.prot_cuenc') }}</th>
            <th>{{ trans('environmental_information.labels.resforest') }}</th>
            <th>{{ trans('environmental_information.labels.act_ambie') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#environmental_information_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.environmental_information.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'participa', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'eval_riesg', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'riesg_pot', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'reserv_nat', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'pueb_indig', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'prot_cuenc', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'resforest', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'act_ambie', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>