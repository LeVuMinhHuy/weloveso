<m-topbar class="m-noshadow mdl-color--white mdl-color-text--grey-600">
    <div class="m-topbar--row">

        <a class="m-topbar--logo" routerlink="/" href="/"><img src=""></a>
        <!---->
        @if (Auth::check()) 
        <m-search--bar>
            <form action="{{route('search.results')}}" role="search">
                <div class="mdl-textfield mdl-js-textfield is-upgraded" data-upgraded=",MaterialTextfield"><i class="material-icons">search</i>
                    <input autocomplete="off" class="mdl-textfield__input ng-untouched ng-pristine ng-valid" id="search" name="query" type="text">
                    <label class="mdl-textfield__label" for="search"></label>
                    <m-search--bar-suggestions>
                        <div class="m-search-bar-suggestions-list ng-star-inserted" hidden="">
                        </div>
                    </m-search--bar-suggestions>
                </div>
            </form>
        </m-search--bar>
        <m-topbar--navigation>
            <nav class="m-topbar--navigation">
                <div><a class="m-topbar--navigation--item" routerlink="{{ route('home') }}" href="{{ route('home') }}" routerlinkactive="m-topbar--navigation--item-active" title="Timeline"><i class="material-icons">restaurant</i><span class="m-topbar--navigation--text">Bảng tin</span></a></div>
                <div><a class="m-topbar--navigation--item" routerlink="{{ route('friend.index', ['username' => Auth::user()->username])}}" routerlinkactive="m-topbar--navigation--item-active" title="Friends" href="{{ route('friend.index', ['username' => Auth::user()->username])}}"><i class="material-icons">people</i><span class="m-topbar--navigation--text">Bạn bè</span></a></div>
                <div><a class="m-topbar--navigation--item" routerlink="{{route('company.locations', ['username' => Auth::user()->username])}}" routerlinkactive="m-topbar--navigation--item-active" title="FindLove" href="{{route('company.locations', ['username' => Auth::user()->username])}}"><i class="material-icons">place</i><span class="m-topbar--navigation--text">Nhìn xem</span></a></div>
                <div><a class="m-topbar--navigation--item" routerlink="" routerlinkactive="m-topbar--navigation--item-active" title="Blogs" href=""><i class="material-icons">subject</i><span class="m-topbar--navigation--text">Blogs</span></a></div>
                <a class="m-topbar--navigation--item" href=""><i class="material-icons">group_work</i><span class="m-topbar--navigation--text"> Nhóm </span></a>
            </nav>
        </m-topbar--navigation>
        <div class="m-layout--spacer"></div>
        <!---->
        <div class="m-topbar--icons ng-star-inserted">
            <!---->
            <a class="m-topbar--navigation--item" href="{{route('profile.index', ['username' => Auth::user()->username])}}">{{ Auth::user()->getNameOrUsername() }}</a>

            <m-notifications--topbar-toggle>
                    <a class="m-notifications--topbar-toggle--icon">
                        <m-tooltip icon="notifications">
                            <div class="m-tooltip">
                                <!----><i class="material-icons ng-star-inserted">notifications</i>
                                <div class="m-tooltip--bubble" hidden=""> Notifications </div>
                            </div>
                        </m-tooltip>
                    </a>
                <!---->
                <!---->
                <m-notifications--flyout hidden="" class="ng-star-inserted">
                    <div class="m-notifications--flyout--wrapper mdl-card mdl-shadow--3dp">
                        <div class="m-notifications--flyout--scrollable-container">
                            <minds-notifications hidden="">
                                <div class="mdl-tabs__tab-bar">
                                    <a class="mdl-tabs__tab is-active" data-vivaldi-spatnav-clickable="1">
                                        <m-tooltip icon="notifications">
                                            <div class="m-tooltip">
                                                <!----><i class="material-icons ng-star-inserted">notifications</i>
                                                <div class="m-tooltip--bubble" hidden="">All</div>
                                            </div>
                                        </m-tooltip><span class="m-full-label">All</span></a>
                                    <a class="mdl-tabs__tab" data-vivaldi-spatnav-clickable="1">
                                        <m-tooltip icon="face">
                                            <div class="m-tooltip">
                                                <!----><i class="material-icons ng-star-inserted">face</i>
                                                <div class="m-tooltip--bubble" hidden="">tags</div>
                                            </div>
                                        </m-tooltip><span class="m-full-label">Tags</span></a>
                                    <a class="mdl-tabs__tab" data-vivaldi-spatnav-clickable="1">
                                        <m-tooltip icon="chat_bubble">
                                            <div class="m-tooltip">
                                                <!----><i class="material-icons ng-star-inserted">chat_bubble</i>
                                                <div class="m-tooltip--bubble" hidden="">Comments</div>
                                            </div>
                                        </m-tooltip><span class="m-full-label">Comments</span></a>
                                    <!---->
                                    <a class="mdl-tabs__tab" data-vivaldi-spatnav-clickable="1">
                                        <m-tooltip icon="people">
                                            <div class="m-tooltip">
                                                <!----><i class="material-icons ng-star-inserted">people</i>
                                                <div class="m-tooltip--bubble" hidden="">Subscriptions</div>
                                            </div>
                                        </m-tooltip><span class="m-full-label">Subscriptions</span></a>
                                    <a class="mdl-tabs__tab" data-vivaldi-spatnav-clickable="1">
                                        <m-tooltip icon="thumbs_up_down">
                                            <div class="m-tooltip">
                                                <!----><i class="material-icons ng-star-inserted">thumbs_up_down</i>
                                                <div class="m-tooltip--bubble" hidden="">Votes</div>
                                            </div>
                                        </m-tooltip><span class="m-full-label">Votes</span></a>
                                    <a class="mdl-tabs__tab" data-vivaldi-spatnav-clickable="1">
                                        <m-tooltip icon="repeat">
                                            <div class="m-tooltip">
                                                <!----><i class="material-icons ng-star-inserted">repeat</i>
                                                <div class="m-tooltip--bubble" hidden="">Reminds</div>
                                            </div>
                                        </m-tooltip><span class="m-full-label">Reminds</span></a>
                                </div>
                                <!---->
                                <div class="mdl-grid notifications-grid" style="max-width:600px">
                                    <div class="mdl-cell mdl-cell--12-col">
                                        <!---->
                                        <!---->
                                    </div>
                                </div>
                            </minds-notifications>
                        </div>
                        <div class="m-notifications--flyout--bottom-container mdl-color--blue-grey-50 mdl-color-text--blue-grey-200"><a data-vivaldi-spatnav-clickable="1" href="/notifications"> View all </a></div>
                    </div>
                </m-notifications--flyout>
            </m-notifications--topbar-toggle>
            <div><a class="m-topbar--navigation--item" routerlink="{{ route('profile.edit') }}" routerlinkactive="m-topbar--navigation--item-active" title="ChangeInfo" href="{{ route('profile.edit') }}"><i class="material-icons">info</i><span class="m-topbar--navigation--text"></span></a></div>
        
        <!---->
        </div>
        <button class="m-btn m-btn--action m-btn--slim m-btn--boost ng-star-inserted">
            <!---->Đăng bài</button>

         <div><a class="m-topbar--navigation--item" routerlink="{{ route('auth.signout') }}" routerlinkactive="m-topbar--navigation--item-active" title="logout" href="{{ route('auth.signout') }}"><i class="fas fa-sign-out-alt"></i><span class="m-topbar--navigation--text"></span></a></div>
    
    @else

        <div><a class="m-btn m-btn--action m-btn--slim m-btn--boost ng-star-inserted" routerlink="{{ route('auth.signin') }}" routerlinkactive="m-topbar--navigation--item-active" title="login" href="{{ route('auth.signin') }}"><span class="m-topbar--navigation--text"></span>Đăng nhập</a></div>

    @endif


    </div>
    <div class="m-topbar--toaster">
        <!---->
        <m-notifications--toaster class="ng-star-inserted">
            <!---->
            <div class="m-notifications--toaster ng-star-inserted">
                <!---->
            </div>
        </m-notifications--toaster>
    </div>
</m-topbar>