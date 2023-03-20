<div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-middle">
                <div class="text-center text-center">
                    <h1 class="error-number">{{ trans('app.error_pages.access_denied') }}</h1>
                    <h3>{{ trans('app.error_pages.do_not_have_permissions') }}</h3>
                    <p>{{ trans('app.error_pages.contact_ti') }}</p>
                    <a href="{{ route('dashboard.app') }}" class="ajaxify">
                        {{ trans('app.error_pages.back_control_panel') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>