@extends('curlyspoon::layout')

@section('content')
    @foreach($content as $element)
        {!! app(Curlyspoon\Framework\Contracts\ElementManager::class)->render($element['type'], $element['data']) !!}
    @endforeach
@endsection