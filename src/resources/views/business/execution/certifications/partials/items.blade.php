@foreach($items as $item)
    <tr>
        <td>
            {{ $item->code }}
            <br>
            {{ $item->name }}
        </td>
        <td class="text-center">
            {{ $item->for_compromising }}
        </td>
        <td>
            <input type="text" id="amount" name="item_{{ $item->id }}" class="form-control mt-0" placeholder="Monto" value="{{ $item->certified ?? '' }}">
        </td>
    </tr>
@endforeach