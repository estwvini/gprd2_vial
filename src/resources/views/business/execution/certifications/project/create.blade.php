@inject('Certification', 'App\Models\Business\Certification' )

<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i
                    class="fa fa-plus green"></i> {{ trans('certifications.labels.new') }}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-8">
                <form role="form" method="POST" action="#" class="form-label-left" novalidate
                      id="create_certification">
                    @method('POST')
                    @csrf

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label" for="name">
                            {{ trans('app.headers.name') }} <span class="required text-danger">*</span>
                        </label>
                        <input type="text" id="name" name="name" placeholder="{{ trans('app.headers.name') }}"
                               autocomplete="off"
                               class="form-control" value=""/>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label" for="topic">
                            {{ trans('certifications.labels.topic') }}
                            <span class="required text-danger">*</span>
                        </label>
                        <textarea type="text" id="topic" name="topic" rows="3"
                                  placeholder="{{ trans('certifications.labels.topic') }}" autocomplete="off"
                                  class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label" for="activity_id">
                            {{ trans('activities.labels.activity') }} <span class="required text-danger">*</span>
                        </label>
                        <select class="form-control select22" id="activity_id" name="activity_id" required>
                            @if (count($activities) > 1)
                                <option value=""></option>
                            @endif
                            @foreach($activities as $activity)
                                <option value="{{ $activity->id }}">
                                    {{ $activity->code . ' ' . $activity->name }}
                                </option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ trans('budget_item.labels.code') }}</th>
                                <th>{{ trans('reports.poa.for_compromising') }}</th>
                                <th>{{ trans('budget_item.labels.amount') }}</th>
                            </tr>
                            </thead>
                            <tbody id="items">

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <p class="well well-sm no-shadow">
                    <b>{{ trans('plan_elements.labels.PROGRAM') }}
                        : </b>{{ $project->subprogram->parent->code . ' - ' . $project->subprogram->parent->description }}
                    <br>
                    <br>
                    <b>{{ trans('plan_elements.labels.SUBPROGRAM') }}
                        : </b>{{ $project->subprogram->code . ' - ' . $project->subprogram->description }}
                    <br>
                    <br>
                    <b>{{ trans('plan_elements.labels.PROJECT') }}
                        : </b>{{ $project->code . ' - ' . $project->name }}

                    <br>
                    <br>
                    <b>{{ trans('plan_elements.labels.DIRECTION') }}
                        : </b>{{  $project->responsibleUnit->name }}

                </p>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
        </button>
        <button id="save_btn" type="button" class="btn btn-success"><i
                    class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
    </div>
</div>

<script>
    $(() => {
        let selectActivity = $('#activity_id').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {

            let url = '{{ route('items.projects.certifications.execution', ['activityId'=> '__ID__']) }}';
            url = url.replace('__ID__', selectActivity.val());
            pushRequest(url, '#items', 'get', null, false);
        });
        let $form = $('#create_certification');
        $form.validate($.extend(false, $validateDefaults, {
            rules: {
                topic: {
                    required: true
                },
                name: {
                    required: true,
                    maxlength: 60
                },
                activity_id: {
                    required: true
                },
            }
        }));

        let certification_tb = $('#certification_tb').DataTable();
        $form.validate($validateDefaults);
        $('#save_btn').on('click', () => {
            if ($form.valid()) {
                let formData = new FormData($form[0]);
                pushRequest('{{ route('store.create.projects.certifications.execution', ['projectId' => $projectId]) }}', null, () => {
                        $modal_xl.modal('hide');
                        certification_tb.draw();
                    }, 'post',
                    formData, false, {form: true});
            }
        });

    });
</script>