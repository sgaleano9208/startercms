<div>
    {{-- {{ $getState() }} --}}
    <ul>
    @foreach ( $getState() as $item)
        <li>{{$item->client->name}} - {{ date_format($item->date, 'd/m/Y') }}</li>
    @endforeach
    </ul>
</div>