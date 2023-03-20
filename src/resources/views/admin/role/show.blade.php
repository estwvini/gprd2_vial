@permission('show.roles')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i>
            {{ trans('roles.labels.details', ['role' => $entity->name]) }}
        </h4>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                {{-- First level: Modules --}}
                @foreach($modules as $module)
                    <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="heading{{ $loop->iteration }}"
                           data-toggle="collapse" data-parent="#accordion"
                           href="#collapse{{ $loop->iteration }}" aria-expanded="false"
                           aria-controls="collapse{{ $loop->iteration }}">
                            <h4 class="panel-title">{{ $module['name'] }}</h4>
                        </a>
                        <div id="collapse{{ $loop->iteration }}" class="panel-collapse collapse"
                             role="tabpanel" aria-labelledby="heading{{ $loop->iteration }}"
                             aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <div class="x_content">
                                    <div class="accordion config-roles-permissions"
                                         id="configRolesAccordion" role="tablist"
                                         aria-multiselectable="true">
                                        {{-- Second level: First Level Permissions --}}
                                        @foreach(permissions($entity, $module['id']) as $key1 => $permission1)
                                            <div class="panel">
                                                <a class="panel-heading" role="tab"
                                                   id="heading-{{ $permission1['name'] . $key1 }}"
                                                   href="#collapse-{{ $permission1['name'] . $key1 }}"
                                                   data-toggle="collapse"
                                                   data-parent="#configRolesAccordion"
                                                   aria-expanded="true"
                                                   aria-controls="collapse-{{ $permission1['name'] }}">
                                                    <h4 class="panel-title text-uppercase">
                                                        {{ $permission1['label'] }}
                                                    </h4>
                                                </a>
                                                <div role="tabpanel" class="panel-collapse collapse"
                                                     id="collapse-{{ $permission1['name'] . $key1 }}"
                                                     aria-labelledby="heading-{{ $permission1['name'] . $key1 }}">
                                                    <div class="panel-body">
                                                        <div>
                                                            <ul class="to_do"
                                                                id="{{ $permission1['name'] }}">
                                                                {{-- Third level: Second Level Permissions --}}
                                                                @foreach(order_permissions($permission1['actions']) as $key2 => $permission2)
                                                                    <li>
                                                                        @if(isset($permission2['is_primary']) && $permission2['is_primary'])
                                                                            <div class="panel">
                                                                                <a class="panel-heading"
                                                                                   role="tab"
                                                                                   id="heading-{{ $key1 . $key2 }}"
                                                                                   href="#collapse-{{ $key1 . $key2 }}"
                                                                                   data-toggle="collapse"
                                                                                   aria-expanded="true"
                                                                                   aria-controls="collapse-{{ $key2 }}">
                                                                                    <h4 class="panel-title text-uppercase">
                                                                                        {{ $permission2['label'] }}
                                                                                    </h4>
                                                                                </a>
                                                                                <div role="tabpanel"
                                                                                     class="panel-collapse collapse"
                                                                                     id="collapse-{{ $key1 . $key2 }}"
                                                                                     aria-labelledby="heading-{{ $key1 . $key2 }}"
                                                                                     aria-expanded="true">
                                                                                    <div class="panel-body">
                                                                                        <div>
                                                                                            <ul class="to_do"
                                                                                                id="{{ $key2 }}"
                                                                                                base_second="{{ $permission1['name'] }}">
                                                                                                {{-- Fourt level: Third Level Permissions --}}
                                                                                                @foreach(order_permissions($permission2['inner']) as $key3 => $permission3)
                                                                                                    <li>
                                                                                                        @if(isset($permission3['is_primary']) && $permission3['is_primary'])
                                                                                                            <div class="panel">
                                                                                                                <a class="panel-heading"
                                                                                                                   role="tab"
                                                                                                                   id="heading-{{ $key1 . $key2 . $key3 }}"
                                                                                                                   href="#collapse-{{ $key1 . $key2 . $key3 }}"
                                                                                                                   data-toggle="collapse"
                                                                                                                   aria-expanded="true"
                                                                                                                   aria-controls="collapse-{{ $key3 }}">
                                                                                                                    <h4 class="panel-title text-uppercase">
                                                                                                                        {{ $permission3['label'] }}
                                                                                                                    </h4>
                                                                                                                </a>
                                                                                                                <div role="tabpanel"
                                                                                                                     class="panel-collapse collapse"
                                                                                                                     id="collapse-{{ $key1 . $key2 . $key3 }}"
                                                                                                                     aria-labelledby="heading-{{ $key1 . $key2 . $key3 }}"
                                                                                                                     aria-expanded="true">
                                                                                                                    <div class="panel-body">
                                                                                                                        <div>
                                                                                                                            <ul class="to_do"
                                                                                                                                id="{{ $key3 }}"
                                                                                                                                base_second="{{ $permission1['name'] }}"
                                                                                                                                base_third="{{ $key2 }}">
                                                                                                                                {{-- Fifth level: Fourth Level Permissions --}}
                                                                                                                                @foreach(order_permissions($permission3['inner']) as $key4 => $permission4)
                                                                                                                                    <li>
                                                                                                                                        @if(isset($permission4['is_primary']) && $permission4['is_primary'])
                                                                                                                                            <div class="panel">
                                                                                                                                                <a class="panel-heading"
                                                                                                                                                   role="tab"
                                                                                                                                                   id="heading-{{ $key1 . $key2 . $key3 . $key4 }}"
                                                                                                                                                   href="#collapse-{{ $key1 . $key2 . $key3 . $key4 }}"
                                                                                                                                                   data-toggle="collapse"
                                                                                                                                                   aria-expanded="true"
                                                                                                                                                   aria-controls="collapse-{{ $key4 }}">
                                                                                                                                                    <h4 class="panel-title text-uppercase">
                                                                                                                                                        {{ $permission4['label'] }}
                                                                                                                                                    </h4>
                                                                                                                                                </a>
                                                                                                                                                <div role="tabpanel"
                                                                                                                                                     class="panel-collapse collapse"
                                                                                                                                                     id="collapse-{{ $key1 . $key2 . $key3 . $key4 }}"
                                                                                                                                                     aria-labelledby="heading-{{ $key1 . $key2 . $key3 . $key4 }}"
                                                                                                                                                     aria-expanded="true">
                                                                                                                                                    <div class="panel-body">
                                                                                                                                                        <div>
                                                                                                                                                            <ul class="to_do"
                                                                                                                                                                id="{{ $key4 }}"
                                                                                                                                                                base_second="{{ $permission1['name'] }}"
                                                                                                                                                                base_third="{{ $key2 }}"
                                                                                                                                                                base_fourth="{{ $key3 }}">
                                                                                                                                                                {{-- Sixth level: Fifth Level Permissions--}}
                                                                                                                                                                @foreach(order_permissions($permission4['inner']) as $key5 => $permission5)
                                                                                                                                                                    <li>
                                                                                                                                                                        @if(isset($permission5['is_primary']) && $permission5['is_primary'])
                                                                                                                                                                            <div class="panel">
                                                                                                                                                                                <a class="panel-heading"
                                                                                                                                                                                   role="tab"
                                                                                                                                                                                   id="heading-{{ $key1 . $key2 . $key3 . $key4 . $key5 }}"
                                                                                                                                                                                   href="#collapse-{{ $key1 . $key2 . $key3 . $key4 . $key5 }}"
                                                                                                                                                                                   data-toggle="collapse"
                                                                                                                                                                                   aria-expanded="true"
                                                                                                                                                                                   aria-controls="collapse-{{ $key5 }}">
                                                                                                                                                                                    <h4 class="panel-title text-uppercase">
                                                                                                                                                                                        {{ $permission5['label'] }}
                                                                                                                                                                                    </h4>
                                                                                                                                                                                </a>
                                                                                                                                                                                <div role="tabpanel"
                                                                                                                                                                                     class="panel-collapse collapse"
                                                                                                                                                                                     id="collapse-{{ $key1 . $key2 . $key3 . $key4 . $key5 }}"
                                                                                                                                                                                     aria-labelledby="heading-{{ $key1 . $key2 . $key3 . $key4 . $key5 }}"
                                                                                                                                                                                     aria-expanded="true">
                                                                                                                                                                                    <div class="panel-body">
                                                                                                                                                                                        <div>
                                                                                                                                                                                            <ul class="to_do"
                                                                                                                                                                                                id="{{ $key5 }}"
                                                                                                                                                                                                base_second="{{ $permission1['name'] }}"
                                                                                                                                                                                                base_third="{{ $key2 }}"
                                                                                                                                                                                                base_fourth="{{ $key3 }}"
                                                                                                                                                                                                base_fifth="{{ $key4 }}">
                                                                                                                                                                                                {{-- Seventh level: Sixth Level Permissions--}}
                                                                                                                                                                                                @foreach(order_permissions($permission5['inner']) as $key6 => $permission6)
                                                                                                                                                                                                    <li>
                                                                                                                                                                                                        @if(isset($permission6['is_primary']) && $permission6['is_primary'])
                                                                                                                                                                                                            <div class="panel">
                                                                                                                                                                                                                <a class="panel-heading"
                                                                                                                                                                                                                   role="tab"
                                                                                                                                                                                                                   id="heading-{{ $key1 . $key2 . $key3 . $key4 . $key5 . $key6 }}"
                                                                                                                                                                                                                   href="#collapse-{{ $key1 . $key2 . $key3 . $key4 . $key5 . $key6 }}"
                                                                                                                                                                                                                   data-toggle="collapse"
                                                                                                                                                                                                                   aria-expanded="true"
                                                                                                                                                                                                                   aria-controls="collapse-{{ $key6 }}">
                                                                                                                                                                                                                    <h4 class="panel-title text-uppercase">
                                                                                                                                                                                                                        {{ $permission6['label'] }}
                                                                                                                                                                                                                    </h4>
                                                                                                                                                                                                                </a>
                                                                                                                                                                                                                <div role="tabpanel"
                                                                                                                                                                                                                     class="panel-collapse collapse"
                                                                                                                                                                                                                     id="collapse-{{ $key1 . $key2 . $key3 . $key4 . $key5 . $key6 }}"
                                                                                                                                                                                                                     aria-labelledby="heading-{{ $key1 . $key2 . $key3 . $key4 . $key5 . $key6 }}"
                                                                                                                                                                                                                     aria-expanded="true">
                                                                                                                                                                                                                    <div class="panel-body">
                                                                                                                                                                                                                        <div>
                                                                                                                                                                                                                            <ul class="to_do"
                                                                                                                                                                                                                                id="{{ $key6 }}"
                                                                                                                                                                                                                                base_second="{{ $permission1['name'] }}"
                                                                                                                                                                                                                                base_third="{{ $key2 }}"
                                                                                                                                                                                                                                base_fourth="{{ $key3 }}"
                                                                                                                                                                                                                                base_fifth="{{ $key4 }}"
                                                                                                                                                                                                                                base_sixth="{{ $key5 }}">
                                                                                                                                                                                                                                {{-- Eigth level: Seventh Level Permissions--}}
                                                                                                                                                                                                                                @foreach(order_permissions($permission6['inner']) as $key7 => $permission7)
                                                                                                                                                                                                                                    <li>
                                                                                                                                                                                                                                        <label>
                                                                                                                                                                                                                                            <input type="checkbox"
                                                                                                                                                                                                                                                   value="{{ $key7 }}"
                                                                                                                                                                                                                                                   class="js-switch js-check-permission"
                                                                                                                                                                                                                                                   @if($permission7['allowed'] == 'true') checked @endif disabled/>
                                                                                                                                                                                                                                            {{ $permission7['label'] }}
                                                                                                                                                                                                                                        </label>
                                                                                                                                                                                                                                    </li>
                                                                                                                                                                                                                                @endforeach
                                                                                                                                                                                                                            </ul>
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                            </div>
                                                                                                                                                                                                        @else
                                                                                                                                                                                                            <label>
                                                                                                                                                                                                                <input type="checkbox"
                                                                                                                                                                                                                       value="{{ $key6 }}"
                                                                                                                                                                                                                       class="js-switch js-check-permission"
                                                                                                                                                                                                                       @if($permission6['allowed'] == 'true') checked @endif disabled/>
                                                                                                                                                                                                                {{ $permission6['label'] }}
                                                                                                                                                                                                            </label>
                                                                                                                                                                                                        @endif
                                                                                                                                                                                                    </li>
                                                                                                                                                                                                @endforeach
                                                                                                                                                                                            </ul>
                                                                                                                                                                                        </div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        @else
                                                                                                                                                                            <label>
                                                                                                                                                                                <input type="checkbox"
                                                                                                                                                                                       value="{{ $key5 }}"
                                                                                                                                                                                       class="js-switch js-check-permission"
                                                                                                                                                                                       @if($permission5['allowed'] == 'true') checked @endif disabled/>
                                                                                                                                                                                {{ $permission5['label'] }}
                                                                                                                                                                            </label>
                                                                                                                                                                        @endif
                                                                                                                                                                    </li>
                                                                                                                                                                @endforeach
                                                                                                                                                            </ul>
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        @else
                                                                                                                                            <label>
                                                                                                                                                <input type="checkbox"
                                                                                                                                                       value="{{ $key4 }}"
                                                                                                                                                       class="js-switch js-check-permission"
                                                                                                                                                       @if($permission4['allowed'] == 'true') checked @endif disabled/>
                                                                                                                                                {{ $permission4['label'] }}
                                                                                                                                            </label>
                                                                                                                                        @endif
                                                                                                                                    </li>
                                                                                                                                @endforeach
                                                                                                                            </ul>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @else
                                                                                                            <label>
                                                                                                                <input type="checkbox"
                                                                                                                       class="js-switch js-check-permission"
                                                                                                                       value="{{ $key3 }}"
                                                                                                                       @if($permission3['allowed'] == 'true') checked @endif disabled/>
                                                                                                                {{ $permission3['label'] }}
                                                                                                            </label>
                                                                                                        @endif
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <label>
                                                                                <input type="checkbox"
                                                                                       class="js-switch js-check-permission"
                                                                                       value="{{ $key2 }}"
                                                                                       @if($permission2['allowed'] == 'true') checked @endif disabled/>
                                                                                {{ $permission2['label'] }}
                                                                            </label>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> {{ trans('app.labels.accept') }}</button>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission