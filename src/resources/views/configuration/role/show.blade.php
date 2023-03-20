@role('developer')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('configuration.role.title') }}
                <small>{{ trans('configuration.title') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li>
                    <a href="{{ route('index.roles.configuration') }}" class="ajaxify">
                        {{ trans('configuration.role.title') }}
                    </a>
                </li>
                <li class="active"> {{ trans('app.labels.permissions') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-list-ol"></i> {{ trans('configuration.role.labels.permissions', ['role' => $entity->name]) }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.roles.configuration') }}" class="btn btn-box-tool ajaxify"
                               data-toggle="tooltip" data-placement="top"
                               data-original-title="{{ trans('app.labels.close') }}">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

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
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox"
                                                                                       class="js-switch js-check-all-permissions">
                                                                                {{ trans('roles.labels.check_all') }}
                                                                            </label>
                                                                        </li>
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
                                                                                                        <li>
                                                                                                            <label>
                                                                                                                <input type="checkbox"
                                                                                                                       class="js-switch js-check-all-permissions">
                                                                                                                {{ trans('roles.labels.check_all') }}
                                                                                                            </label>
                                                                                                        </li>
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
                                                                                                                                        <li>
                                                                                                                                            <label>
                                                                                                                                                <input type="checkbox"
                                                                                                                                                       class="js-switch js-check-all-permissions">
                                                                                                                                                {{ trans('roles.labels.check_all') }}
                                                                                                                                            </label>
                                                                                                                                        </li>
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
                                                                                                                                                                        <li>
                                                                                                                                                                            <label>
                                                                                                                                                                                <input type="checkbox"
                                                                                                                                                                                       class="js-switch js-check-all-permissions">
                                                                                                                                                                                {{ trans('roles.labels.check_all') }}
                                                                                                                                                                            </label>
                                                                                                                                                                        </li>
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
                                                                                                                                                                                                        <li>
                                                                                                                                                                                                            <label>
                                                                                                                                                                                                                <input type="checkbox"
                                                                                                                                                                                                                       class="js-switch js-check-all-permissions">
                                                                                                                                                                                                                {{ trans('roles.labels.check_all') }}
                                                                                                                                                                                                            </label>
                                                                                                                                                                                                        </li>
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
                                                                                                                                                                                                                                        <li>
                                                                                                                                                                                                                                            <label>
                                                                                                                                                                                                                                                <input type="checkbox"
                                                                                                                                                                                                                                                       class="js-switch js-check-all-permissions">
                                                                                                                                                                                                                                                {{ trans('roles.labels.check_all') }}
                                                                                                                                                                                                                                            </label>
                                                                                                                                                                                                                                        </li>
                                                                                                                                                                                                                                        {{-- Eigth level: Seventh Level Permissions--}}
                                                                                                                                                                                                                                        @foreach(order_permissions($permission6['inner']) as $key7 => $permission7)
                                                                                                                                                                                                                                            <li>
                                                                                                                                                                                                                                                <label>
                                                                                                                                                                                                                                                    <input type="checkbox"
                                                                                                                                                                                                                                                           value="{{ $key7 }}"
                                                                                                                                                                                                                                                           class="js-switch js-check-permission"
                                                                                                                                                                                                                                                           @if($permission7['allowed'] == 'true') checked @endif/>
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
                                                                                                                                                                                                                               @if($permission6['allowed'] == 'true') checked @endif/>
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
                                                                                                                                                                                               @if($permission5['allowed'] == 'true') checked @endif/>
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
                                                                                                                                                               @if($permission4['allowed'] == 'true') checked @endif/>
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
                                                                                                                               @if($permission3['allowed'] == 'true') checked @endif/>
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
                                                                                               @if($permission2['allowed'] == 'true') checked @endif/>
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

                    <div class="ln_solid"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a class="btn btn-info ajaxify" href="{{ route('index.roles.configuration') }}">
                            <i class="fa fa-times"></i> {{ trans('app.labels.close') }}
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        function _allChecked($ul) {
            let checked = true;
            $ul.find('input.js-check-permission').each(function () {
                checked = checked && $(this).is(':checked');
            });

            return checked;
        }

        $('.js-check-all-permissions').each(function () {

            $(this).attr('checked', _allChecked($(this).closest('ul')));

            $(this).on('click', function () {
                let $this = $(this);
                if ($this.attr('data-update')) {
                    $this.removeAttr('data-update');
                } else {
                    let $ul = $this.closest('ul');
                    let base = $ul.attr('id');
                    let checked = $this.is(':checked');
                    let base_second = $ul.attr('base_second');
                    let base_third = $ul.attr('base_third');
                    let base_fourth = $ul.attr('base_fourth');
                    let base_fifth = $ul.attr('base_fifth');
                    let base_sixth = $ul.attr('base_sixth');

                    pushRequest('{!! route('all.permissions.show.roles.configuration') !!}', null, function (response) {
                        if (response.message && response.message.type === 'success') {
                            $ul.find('input.js-check-permission').each(function () {
                                let thisChecked = $(this).is(':checked');

                                if ((checked && !thisChecked) || (!checked && thisChecked)) {
                                    $(this).attr('data-update', true).trigger('click');
                                }
                            });
                            //Marcar otros niveles
                            $ul.find('input.js-check-all-permissions').each(function () {
                                let thisChecked = $(this).is(':checked');

                                if ((checked && !thisChecked) || (!checked && thisChecked)) {
                                    $(this).attr('data-update', true).trigger('click');
                                }
                            });
                        }
                    }, 'put', {
                        _token: '{{ csrf_token() }}',
                        role: '{{ $entity->slug }}',
                        base: base,
                        checked: checked,
                        base_second: base_second,
                        base_third: base_third,
                        base_fourth: base_fourth,
                        base_fifth: base_fifth,
                        base_sixth: base_sixth
                    }, null, false);
                }
            });
        });

        $('.js-check-permission').on('click', function () {
            let $this = $(this);

            if ($this.attr('data-update')) {
                $this.removeAttr('data-update');
            } else {
                let $ul = $this.closest('ul');
                let base = $ul.attr('id');
                let base_second = $ul.attr('base_second');
                let base_third = $ul.attr('base_third');
                let base_fourth = $ul.attr('base_fourth');
                let base_fifth = $ul.attr('base_fifth');
                let base_sixth = $ul.attr('base_sixth');
                let action = $this.val();

                pushRequest('{!! route('permissions.show.roles.configuration') !!}', null, function () {
                    $ul.find('input.js-check-all-permissions').each(function () {
                        let thisChecked = $(this).is(':checked');
                        let allChecked = _allChecked($ul);

                        if ((allChecked && !thisChecked) || (!allChecked && thisChecked)) {
                            $(this).attr('data-update', true).trigger('click');
                        }
                    });
                }, 'put', {
                    _token: '{{ csrf_token() }}',
                    role: '{{ $entity->slug }}',
                    base: base,
                    action: action,
                    base_second: base_second,
                    base_third: base_third,
                    base_fourth: base_fourth,
                    base_fifth: base_fifth,
                    base_sixth: base_sixth
                }, null, false);
            }
        });

        $('#configRolesEditableSwitch').on('change', function (e) {
            e.preventDefault();
            pushRequest('{!! route('editable.roles.configuration', ['id' => $entity->id]) !!}', null, null, 'put', {
                _token: '{{ csrf_token() }}'
            });
        });

    });
</script>

@else
    @include('errors.403')
    @endrole