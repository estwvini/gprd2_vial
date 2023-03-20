<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('users.user.labels.profile_title') }}</h3>
        </div>

        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                <li>
                    <a class="ajaxify" href="{{ route('index.profile') }}"> {{ trans('app.labels.profile') }}</a>
                </li>

                <li class="active"> {{ trans('app.labels.update') }}</li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-user"></i> {{ trans('users.user.labels.update') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.profile') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
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
                    <form role="form" action="{{ route('update.edit.profile') }}" method="post"
                          class="form-horizontal form-label-left" id="profile_update_fm" novalidate>

                        @csrf
                        @method('PUT')

                        <span class="section">{{ trans('users.user.labels.profile_title') }}</span>

                        <div class="col-md-4 col-sm-4 col-xs-12"></div>
                        <div class="col-md-4 col-sm-4 col-xs-12 mb-4">
                            <img src="{{ asset($user->photoPath()) }}" alt="{{ trans('users.user.labels.photo') }}"
                                 class="img-responsive avatar-view" style="width: 100%;">
                        </div>

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="item form-group">
                                <label for="photo" class="control-label col-md-4 col-sm-4 col-xs-12">
                                    {{ trans('users.user.labels.photo') }}
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="file" name="photo" id="photo"
                                           class="form-control col-md-7 col-sm-7 col-xs-12"
                                           accept="image/png, image/jpeg, image/jpg"/>
                                </div>
                            </div>
                        </div>


                        <div class="clearfix"></div>
                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.profile') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.accept') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var $form = $('#profile_update_fm');
        $form.ajaxForm($formAjaxDefaults);

        $validateDefaults.rules = {
            first_name: {
                required: true,
                lettersOnly: true
            },
            last_name: {
                required: true,
                lettersOnly:true
            },
            email: {
                required: true,
                emailChecker: true,
                remote: {
                    url: "{!! route('email.check.profile') !!}",
                    data: {
                        id: '{{ $user->id }}',
                        email: function () {
                            return $("#email").val();
                        }
                    }
                }
            },
            photo: {
                extension: 'jpg|jpeg|png'
            }
        };

        $validateDefaults.messages = {
            email: {
                remote: '{!! trans('users.user.messages.validation.email_exists') !!}'
            },
            photo: {
                extension: '{!! trans('users.user.messages.validation.extension') !!}'
            }
        };

        $form.validate($validateDefaults);

        // password
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
