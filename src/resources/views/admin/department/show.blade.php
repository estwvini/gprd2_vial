@permission('show.departments')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-sitemap"></i> {{ trans('departments.labels.info') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form class="form-horizontal form-label-left">
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="name">
                            {{ trans('departments.labels.code') }} :
                        </label>

                        <label class="control-label" for="name" style="font-weight: normal">
                            {{ $entity->code }}
                        </label>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="name">
                            {{ trans('app.headers.name') }} :
                        </label>

                        <label class="control-label" for="name" style="font-weight: normal">
                            {{ $entity->name }}
                        </label>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="description">
                            {{ trans('app.headers.description') }} :
                        </label>

                        <label class="control-label" for="description" style="font-weight: normal">
                            {{ $entity->description }}
                        </label>
                    </div>

                    @if($entity->managers()->count() > 0)
                        <div class="item form-group">
                            <label class="control-label col-md-5 col-sm-4 col-xs-12" for="employee_id">
                                {{ trans('departments.labels.manager') }} :
                            </label>

                            <label class="control-label" for="employee_id" style="font-weight: normal">
                                {{ $entity->managers()->first()->first_name . ' ' . $entity->managers()->first()->last_name }}
                            </label>
                        </div>
                    @endif

                    @if($entity->parent_id)
                        <div class="item form-group">
                            <label class="control-label col-md-5 col-sm-4 col-xs-12" for="parent">
                                {{ trans('departments.labels.parent_department') }} :
                            </label>

                            <label class="control-label" for="parent" style="font-weight: normal">
                                {{ $entity->parentDepartment->name }}
                            </label>
                        </div>
                    @endif

                    @if(count($entity->childrenDepartments) > 0)
                        <div class="item form-group">
                            <label class="control-label col-md-5 col-sm-4 col-xs-12" for="parent">
                                {{ trans('departments.labels.department_children') }} :
                            </label>

                            <div class="col-md-7 col-sm-8 col-xs-12" style="padding: 0;">
                                @foreach($entity->childrenDepartments as $childDepartment)
                                    <label class="control-label" for="parent" style="font-weight: normal">
                                        {{ $childDepartment->name }}
                                    </label><br>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="phone_number">
                            {{ trans('departments.labels.phone_number') }} :
                        </label>

                        <label class="control-label" for="phone_number"
                               style="font-weight: normal">
                            {{ $entity->phone_number }}
                        </label>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="enable">
                            {{ trans('app.headers.enabled') }} :
                        </label>
                        <label class="control-label">
                            <i class="fa @if($entity->enabled) fa-check text-success @else fa-times text-danger @endif"></i>
                        </label>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> {{ trans('app.labels.accept') }}</button>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission