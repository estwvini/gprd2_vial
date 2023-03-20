<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-comment"></i> Respuesta
        </h4>
    </div>
    <div class="modal-body">
        <table class="table table-bordered detail-table">
            <tbody>
            <tr>
                <td class="w-20">{{ trans('app.labels.author') }}</td>
                <td class="fs-l">{{ $review->author->full_name }}</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('app.labels.qualify') }}</td>
                <td class="fs-l">@include('app.reviews.rating', ['rating' => $review->rating])</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('app/reviews.labels.subject') }}</td>
                <td class="fs-l">{{ $review->reviewable->name }}</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('app/reviews.labels.location') }}</td>
                <td class="fs-l">{{ $review->location ? $review->location->description : '' }}</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('app/reviews.labels.comment') }}</td>
                <td class="fs-l">{{ $review->comment }}</td>
            </tr>
            <tr>
                <td colspan="2" class="bg-grey">{{ trans('app/reviews.labels.responses') }}</td>
            </tr>
            @forelse($review->replies as $reply)
                <tr>
                    <td class="w-20">{{ $reply->author ? $reply->author->fullName(): trans('app/reviews.labels.default') }}</td>
                    <td class="fs-l">@if($reply->approved) <i class="fa fa-check-circle text-success cursor-pointer" data-toggle="tooltip" data-placement="top"
                                                              data-original-title="Publicado"></i> @endif  {{ $reply->comment }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="w-20 text-center text-danger">{{ trans('app/reviews.messages.info.empty') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <form method="post" action="{{ route('store.create.reviews', ['id' => $review->id]) }}"
              class="form-horizontal form-label-left"
              id="response_fm" novalidate>

            @csrf
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="comment">
                    {{ trans('app/reviews.labels.comment') }}
                </label>
                <div class="col-md-9 col-xs-12">
                            <textarea name="comment" id="comment" class="form-control"></textarea>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">
            <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
        </button>
        <button type="submit" class="btn btn-success" id="btn_submit">
            <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
        </button>
    </div>
</div>

<script>
    $(() => {


        let $form = $('#response_fm');

        $form.validate($.extend(false, $validateDefaults, {
            rules: {
                comment: {
                    required: true
                }
            }
        }));

        let reviews_tb = $('#reviews_tb').DataTable();

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $modal.modal('hide');
                    reviews_tb.draw();
                });
            }
        }));

        $("#btn_submit").click(function () {
            $form.submit(); // Submit the form
        });
    });
</script>
