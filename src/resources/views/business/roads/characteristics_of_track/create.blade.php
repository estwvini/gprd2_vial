@permission('create.characteristics_of_track.inventory_roads')

<div class="modal-content" id="intersection_create">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('characteristics_of_track.labels.create') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" action="{{ route('store.create.characteristics_of_track.inventory_roads') }}"
                  method="post"
                  class="form-horizontal form-label-left" id="characteristics_of_track_create_fm">

                @csrf

                <input type="hidden" name="codigo" value="{{ $code }}">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="origen">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.origen') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="origen" id="origen"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.origen') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="destino">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.destino') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="destino" id="destino"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.destino') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tipoterreno">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.tipoterreno') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2 select2_tipoterreno" id="tipoterreno" name="tipoterreno"
                                required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($typeOfLands as $typeOfLand)
                                <option value="{{ $typeOfLand->descrip }}">{{ $typeOfLand->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="lati">
                        {{ trans('characteristics_of_track.labels.lati') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="lati" id="lati"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.lati') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longi">
                        {{ trans('characteristics_of_track.labels.longi') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longi" id="longi"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.longi') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="latf">
                        {{ trans('characteristics_of_track.labels.latf') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="latf" id="latf"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.latf') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longf">
                        {{ trans('characteristics_of_track.labels.longf') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longf" id="longf"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.longf') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Numerocamino">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.Numerocamino') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Numerocamino" id="Numerocamino"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.Numerocamino') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Numerosubcamino">
                        {{ trans('characteristics_of_track.labels.Numerosubcamino') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Numerosubcamino" id="Numerosubcamino"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.Numerosubcamino') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tsuperf">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.tsuperf') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="tsuperf" name="tsuperf" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($roundSurfaceTypes as $roundSurfaceType)
                                <option value="{{ $roundSurfaceType->descrip }}">{{ $roundSurfaceType->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="esuperf">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.esuperf') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="esuperf" name="esuperf" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($states as $state)
                                <option value="{{ $state->descrip }}">{{ $state->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longitud">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.longitud') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="number" step="any" name="longitud" id="longitud"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.longitud') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="anchoca">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.anchoca') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="number" step="any" name="anchoca" id="anchoca"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.anchoca') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="anchovi">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.anchovi') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="number" step="any" name="anchovi" id="anchovi"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.anchovi') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="uso">
                        {{ trans('characteristics_of_track.labels.uso') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="uso" name="uso" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($useRoads as $useRoad)
                                <option value="{{ $useRoad->descrip }}">{{ $useRoad->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="carriles">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.carriles') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="carriles" name="carriles" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($lanes as $lane)
                                <option value="{{ $lane->descrip }}">{{ $lane->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="velprom">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.velprom') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="velprom" id="velprom"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.velprom') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numcurv">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.numcurv') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numcurv" id="numcurv"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numcurv') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="distvis">
                        {{ trans('characteristics_of_track.labels.distvis') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="distvis" id="distvis"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.distvis') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numinters">
                        {{ trans('characteristics_of_track.labels.numinters') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numinters" id="numinters"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numinters') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="esenhori">
                        {{ trans('characteristics_of_track.labels.esenhori') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="esenhori" name="esenhori" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($states as $state)
                                <option value="{{ $state->descrip }}">{{ $state->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="esenvert">
                        {{ trans('characteristics_of_track.labels.esenvert') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="esenvert" name="esenvert" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($states as $state)
                                <option value="{{ $state->descrip }}">{{ $state->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nupuent">
                        {{ trans('characteristics_of_track.labels.nupuent') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="nupuent" id="nupuent"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.nupuent') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('characteristics_of_track.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('characteristics_of_track.placeholders.observ') }}"></textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen">
                        {{ trans('characteristics_of_track.labels.imagen') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="file" name="imagen" id="imagen"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               accept="image/png, image/jpeg, image/jpg"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numalcan">
                        {{ trans('characteristics_of_track.labels.numalcan') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numalcan" id="numalcan"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numalcan') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numminas">
                        {{ trans('characteristics_of_track.labels.numminas') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numminas" id="numminas"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numminas') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numpuntocri">
                        {{ trans('characteristics_of_track.labels.numpuntocri') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numpuntocri" id="numpuntocri"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numpuntocri') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numsen">
                        {{ trans('characteristics_of_track.labels.numsen') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numsen" id="numsen"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numsen') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numservicio">
                        {{ trans('characteristics_of_track.labels.numservicio') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numservicio" id="numservicio"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numservicio') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="población">
                        {{ trans('characteristics_of_track.labels.poblacion') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Población" id="Población"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.poblacion') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="viviendas">
                        {{ trans('characteristics_of_track.labels.viviendas') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Viviendas" id="Viviendas"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.viviendas') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numtalud">
                        {{ trans('characteristics_of_track.labels.numtalud') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numtalud" id="numtalud"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numtalud') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numasent">
                        {{ trans('characteristics_of_track.labels.numasent') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numasent" id="numasent"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numasent') }}"/>
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <a class="btn btn-info ajaxify closeModal">
                        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="modal-footer">
    </div>
</div>

<script>
    $(() => {

        $('.select2').select2({});

        $("#code").inputmask();

        $("#code").focusout(() => {

            let aux = $("#code").val();
            aux = aux.replace(/_/g, '0');
            $("#code").val(aux);
        });

        let $form = $('#characteristics_of_track_create_fm');

        $validateDefaults.rules = {
            origen: {
                required: true,
                maxlength: 120
            },
            destino: {
                required: true,
                maxlength: 120
            },
            lati: {
                required: true,
                maxlength: 255
            },
            longi: {
                required: true,
                maxlength: 255
            },
            latf: {
                required: true,
                maxlength: 255
            },
            longf: {
                required: true,
                maxlength: 255
            },
            Numerocamino: {
                required: true,
                number: true,
                maxlength: 9
            },
            Numerosubcamino: {
                required: true,
                number: true,
                maxlength: 9
            },
            longitud: {
                required: true,
                number: true,
                min: 0,
                max: 100,
                maxlength: 20
            },
            anchoca: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 8
            },
            anchovi: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 8
            },
            velprom: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 8
            },
            numcurv: {
                required: true,
                number: true,
                maxlength: 9
            },
            distvis: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 8
            },
            numinters: {
                required: true,
                number: true,
                maxlength: 8
            },
            nupuent: {
                required: true,
                number: true,
                maxlength: 9
            },
            observ: {
                required: true,
                maxlength: 180
            },
            numalcan: {
                required: false,
                number: true,
                maxlength: 9
            },
            numminas: {
                required: false,
                number: true,
                maxlength: 9
            },
            numpuntocri: {
                required: false,
                number: true,
                maxlength: 9
            },
            numsen: {
                required: false,
                number: true,
                maxlength: 9
            },
            numservicio: {
                required: false,
                number: true,
                maxlength: 9
            },
            Población: {
                required: false,
                number: true,
                maxlength: 9
            },
            Viviendas: {
                required: false,
                number: true,
                maxlength: 9
            },
            numtalud: {
                required: false,
                number: true,
                maxlength: 9
            },
            numasent: {
                required: false,
                number: true,
                maxlength: 9
            }
        };

        $form.validate($validateDefaults);

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $modal.modal('hide');
                });
            }
        }));

        $('.closeModal').on('click', (e) => {
            $modal.modal('hide');
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission