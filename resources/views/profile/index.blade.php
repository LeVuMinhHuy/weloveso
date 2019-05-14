@extends('templates.homepage')

@section('content')
<style>
  .cover{
    
  width: 80%;
  max-height:300px;
  height:40vh;
  min-height:150px;
}
.parent {
  position: relative;
  top: 0;
  left: 0;
}
.cover {
  position: relative;
  top: 0;
  left: 0;
}
.UserAvatar {
  position: absolute;
  top: 15%;
  left: 15%;
}
@media  (max-width: 720px) {
  .cover{
  height:25vh;
  }
  .UserAvatar {
  top: 25%;
  left: 15%;
}
}
</style>
<!-- First Parallax Image with Logo Text -->
<div class="w3-display-container w3-opacity-min" id="home" >
    <br><br><br><br>
      <div class="row justify-content-center parent text-center">
        <img src="{{Auth::user()->getCoverUrl() }}" class="cover"  >
        <div class="profile-header-container">
          <div class="profile-header-img">
            <img style=" border-radius: 50%; width:12%"
               class="rounded-circle UserAvatar" src="{{Auth::user()->getAvatarUrl() }}" >                
            <div class="rank-label-container">
              <span class="label label-default rank-label">{{$user->name}}</span>
            </div>
          </div>
        </div>

      </div> 
</div>

<!-- Container (About Section) -->
<div class="w3-content w3-container w3-padding-64" id="about">
  <h4 class="w3-center"> {{ $user->getNameOrUsername() }} 
  </h4>

  <div align="right">
      @if (Auth::user()->hasFriendRequestPending($user))
        <p> Đang chờ {{ $user->getNameOrUsername() }} phản hồi lời mới kết bạn của bạn</p>
      @elseif (Auth::user()->hasFriendRequestReceived($user))
        <a href="{{ route('friend.accept', ['username' => $user->username]) }}" class="m-btn m-btn--action m-btn--login">Chấp nhận</a>
      @elseif (Auth::user()->isFriendsWith($user))
        <p>Bạn và {{ $user->getFirstNameOrUserName() }} đã là bạn bè.</p>
      @else
        @if (Auth::user()->username!=$user->username)
        <a href="{{ route('friend.add', ['username' => $user->username]) }}" class="m-btn m-btn--action m-btn--login">Kết bạn</a>
        @endif
      @endif
  </div>
   
  <p><h3>Introduction</h3></p>
  
  
  <div class="w3-row">
    <div class="w3-col m5 w3-center w3-padding-large">
      <img src="{{$user->getIntroImage()}}" class="w3-round w3-image" alt="Photo of Me" width="500" height="333">
    </div>

    <!-- Hide this text on small devices -->
    <div class="w3-col m6 w3-padding-large">
    <p>{{$user->getIntro()}}</p>
    @if ($user->username==Auth::user()->username)
    <button type="submit" class="w3-button w3-blue " onclick="return edit();">Edit</button>
    @endif
    </div>
  </div>
  @if ($user->username==Auth::user()->username)
  <div class="container w3-col" id="edit-intro">
    <form class="form-horizontal" role="form" method="post" action = "{{route('profile.intro')}}" onsubmit="return validateForm()"  enctype="multipart/form-data" style="width: 80%;">

    <div class="form-group">
        <label for="first">Intro:</label>
        <textarea class="form-control" rows="5" id="first" name="first"></textarea>
        <label for="first_image">Image:</label>
        <input  class="form-control" type="file" name="first_image">
    </div>
    <input type="hidden" name="_token" value="{{ Session::token() }}">
    <input type="submit" class="btn btn-primary" value="Save Changes">
    <button type="submit" class="w3-button w3-blue " onclick="return back();">Cancel</button>
    </form>
  </div>
  @endif
<!-- Second Parallax Image with Portfolio Text
<div class="bgimg-2 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
    <span class="w3-xxlarge w3-text-white w3-wide">ơ</span>
  </div>
</div> -->

