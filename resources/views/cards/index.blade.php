@extends('layouts.app')

@section('content')
    <div class="col-md-12">
      <h1>All Cards</h1>

      @foreach($cards as $card)
        <div>
          <a href="/cards/{{ $card->id }}">{{ $card->title }}</a>
        </div>
      @endforeach
    </div>
@endsection
