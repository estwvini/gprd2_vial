<ul>
    @foreach($entity->comments as $comment)
        <li>
            <small>{!!  $comment->comment !!}</small>
        </li>
    @endforeach
</ul>


