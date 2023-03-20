@permission('edit.reprogramming.reforms_reprogramming.execution')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('reprogramming.title') }}
                <small>{{ trans('app.labels.execution') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li>
                    <a class="ajaxify" href="{{ route('index.reprogramming.reforms_reprogramming.execution') }}"> {{ trans('reprogramming.title') }}</a>
                </li>
                <li class="active"> {{ trans('app.labels.edit') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-refresh"></i> {{ trans('reprogramming.labels.edit') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.reprogramming.reforms_reprogramming.execution') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('update.edit.reprogramming.reforms_reprogramming.execution', ['id' => $entity->id]) }}" method="post"
                          class="form-horizontal form-label-left" id="reprogramming_create_fm" novalidate>

                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                {{ trans('reprogramming.labels.status') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <span class="label label-warning fs-m">{{ trans('reprogramming.labels.status_DRAFT') }}</span>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="document">
                                {{ trans('reprogramming.labels.document') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="document" value="{{ $entity->code }}" readonly disabled class="form-control col-md-7 col-sm-7 col-xs-12"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('app.headers.description') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" maxlength="200" rows="4" required class="form-control vertical"
                                          onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);">{{ $entity->description }}</textarea>
                            </div>
                        </div>

                        @if($entity->file())
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">
                                    {{ trans('reprogramming.labels.file') }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <a href="{{ route('download.reprogramming.reforms_reprogramming.execution', ['id' => $entity->file()->id]) }}" class="h4">
                                        <i class="fa fa-download text-success"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">
                                {{ trans('reprogramming.labels.file') }} @if(!$entity->file())<span class="text-danger">*</span> @endif
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="file" id="file" class="form-control" accept="application/pdf"  @if(!$entity->file()) required @endif
                                       data-msg-accept="{{ trans('files.messages.validation.file_extension') }}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_fiscal_year_id">
                                {{ trans('reprogramming.labels.project') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control select2" id="project_fiscal_year_id" name="project_fiscal_year_id">
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" @if($project->id == $entity->project_fiscal_uear_id) selected @endif>
                                            {{ $project->project->full_cup }} - {{ $project->project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.reprogramming.reforms_reprogramming.execution') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        let $form = $('#reprogramming_create_fm');
        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);

        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission