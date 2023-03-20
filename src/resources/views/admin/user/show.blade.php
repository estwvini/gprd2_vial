@permission('show.users')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-address-card"></i> {{ trans('users.user.labels.info') }}
        </h4>
    </div>
    <div class="x_content">
        <form class="form-horizontal form-label-left">
            <div class="row">
                <div class="text-center col-md-4 col-sm-4 col-xs-12 mb-3 col-md-offset-4">
                    <img src="{{ asset($entity->photoPath()) }}" alt="{{ trans('users.user.labels.photo') }}"
                         class="img-responsive avatar-view">
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="username">
                    {{ trans('users.user.labels.username') }} :
                </label>
                <label class="control-label" for="username" style="font-weight: normal">
                    {{ $entity->username }}
                </label>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="roles">
                    {{ trans('roles.labels.role') }} :
                </label>
                <label class="control-label" for="roles" style="font-weight: normal">
                    {{ $entity->roles->first()->name }}
                </label>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="enabled">
                    {{ trans('app.headers.enabled') }} :
                </label>
                <label class="control-label">
                    <i class="fa @if($entity->enabled) fa-check text-success @else fa-times text-danger @endif"></i>
                </label>
            </div>
        </form>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> {{ trans('app.labels.accept') }}</button>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission