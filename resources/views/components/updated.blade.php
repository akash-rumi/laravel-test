<u> 
    {{ empty(trim($slot)) ? 'Added ' : $slot }} {{ $date->diffForHumans() }}
    @if(isset($name))
        @if(isset($userId))
            by <a href="{{ route('user.show', ['user' => $userId]) }}">{{ $name }}</a>
        @else
            by {{ $name }}
        @endif
    @endif
</u>