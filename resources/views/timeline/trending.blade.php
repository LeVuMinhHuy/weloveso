@extends('templates.homepage')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
   .icon{
   font-size:18px!important;
   }
   .w3-ul a {
   text-decoration: none!important;
   }
   #color{
   color:white!important;
   }
</style>
@section('content')
<m-body class="mdl-color--grey-100" style="background-color:red;">

  <div class="mdl-grid m-newsfeed">
    <div class="mdl-cell m-newsfeed--sidebar">
        <minds-card-user class="mdl-card m-border ng-star-inserted" style="margin-bottom:16px;">
            <div class="m-card--user--banner">
              <div class="m-card--user--banner--img"><img src="{{Auth::user()->getCoverUrl() }}"></div>                <div class="minds-banner-overlay"></div>
            </div>
            <a class="mdl-card__supporting-text minds-usercard-block" href="{{route('profile.index', ['username' => Auth::user()->username])}}">
                <div class="avatar"><img src="{{Auth::user()->getAvatarUrl() }}"></div>
            </a>
          </minds-card-user>

          <div class="mdl-grid m-newsfeed">

              <form class="mdl-cell--12-col" id="tag" action="{{ route('home') }}" method="GET">
              <ul class="w3-ul w3-hoverable" >

                  <a href="{{ route('homeAll') }}"><li class=" w3-light-white  w3-hover-white" id="All" >All<i class="fas fa-globe pull-right icon"></i></li></a>
                  <a href="{{ route('trending') }}"><li class=" w3-light-white  w3-hover-white" id="Trending">Trending<i class="fab fa-hotjar pull-right icon"></i></li></a>
                  <a onclick="return getStatus(this);"><li class=" w3-light-white w3-hover-white" id="vat">Ăn Vặt<i class="fas fa-ice-cream pull-right icon"></i></li></a>
                  <a onclick="return getStatus(this);"><li class=" w3-light-white w3-hover-white" id="sang">Ăn Sáng<i class="fas fa-hamburger pull-right icon"></i></li></a>
                  <a onclick="return getStatus(this);"><li class=" w3-light-white w3-hover-white" id="nha">Ăn Nhà<i class="fas fa-home pull-right icon"></i></li></a>
                  <a onclick="return getStatus(this);"><li class=" w3-light-white w3-hover-white" id="ngon">Ăn Ngon<i class="fas fa-utensils pull-right icon"></i></li></a>
                  <a onclick="return getStatus(this);"><li class=" w3-light-white w3-hover-white" id="nhau">Ăn Nhậu<i class="fas fa-beer pull-right icon"></i></li></a>
              </ul>
              <input name="value" id="value" hidden>
              </form>

          </div>
    </div>


                <div class="mdl-cell mdl-cell--8-col m-newsfeed--feed">
                        <minds-newsfeed-poster>
                            <!---->
                            <div class="mdl-card m-border post ng-star-inserted">
                                <div class="mdl-card__supporting-text">
                                    <div class="minds-avatar">
                                        <a href="{{route('profile.index', ['username' => Auth::user()->username])}}"><img class="m-border" src="{{Auth::user()->getAvatarUrl() }}"></a>
                                    </div>
                                    <form class="ng-untouched ng-pristine ng-valid" action="{{ route('status.post') }}" method="post"  enctype="multipart/form-data">
                                        <div class="{{ $errors->has('status') ? ' has-error' : ''}}">
                                            <textarea class="mdl-textfield__input ng-untouched ng-pristine ng-valid" name="status" placeholder="Chia sẻ của {{Auth::user()->getFirstNameOrUsername() }} ...." type="text" style="height: 80px;"></textarea>

                                        @if ($errors->has('status'))
                                            <span class="help-block"> {{ $errors->first('status') }}</span>
                                        @endif
                                        </div>

                                        <div class="mdl-card__actions">
                                            <div class="attachment-button"><i class="material-icons">image</i>
                                                <input id="post_image" name="post_image" type="file">
                                            </div>
                                            <select class="btn btn-small" name="hashtag" id="hashtag" style="border: 1px solid #c5c3c3;">
                                                <option selected disabled>Hashtag</option>
                                                <option>Ăn Vặt</option>
                                                <option>Ăn Sáng</option>
                                                <option>Ăn Nhà</option>
                                            </select>

                                            <a class="m-btn m-btn--slim m-btn m-btn--with-icon" href="#" style="text-decoration:none;">
                                                <span>Public</span>
                                                <i class="material-icons ng-star-inserted" m-tooltip--anchor="">people</i>
                                            </a>

                                            <button class="m-btn m-btn--slim m-btn m-btn--with-icon" type="submit">
                                                <span>Đăng</span>
                                                <i class="material-icons">send</i>
                                            </button>

                                        </div>

                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </form>
                                </div>
                                <!---->
                                <!---->
                                <!---->
                            </div>
                        </minds-newsfeed-poster>



                        <div class="minds-list">

                                <m-newsfeed--boost-rotator interval="4" class="ng-star-inserted">
                                    <div class="m-boost-rotator-tools">
                                        <div class="m-layout--spacer"></div>
                                        <!---->

                                        <ul class="m-boost-rotator-tabs ng-star-inserted">
                                            <li ><i class="material-icons mdl-color-text--blue-grey-400">chevron_left</i></li>
                                            <li ><i class="material-icons mdl-color-text--blue-grey-400">chevron_right</i></li>
                                        </ul>
                                    </div>
                                </m-newsfeed--boost-rotator>
            @if ($statuses->count())
              @foreach ($statuses as $status)
                @if ($status->likes->count() > 2)
            <minds-activity class="mdl-card m-border item ng-star-inserted">
               <div class="mdl-card__supporting-text mdl-color-text--grey-600 m-owner-block ng-star-inserted">
                  <div class="avatar" >
                     <a href="{{route('profile.index', ['username' => $status->user->username])}}"><img class="mdl-shadow--2dp" src="{{ $status->user->getAvatarUrl() }}"></a>
                  </div>
                  <div class="body">
                     <a href="{{route('profile.index', ['username' => $status->user->username])}}"><strong> {{ $status->user->getNameOrUsername() }} </strong>
                     </a>
                     <a class="permalink ng-star-inserted" href="">
                        <span>{{ $status->created_at->diffForHumans() }}</span><!----><!---->
                     </a>
                  </div>
               </div>
               <div class="mdl-card__supporting-text m-mature-message ng-star-inserted" m-read-more="">
                  <span class="m-mature-message-content">
                     {{ $status->body }}
                     <div class="text-center">
                        @if(true)
                        <img  src="{{$status->image}}" style="max-width: 50%;">
                        @endif
                     </div>
                  </span>
                  @if ($status->user->id !== Auth::user()->id)
                  {{ $status->likes->count() }} <a href = "{{route('status.like', ['statusId' => $status->id])}}"><i class="fas fa-pizza-slice"></i></a>
                  @endif
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
                     <div class="m-activity--metrics-metric">
                        <i class="fas fa-pizza-slice"></i>
                        <!----><span class="ng-star-inserted">{{ $status->likes->count() }} </span>
                     </div>
                     <div class="m-activity--metrics-metric"><i class="material-icons">remove_red_eye</i><span>?</span></div>
                  </div>
               </div>
               <minds-comments>
                  @foreach ($status->replies as $reply)
                  <div class="media">
                     <div class="m-owner-block">
                        <div class="avatar" >
                           <a href="{{ route('profile.index', ['username' => $reply->user->username]) }}"><img class="mdl-shadow--2dp" src="{{ $reply->user->getAvatarUrl() }}"></a>
                        </div>
                     </div>
                     <!--
                        <a class="pull-left" href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
                            <img class="media-object" alt="{{ $reply->user->getNameOrUsername() }}" src="{{ $reply->user->getAvatarUrl() }}">
                        </a> -->
                     <div class="media-body">
                        <p class="media-heading"><a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></p>
                        <p>{{ $reply->body }}</p>
                     </div>
                  </div>
                  @endforeach
                  <!-- <div class="m-comment m-comment--poster minds-block ng-star-inserted">
                     <div class="minds-avatar">
                         <a href="{{route('profile.index', ['username' => $status->user->username])}}"><img class="mdl-shadow--2dp" src="{{ $status->user->getAvatarUrl() }}"></a>
                     </div>
                     </div> -->
                  <form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
                     <div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error': '' }}">
                        <textarea name = "reply-{{ $status->id }}" class="form-control" rows="2"></textarea>
                        @if ($errors->has("reply-{$status->id}"))
                        <span class="help-block">{{ $errors->first("reply-{$status->id}" )}}</span>
                        @endif
                     </div>
                     <input type="submit" class="m-btn" value="Nhập">
                     <input type="hidden" name="_token" value="{{ Session::token() }}">
                  </form>
                  <!-- <div class="m-comments-composer">
                     <form class="" action="{{ route('status.reply', ['statusId' => $status->id])}}" method="post">
                         <minds-textarea name="reply-[{$status->id}]">
                         </minds-textarea>
                         <input type="submit" class="m-btn" value="Nhập">
                         <input type="hidden" name="_token" value="{{ Session::token() }}">
                     </form>
                     </div> -->
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
                  @if($status->hashtag)
                  <span class="label label-info pull-left " style="color:white;">{{$status->hashtag}}</span>
                  @endif
                  <i class="material-icons">public</i>
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
            @endif
            @endforeach
            <infinite-scroll>
               <!---->
               <div class="m-infinite-scroll-manual mdl-color--blue-grey-200 mdl-color-text--blue-grey-500 ng-star-inserted" data-vivaldi-spatnav-clickable="1">
                  <!---->Xem thêm
               </div>
               <!---->
            </infinite-scroll>
            @else
            Chưa có tin nào trên bảng tin của bạn. Hãy mau chóng kết bạn thật nhiều!
            @endif
         </div>
      </div>
   </div>
</m-body>
<script
   src="https://code.jquery.com/jquery-3.4.1.min.js"
   integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
   crossorigin="anonymous"></script>
<script>
   function getStatus(ele){
       console.log();
       $("#value").val($(ele)[0].text);
       console.log( $("#value").val());
       document.getElementById('tag').submit();
       return false;
   }
</script>
@stop
