@extends('templates.homepage')

@section('content')

<!-- First Parallax Image with Logo Text -->
      <div class="row justify-content-center parent text-center">
          <img src="{{$user->getCoverUrl() }}" class="cover"  >
      </div>

<!-- Container (About Section) -->
<div class="w3-content w3-container w3-padding-64">
  <div class="col-lg-6">
    <h5> Bạn bè của {{ $user->getFirstNameOrUsername() }} </h5>
      @if (!$user->friends()->count())
          <p>{{ $user->getFirstNameOrUsername() }} chưa có bạn bè nào.</p>
      @else
          @foreach ($user->friends() as $user)
              @include('user/partials/userblock')
          @endforeach
      @endif
  </div>

  <div class="col-lg-6">

    <h5> Lời mời kết bạn </h5>
      @if (!$requests->count())
          <p>Bạn chưa có lời mời kết bạn nào.</p>
      @else
          @foreach ($requests as $user)
              @include('user/partials/userblock')
          @endforeach
      @endif
  </div>
</div>


@stop
