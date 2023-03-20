<div class="row">
    <form id="comment_form" action="{{ route('comment.projects.certifications.execution', ['id' => $entity->id]) }}" class="form-label-left mt-3" method="post">
        @csrf
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label" for="comment">
                <i class="fa fa-comments color-blue"></i> {{ trans('admin_activities.labels.comments') }}
            </label>
            <textarea type="text" id="comment" name="comment" placeholder="{{ trans('admin_activities.placeholders.comments') }}"
                      autocomplete="off" class="form-control" rows="2"></textarea>
            <button id="send_btn" type="submit" class="btn btn-primary btn-xs pull-right mt-2 mr-0">
                <i class="fa fa-send"></i> {{ trans('admin_activities.labels.send') }}
            </button>
        </div>
    </form>

    <div class="ml-10 mr-10" id="comments">
        @include('business.execution.certifications.partials.comments-list', ['entity' => $entity])
    </div>
</div>

<script>
    $(() => {
        let $commentForm = $('#comment_form')

        $commentForm.validate($.extend(false, $validateDefaults, {
            rules: {
                comment: {
                    required: true,
                    minlength: 3,
                    maxlength: 200
                }
            }
        }));

        $commentForm.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                $commentForm.trigger("reset");
                processResponse(response, '#comments');
            }
        }));
    });
</script>
