@inject('Certification', 'App\Models\Business\Certification' )
{{--@include('business.execution.certifications.partials.pdfFormat')--}}
<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i
                    class="fa fa-certificate green"></i> {{ trans('certifications.labels.show') }}:
            #{{ $entity->number }}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group col-md-12 col-sm-12 col-xs-12" id="info">
                    <dl class="row dt-h5-show-certifications">
                        <dt class="col-sm-2"><h5><strong>{{ trans('app.headers.name') }}</strong></h5></dt>
                        <dd class="col-sm-10">
                            <h6>{{ $entity->name }}</h6>
                        </dd>
                        <br>
                        <br>
                        <dt class="col-sm-2"><h5><strong>{{ trans('certifications.labels.topic') }}</strong></h5></dt>
                        <dd class="col-sm-10">
                            <h6>{{ $entity->topic }}</h6>
                        </dd>
                        <br>
                        <br>
                        <dt class="col-sm-2"><h5><strong>{{ trans('activities.labels.activity') }}</strong></h5></dt>
                        <dd class="col-sm-10">
                            <h6>{{ $entity->activity->code . ' ' . $entity->activity->name  }}</h6>
                        </dd>

                    </dl>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-striped no-margin h30" id="units_tb">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('budget_item.labels.budget_item') }}</th>
                            <th>{{ trans('reports.budget_card.certified') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($entity->budgetItems as $item)
                            <tr>
                                <td class="text-center fw-b">{{ $loop->iteration }}</td>
                                <td>
                                    {{ $item->code }}
                                    <br>
                                    {{ $item->name }}
                                </td>
                                <td class="text-center">{{ number_format((float)$item->pivot->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="text-center"> {{ trans('reports.admin_activities_budget.no_info') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
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
                        : </b>{{ $project->cup . ' - ' . $project->name }}
                    <br>
                    <br>
                    <b>{{ trans('certifications.labels.status') }}
                        : </b> @include('business.execution.certifications.partials.status', ['entity' => $entity])
                    <br>
                    <br>
                    <b>{{ trans('app.labels.date') }}
                        : </b>{{ date('Y-m-d H:i', strtotime($entity->created_at)) }}
                    @if($entity->status == \App\Models\Business\Certification::STATUS_APPROVED || $entity->status == \App\Models\Business\Certification::STATUS_DIGITATED)
                        <br>
                        <br>
                        <b>{{ trans('certifications.labels.download') }}
                            : </b>
                        <a id="export_pdf" class="ajaxify">
                        <span class="btn btn-xs btn-default">
                            <span class="fa fa-download color-blue" aria-hidden="true"></span>
                        </span>
                        </a>
                    @endif
                    @foreach($entity->user->departments as $dep)
                        <br>
                        <br>
                        <b>{{ trans('plan_elements.labels.DIRECTION') }}
                            : </b> <span id="direction"> {{ $dep->name}}</span>
                    @endforeach

                </p>
                @include('business.execution.certifications.partials.comments', ['entity' => $entity])
            </div>
        </div>
    </div>

    <div class="modal-footer">
        @if($entity->status === \App\Models\Business\Certification::STATUS_TO_REVIEW )
            <button class="btn btn-info" data-dismiss="modal"><i
                        class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
            <button id="save_btn" type="button" class="btn btn-success"><i
                        class="fa fa-check"></i> {{ trans('app.labels.approve') }}</button>
            <button id="reject_btn" type="button" class="btn btn-danger"><i
                        class="fa fa-check"></i> {{ trans('app.labels.reject') }}</button>
        @elseif($entity->status === \App\Models\Business\Certification::STATUS_APPROVED)
            <button class="btn btn-info" data-dismiss="modal"><i
                        class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
        @elseif($entity->status === \App\Models\Business\Certification::STATUS_DIGITATED)
            <button class="btn btn-info" data-dismiss="modal"><i
                        class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>

        @endif

    </div>
</div>

<script>
    $(() => {
        let certification_tb = $('#certification_tb').DataTable();
        $('#save_btn').on('click', () => {
            pushRequest('{{ route('status.certifications.execution', ['id' => $id]) }}', null, () => {
                    $modal_xl.modal('hide');
                    certification_tb.draw();
                }, 'put',
                {
                    '_token': '{!! csrf_token() !!}',
                    status: '{{ \App\Models\Business\Certification::STATUS_APPROVED }}',
                    user_id: '{{currentUser()->id}}'
                }
                , false);
        });

        $('#reject_btn').on('click', () => {
            pushRequest('{{ route('status.certifications.execution', ['id' => $id]) }}', null, () => {
                    $modal_xl.modal('hide');
                    certification_tb.draw();
                }, 'put',
                {
                    '_token': '{!! csrf_token() !!}',
                    status: '{{ \App\Models\Business\Certification::STATUS_REJECTED }}',
                    user_id: '{{currentUser()->id}}'
                }
                , false);
        });



        $('#export_pdf').on('click', () => {
            let id={{$entity->id}};
            let downloadUrl = "{!! route('pdf.certifications.execution',['id'=>'__ID__']) !!}";
            downloadUrl = downloadUrl.replace('__ID__', id);
            location.href = downloadUrl;
        });

    });
</script>