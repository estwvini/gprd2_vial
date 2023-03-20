<div class="x_panel tile">
    <div class="x_content">
        <div class="row top_tiles">

            @foreach($stat_tiles as $tile)
                <div class="zindex-0 well-sm col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="x_content">
                            <div class="icon"><i class="fa {{ $tile['icon'] }}"></i></div>
                            <div class="count">{{ $tile['amount'] }}</div>
                            <h3>{{ $tile['title'] }}</h3>
                            <p>{{ $tile['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
