<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('users.user.labels.profile_title') }}</h3>
        </div>

        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                <li class="active"> {{ trans('app.labels.profile') }}</li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-user"></i> {{ trans('users.user.labels.profile_title') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">

                        <li class="pull-right">
                            <a href="{{ route('edit.profile') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top"
                                   data-original-title="{{ trans('app.labels.edit') }}"></i>
                            </a>
                        </li>

                        <li class="pull-right">
                            <a href="javascript:" id="profileChangePasswd" class="btn btn-box-tool">
                                <i class="fa fa-key" data-toggle="tooltip" data-placement="top"
                                   data-original-title="{{ trans('app.labels.change_password') }}"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img">
                            <img class="img-responsive avatar-view" src="{{ asset($user->photoPath()) }}"/>
                        </div>

                        <h3>{{ $user->fullName() }}</h3>

                        <ul class="list-unstyled user_data">
                            @if($user->email)
                                <li><i class="fa fa-envelope-o user-profile-icon"></i> {{ $user->email }}</li>
                            @endif
                        </ul>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-12" id="profile-content">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="profileTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tab_content1" role="tab" id="user_detail_tab" data-toggle="tab" aria-expanded="true">
                                        <i class="fa fa-info-circle"></i> {{ trans('users.user.labels.details') }}
                                    </a>
                                </li>
                            </ul>

                            <div id="profileTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="user_detail_tab">
                                    <dl class="dl-horizontal">
                                        <dt>{{ trans('users.user.labels.username') }}</dt>
                                        <dd>{{ $user->username }}</dd>

                                        <dt>{{ trans('users.user.labels.created_at') }}</dt>
                                        <dd>{{ $user->created_at->diffForHumans() }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#profileChangePasswd').on('click', function (e) {
            e.preventDefault();
            $.ajax('{!! route('change.password.profile') !!}', {
                beforeSend: function () {
                    showLoading();
                }
            }).done(function (response) {
                $modal.find('.modal-dialog').html(response);
                $modal.modal('show');
            }).fail(function (request, error) {
                notify('Ha ocurrido un error al intentar realizar la transacci&#243;n', 'error', 'Error!');
                console.error(error);
            }).always(function () {
                hideLoading();
            });
        });
    });
</script>
