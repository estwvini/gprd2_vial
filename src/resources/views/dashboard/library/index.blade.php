@permission('index.inventory_library')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('library.labels.document_title') }}</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="form-group col-md-4 col-sm-10 col-xs-12">
                        <label class="control-label" for="type_id">
                            {{ trans('library.labels.document_type') }}
                        </label>
                        <select class="form-control select2" id="type_id">                                   
                            <option value="tecnico" @if("tecnico" == (isset($type_id) ? $type_id : "tecnico" )) selected @endif>
                                {{ trans('library.labels.technical') }}</option>
                            <option value="legal" @if("legal" == (isset($type_id) ? $type_id : "" )) selected @endif>
                                {{ trans('library.labels.lawful') }}</option>
                        </select>    
                    </div>
                    
                    @permission('create.inventory_library')
                    <ul class="nav navbar-right panel_toolbox" >
                        <li class="pull-right">
                            <a id="create_library" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('library.labels.create_document') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped text-center" id="library_tb">
                        <thead>
                        <tr>
							<th>{{ trans('library.labels.code') }}</th>
                            <th>{{ trans('library.labels.name') }}</th>
                            <th>{{ trans('library.labels.description') }}</th>
                            <th>{{ trans('library.labels.type') }}</th>
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

        let $table = build_datatable($('#library_tb'), {
            ajax: {
                url: '{!! route('data.index.inventory_library') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            type_id: $('#type_id').val()
                        }
                    });
                }
            },
            columns: [
                {data: 'code', width: '15%', sortable: false, searchable: true},
                {data: 'name', width: '30%', sortable: true, searchable: true},
                {data: 'description', width: '30%', sortable: true, searchable: true},
                {data: 'type', width: '10%', sortable: true, searchable: true},
                {data: 'actions', width: '15%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

        $('#create_library').on('click', () => {
            let type_id = $('#type_id').val();
            let url = "{!! route('create.inventory_library',['type_id' => '__ID__']) !!}";
            url = url.replace('__ID__', type_id);
            pushRequest(url);
        });

    });
</script>
@else
    @include('errors.403')id
    @endpermission