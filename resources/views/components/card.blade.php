<div class="card-body">
    <h4 class="card-title"> {{$title}} </h4>
    <h6 class="card-subtitle text-muted">
        <u> {{$subtitle}} </u>
    </h6>
</div>
<ul class="list-group list-group-flush">
    @if(is_a($items, 'Illuminate\Support\Collection'))
        @foreach ($items as $item)
            <li class="list-group-item">
                {{ $item }}
            </li>
        @endforeach
    @else
        {{ $items }}
    @endif
</ul>