<!-- Container (Portfolio Section) -->
<div class="w3-content w3-container w3-padding-64" id="portfolio">
  <h3 class="w3-center">Feature Picture</h3>

  <!-- Responsive Grid. Four columns on tablets, laptops and desktops. Will stack on mobile devices/small screens (100% width) -->
  

  <div class="w3-row-padding w3-center">
    <div class="w3-col m3">
      <img src="{{asset('images/try_hard.jpg')}}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="The mist over the mountains">
    </div>

    <div class="w3-col m3">
      <img src="{{asset('images/try_hard.jpg')}}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Coffee beans">
    </div>

    <div class="w3-col m3">
      <img src="{{asset('images/try_hard.jpg')}}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Bear closeup">
    </div>

    <div class="w3-col m3">
      <img src="{{asset('images/try_hard.jpg')}}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Quiet ocean">
    </div>
  </div>
  <div class="w3-row-padding w3-center w3-section">
    <div class="w3-col m3">
      <img src="{{asset('images/try_hard.jpg')}}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="The mist">
    </div>

    <div class="w3-col m3">
      <img src="{{asset('images/try_hard.jpg')}}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="My beloved typewriter">
    </div>

    <div class="w3-col m3">
      <img src="{{asset('images/try_hard.jpg')}}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Empty ghost train">
    </div>

    <div class="w3-col m3">
      <img src="{{asset('images/try_hard.jpg')}}" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Sailing">
    </div>
  </div>
  @if ($statuses->count())
                          @foreach ($statuses as $status)


                            <minds-activity class="mdl-card m-border item ng-star-inserted">
                                <div class="mdl-card__supporting-text mdl-color-text--grey-600 m-owner-block ng-star-inserted">
                                    <div class="avatar" >
                                        <a href="{{route('profile.index', ['username' => $status->user->username])}}"><img class="mdl-shadow--2dp" src="{{ $status->user->getAvatarUrl() }}"></a>
                                    </div>

                                    <div class="body">
                                        <a href="{{route('profile.index', ['username' => $status->user->username])}}"><strong> {{ $status->user->getNameOrUsername() }} </strong>
                                          <!-- <div class="m-channel--badges-activity">
                                            <ul class="m-channel--badges">
                                              <li class="ng-star-inserted">
                                                  <m-tooltip icon="verified_user">
                                                      <div class="m-tooltip">
                                                          <i class="material-icons selected ng-star-inserted">verified_user</i>
                                                             <div class="m-tooltip--bubble" hidden=""> Verified </div>
                                                      </div>
                                                  </m-tooltip>
                                              </li>
                                            </ul>
                                          </div> -->
                                        </a>

                                      <a class="permalink ng-star-inserted" href=""><span>{{ $status->created_at->diffForHumans() }}</span><!----><!----></a>

                                    </div>
                                </div>

                                <div class="mdl-card__supporting-text message m-mature-message ng-star-inserted" m-read-more="">
                                   <span class="m-mature-message-content">
                                          {{ $status->body }}
                                    </span>
                                    
                                    <m-read-more--button>
                                        <!---->
                                    </m-read-more--button>

                                </div>

                                <m-translate class="ng-star-inserted">

                                </m-translate>

                                <!-- <div class="tabs ng-star-inserted">
                                    <minds-button><a class="mdl-color-text--blue-grey-500"><i class="material-icons">thumb_up</i><span class="minds-counter ng-star-inserted">?</span></a></minds-button>
                                    <minds-button><a class="mdl-color-text--blue-grey-500"><i class="material-icons">thumb_down</i><span class="minds-counter ng-star-inserted">?</span></a></minds-button>
                                    
                                    <m-wire-button class="ng-star-inserted">
                                        <button class="m-wire-button"><i class="ion-icon ion-flash"></i></button>
                                    </m-wire-button>

                                    <minds-button><a class="mdl-color-text--blue-grey-500 selected"><i class="material-icons">chat_bubble</i><span class="minds-counter ng-star-inserted">?</span></a></minds-button>
                                    <minds-button><a class="mdl-color-text--blue-grey-500"><i class="material-icons">repeat</i><span class="minds-counter ng-star-inserted">?</span></a></minds-button>
                                    
                                </div> -->
                                <!---->
                                <div class="impressions-tag m-activity--metrics m-activity--metrics-wire ng-star-inserted">
                                    <div class="m-activity--metrics-inner m-border">
                                        <div class="m-activity--metrics-metric"><i class="ion-icon ion-flash"></i>
                                            <!----><span class="ng-star-inserted">?</span></div>
                                        <div class="m-activity--metrics-metric"><i class="material-icons">remove_red_eye</i><span>?</span></div>
                                    </div>
                                </div>

                                <minds-comments>
                                    <div class="m-comment m-comment--poster minds-block ng-star-inserted">
                                        <div class="minds-avatar">
                                            <a href="{{route('profile.index', ['username' => $status->user->username])}}"><img class="mdl-shadow--2dp" src="{{ $status->user->getAvatarUrl() }}"></a>
                                        </div>
                                        <div class="minds-body">
                                            <div class="m-comments-composer">
                                                <form class="ng-untouched ng-pristine ng-valid" action="{{ route('status.reply', ['statusId' => $status->id])}}" method="post">
                                                    <minds-textarea name="reply">
                                                    </minds-textarea>
                                                    <input type="submit" class="m-btn" value="Nhập">
                                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </minds-comments>

                                <!-- <form role = "form" action = "{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
                                    <div class="form-group{{ $errors->has('reply-{$status->id}') ? ' has-error' : ''}}">
                                        <textarea name="reply-{{ $status->id }}" class="m-comments-composer">
                                          
                                        </textarea>
                                        @if ($errors->has("reply-{$status->id}"))
                                            <span class="help-block">
                                                {{$errors->first("reply-{$status->id}")}}
                                            </span>
                                        @endif
                                    </div>
                                    <input type="submit" class="m-btn" value="Nhập">
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                </form> -->
                                <!---->
                                <!---->
                                <!---->
                                <div class="mdl-card__menu mdl-color-text--blue-grey-300 ng-star-inserted">
                                    <button class="mdl-button m-pin-button mdl-button--icon">
                                    </button>
                                    <button class="mdl-button m-translate-button mdl-button--icon ng-star-inserted"><i class="material-icons">public</i></button>
                                   <!--  <m-post-menu>
                                        <button class="mdl-button minds-more mdl-button--icon" data-vivaldi-spatnav-clickable="1"><i class="material-icons">keyboard_arrow_down</i></button>
                                        <ul class="minds-dropdown-menu" hidden="">
                                            <li class="mdl-menu__item ng-star-inserted" data-vivaldi-spatnav-clickable="1">Share</li>
                                            <li class="mdl-menu__item ng-star-inserted" data-vivaldi-spatnav-clickable="1">Translate</li>
                                            <li class="mdl-menu__item ng-star-inserted" data-vivaldi-spatnav-clickable="1">Report</li>
                                            <li class="mdl-menu__item ng-star-inserted" disabled="">Follow post</li>
                                            <li class="mdl-menu__item ng-star-inserted" data-vivaldi-spatnav-clickable="1">Block user</li>
                                        </ul>
                                        <div class="minds-bg-overlay" hidden=""></div>
                                    </m-post-menu> -->
                                </div>
                                <!---->
                            </minds-activity>

                            @endforeach
                            

                        @else

                           Viết một status đi :3

  @endif
