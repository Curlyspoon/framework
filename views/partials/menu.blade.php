<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Curlyspoon</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="primary-menu">
            <ul class="navbar-nav mr-auto">
                @foreach($menu as $menuItem)
                    <li class="nav-item @if($menuItem->isCurrent()) active @endif">
                        <a class="nav-link" href="{{ $menuItem->getLink() }}">
                            {{ $menuItem->getLabel() }}
                            @if($menuItem->isCurrent())
                                <span class="sr-only">(current)</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>