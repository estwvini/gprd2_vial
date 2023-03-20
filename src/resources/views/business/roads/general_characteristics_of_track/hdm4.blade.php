@permission('index.hdm4_roads')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('general_characteristics_of_track.title') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-automobile"></i>
                        {{ trans('reports/roads/inventory_roads_report.labels.hdm4') }}: {{ $gad["province_short_name"] }}
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form role="form" action="{{ route('import_file.index.hdm4_roads') }}" id="hdm4_generate_file" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4 col-md-offset-4">
                            <div class="input-group">
                                <input type="file" class="form-control" name="hdm4_file" id="hdm4_file"
                                       accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('reports/roads/inventory_roads_report.labels.generate_file') }}
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission