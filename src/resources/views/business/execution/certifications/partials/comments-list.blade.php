<ul class="messages">
    @foreach($entity->comments as $comment)
        <li>
            <img src="{{ asset($comment->user->photoPath()) }}" class="img-circle avatar" alt="Avatar">
            <div class="message_date">
                <h3 class="date mb-0 mt-0" style="color: #5cb85c">{{ \Carbon\Carbon::parse($comment->created_at)->formatLocalized('%d') }}</h3>
                <p class="month mb-0"> {{ strtoupper(\Carbon\Carbon::parse($comment->created_at)->formatLocalized('%b')) }}</p>
                <span class=""><i class="fa fa-clock-o" style="color: #5cb85c"></i> {{ \Carbon\Carbon::parse($comment->created_at)->formatLocalized('%r') }}</span>
            </div>
            <div class="message_wrapper pb-2">
                <h4 class="heading">{{ $comment->user->fullName() }}</h4>
                <blockquote class="message mb-2">{{ $comment->comment }}</blockquote>
            </div>
        </li>
    @endforeach
</ul>