<ul>
    @foreach($entity->getCheckList() as $item)
        <li>
            <small>{!!  $item['name'] !!}</small>
        </li>
    @endforeach
</ul>
