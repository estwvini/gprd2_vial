@permission('show.characteristics_of_track.inventory_roads')

<div class="modal-content" id="intersection_create">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('characteristics_of_track.labels.details') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="gid">
                        {{ trans('characteristics_of_track.labels.gid') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" name="gid" id="gid"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.gid') }}"
                               value="{{ $entity->gid }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12 " for="origen">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.origen') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="origen" id="origen"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.origen') }}"
                               value="{{ $entity->origen }}" disabled/>
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
                               placeholder="{{ trans('characteristics_of_track.placeholders.destino') }}"
                               value="{{ $entity->destino }}" disabled/>
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
                        <input type="text" name="tipoterreno" id="tipoterreno"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.tipoterreno') }}"
                               value="{{ $entity->tipoterreno }}" disabled/>
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
                               placeholder="{{ trans('characteristics_of_track.placeholders.lati') }}"
                               value="{{ $entity->lati }}" disabled/>
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
                               placeholder="{{ trans('characteristics_of_track.placeholders.longi') }}"
                               value="{{ $entity->longi }}" disabled/>
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
                               placeholder="{{ trans('characteristics_of_track.placeholders.latf') }}"
                               value="{{ $entity->latf }}" disabled/>
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
                               placeholder="{{ trans('characteristics_of_track.placeholders.longf') }}"
                               value="{{ $entity->longf }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numerocamino">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.Numerocamino') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numerocamino" id="numerocamino"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.Numerocamino') }}"
                               value="{{ $entity->Numerocamino }}" disabled/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numerosubcamino">
                        {{ trans('characteristics_of_track.labels.Numerosubcamino') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numerosubcamino" id="numerosubcamino"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.Numerosubcamino') }}"
                               value="{{ $entity->Numerosubcamino }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tsuperf">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.tsuperf') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="tsuperf" id="tsuperf"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.tsuperf') }}"
                               value="{{ $entity->tsuperf }}" disabled/>
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
                        <input type="text" name="esuperf" id="esuperf"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.esuperf') }}"
                               value="{{ $entity->esuperf }}" disabled/>
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
                        <input type="text" name="longitud" id="longitud"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.longitud') }}"
                               value="{{ $entity->longitud }}" disabled/>
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
                        <input type="text" name="anchoca" id="anchoca"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.anchoca') }}"
                               value="{{ $entity->anchoca }}" disabled/>
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
                        <input type="text" name="anchovi" id="anchovi"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.anchovi') }}"
                               value="{{ $entity->anchovi }}" disabled/>
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
                        <input type="text" name="uso" id="uso"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.uso') }}"
                               value="{{ $entity->uso }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="carriles">
                        <span class="label label-primary">{{ trans('characteristics_of_track.labels.carriles') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="carriles" id="carriles"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.carriles') }}"
                               value="{{ $entity->carriles }}" disabled/>
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
                               placeholder="{{ trans('characteristics_of_track.placeholders.velprom') }}"
                               value="{{ $entity->velprom }}" disabled/>
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
                               placeholder="{{ trans('characteristics_of_track.placeholders.numcurv') }}"
                               value="{{ $entity->numcurv }}" disabled/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
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
                               placeholder="{{ trans('characteristics_of_track.placeholders.numinters') }}"
                               value="{{ $entity->numinters }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="esenhori">
                        {{ trans('characteristics_of_track.labels.esenhori') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="esenhori" id="esenhori"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.esenhori') }}"
                               value="{{ $entity->esenhori }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="esenvert">
                        {{ trans('characteristics_of_track.labels.esenvert') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="esenvert" id="esenvert"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.esenvert') }}"
                               value="{{ $entity->esenvert }}" disabled/>
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
                               placeholder="{{ trans('characteristics_of_track.placeholders.nupuent') }}"
                               value="{{ $entity->nupuent }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('characteristics_of_track.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('characteristics_of_track.placeholders.observ') }}"
                                  disabled>{{ $entity->observ }}</textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen">
                        {{ trans('characteristics_of_track.labels.imagen') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen)
                            <img src="{{ asset($entity->imagePath()) }}"
                                 alt="{{ trans('characteristics_of_track.labels.imagen') }}"
                                 class="img-responsive avatar-view">
                        @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numalcan">
                        {{ trans('characteristics_of_track.labels.numalcan') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numalcan" id="numalcan"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numalcan') }}"
                               value="{{ $entity->numalcan }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numminas">
                        {{ trans('characteristics_of_track.labels.numminas') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numminas" id="numminas"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numminas') }}"
                               value="{{ $entity->numminas }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numpuntocri">
                        {{ trans('characteristics_of_track.labels.numpuntocri') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numpuntocri" id="numpuntocri"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numpuntocri') }}"
                               value="{{ $entity->numpuntocri }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numsen">
                        {{ trans('characteristics_of_track.labels.numsen') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numsen" id="numsen"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numsen') }}"
                               value="{{ $entity->numsen }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numservicio">
                        {{ trans('characteristics_of_track.labels.numservicio') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numservicio" id="numservicio"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numservicio') }}"
                               value="{{ $entity->numservicio }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="poblacion">
                        {{ trans('characteristics_of_track.labels.poblacion') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="poblacion" id="poblacion"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.poblacion') }}"
                               value="{{ $entity->Población }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="viviendas">
                        {{ trans('characteristics_of_track.labels.viviendas') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="viviendas" id="viviendas"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.viviendas') }}"
                               value="{{ $entity->Viviendas }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numtalud">
                        {{ trans('characteristics_of_track.labels.numtalud') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numtalud" id="numtalud"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numtalud') }}"
                               value="{{ $entity->numtalud }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="numasent">
                        {{ trans('characteristics_of_track.labels.numasent') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="numasent" id="numasent"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('characteristics_of_track.placeholders.numasent') }}"
                               value="{{ $entity->numasent }}" disabled/>
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <a class="btn btn-info ajaxify closeModal">
                        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                    </a>
                </div>

            </form>
        </div>
    </div>

    <div class="modal-footer">
    </div>
</div>

<script>
    $(() => {
        $('.closeModal').on('click', (e) => {
            $modal.modal('hide');
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission