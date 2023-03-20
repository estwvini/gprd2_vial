@permission('index.inventory_roads_catalogs')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('hdm4.labels.catalogs') }}</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="form-group col-md-4 col-sm-10 col-xs-12">
                                <label class="control-label" for="parent_id">
                                    {{ trans('hdm4.labels.catalogfather') }}
                                </label>
                                <select class="form-control select2" id="parent_id">                                   
                                    @foreach($catalogs as $catalog)
                                        <option value="{{ $catalog->id }}" @if($catalog->id == (isset($parent_id) ? $parent_id : 0 )) selected @endif>
                                            {{ trans('hdm4.labels.catalog') }} {{ $catalog->descrip }}</option>
                                    @endforeach
                                </select>    
                    </div>
                    
                    @permission('create.inventory_roads_catalogs')
                    <ul class="nav navbar-right panel_toolbox" >
                        <li class="pull-right">
                            <a id="create_catalog" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('hdm4.labels.create_catalog') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped text-center" id="catalog_tb">
                        <thead>
                        <tr>
							<th>{{ trans('hdm4.labels.id') }}</th>
                            <th>{{ trans('hdm4.labels.code') }}</th>
                            <th>{{ trans('hdm4.labels.description') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        $('.select2').select2({}).on('change', () => {
            $table.draw();
        });

        let $table = build_datatable($('#catalog_tb'), {
            ajax: {
                url: '{!! route('data.index.inventory_roads_catalogs') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            parent_id: $('#parent_id').val()
                        }
                    });
                }
            },
            columns: [
                {data: 'id', width: '15%', sortable: false, searchable: true},
                {data: 'codigo', width: '35%', sortable: true, searchable: true},
                {data: 'descrip', width: '50%', sortable: true, searchable: true}
            ]
        });

        $('#create_catalog').on('click', () => {
            let parent_id = $('#parent_id').val();
            let url = "{!! route('create.inventory_roads_catalogs',['parent_id' => '__ID__']) !!}";
            url = url.replace('__ID__', parent_id);
            pushRequest(url);
        });

    });
</script>
@else
    @include('errors.403')id
    @endpermission