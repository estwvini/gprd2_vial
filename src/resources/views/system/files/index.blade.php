@permission('index.files')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('files.title') }}</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row mb-15">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_panel">
                    <div class="x_content">
                        <div role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#index_plans" id="index_plans_tab" role="tab"
                                       data-toggle="tab"
                                       aria-expanded="true">{{ trans('files.labels.plans') }}</a>
                                </li>
                                <li role="presentation">
                                    <a href="#index_projects" id="index_projects_tab" role="tab"
                                       data-toggle="tab" aria-expanded="false">{{ trans('files.labels.projects') }}</a>
                                </li>
                                <li role="presentation">
                                    <a href="#index_tracking" id="index_tracking_tab" role="tab"
                                       data-toggle="tab" aria-expanded="false">{{ trans('files.labels.tracking') }}</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" aria-labelledby="home-tab" id="index_plans">
                                </div>
                                <div role="tabpanel" class="tab-pane fade" aria-labelledby="profile-tab" id="index_projects">
                                </div>
                                <div role="tabpanel" class="tab-pane fade" aria-labelledby="profile-tab" id="index_tracking">
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
    $(() => {

        let count_projects_tab = 0;
        let count_tracking_tab = 0;

        let url = '{!! route('index_plans.index.files') !!}';
        pushRequest(url, '#index_plans', null, null, null, false);

        $('#index_projects_tab').on('click', (e) => {
            if (count_projects_tab === 0) {
                count_projects_tab = 1;
                e.preventDefault();
                let url = '{!! route('index_projects.index.files') !!}';
                pushRequest(url, '#index_projects', null, null, null, false);
            }
        });

        $('#index_tracking_tab').on('click', (e) => {
            if (count_tracking_tab === 0) {
                count_tracking_tab = 1;
                e.preventDefault();
                let url = '{!! route('index_tracking.index.files') !!}';
                pushRequest(url, '#index_tracking', null, null, null, false);
            }
        });
    })
</script>

@else
    @include('errors.403')
    @endpermission
