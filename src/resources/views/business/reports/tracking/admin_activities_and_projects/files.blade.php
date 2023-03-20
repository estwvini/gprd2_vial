@foreach($files as $file)
    <ul>
        <li>
            {{ $file->name }}
        </li>
    </ul>
@endforeach