</div>

<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
  <span class="w3-button w3-large w3-black w3-display-topright" title="Close Modal Image"><i class="fa fa-remove"></i></span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-padding-64 w3-opacity w3-hover-opacity-off">
  <a href="#home" class="w3-button"><i class="fa fa-arrow-up"></i></a>
</footer>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>
 @if ($user->username==Auth::user()->username)
document.addEventListener('DOMContentLoaded', function() {
  $("#edit-intro").hide();
}, false);
function edit(){
  $("#edit-intro").show("slow");
    return false;
  }
  function back(){
    $("#edit-intro").hide();
    return false;
  }
  $("#first").keydown(function() {
    if ($(this).val().length>480) {
      $("#first").css("border-color","red");
      $("#first").css("border-width:","2.5px");
    }
    else {
      $("#first").css("border-color","#ccc");
      $("#first").css("border-width:","1px");
    }
});
  function validateForm(){
    if ($("#first").val().length > 480){
    $("#first").css("border-color","red");
    $("#first").css("border-width:","2px");
    return false;
    }
    else {
      return true;
    }
  }
</script>
@endif
<script>
// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

// Change style of navbar on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
    var navbar = document.getElementById("myNavbar");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        navbar.className = "w3-bar" + " w3-card" + " w3-animate-top" + " w3-white";
    } else {
        navbar.className = navbar.className.replace(" w3-card w3-animate-top w3-white", "");
    }
}

// Used to toggle the menu on small screens when clicking on the menu button
function toggleFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
   
@stop
