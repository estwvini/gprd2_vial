<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Editar Respuesta
        </h4>
    </div>
    <div class="modal-body">
        <table class="table table-bordered detail-table">
            <tbody>
            <tr>
                <td colspan="2">{{ trans('app/reviews.labels.comment') }}</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('app.labels.author') }}</td>
                <td class="fs-l">{{ $review->parent->author->full_name }}</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('app.labels.qualify') }}</td>
                <td class="fs-l">@include('app.reviews.rating', ['rating' => $review->parent->rating])</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('app/reviews.labels.subject') }}</td>
                <td class="fs-l">{{ $review->reviewable->name }}</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('app/reviews.labels.location') }}</td>
                <td class="fs-l">{{ $review->parent->location ? $review->parent->location->description : '' }}</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('app/reviews.labels.comment') }}</td>
                <td class="fs-l">{{ $review->parent->comment }}</td>
            </tr>
            </tbody>
        </table>

        <form method="POST" action="{{ route('update.edit.approvals.reviews', ['id' => $review->id]) }}"
              class="form-horizontal form-label-left"
              id="response_fm" novalidate>

            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="comment">
                    {{ trans('app/reviews.labels.reply') }}
                </label>
                <div class="col-md-9 col-xs-12">
                            <textarea name="comment" id="comment" class="form-control">{{ $review->comment }}</textarea>
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
