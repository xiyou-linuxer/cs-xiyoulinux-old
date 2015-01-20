<aside class="aside-md bg-light dk" id="sidebar">

      <section class="vbox animated fadeInRight">

            <section class="scrollable hover">
		<nav class="nav-primary hidden-xs">

                  <h4 class="font-thin m-l-md m-t hidden-nav-xs">用户列表</h4>
                  <ul class="nav list-group no-bg no-borders auto m-t-n-xxs">

		<{section name=n loop=$user_list}>
                        <li class="list-group-item">


                              <span class="pull-left thumb-xs m-t-xs avatar m-l-xs m-r-sm" >

                                    <img src="<{$user_list[n].avatar}>" alt="..." class="img-circle"> <i class="<{$user_list[n].status}>"></i>

                              </span>

                              <div class="clear">

                                    <div class="hidden-nav-xs">
                                          <a href="profile.php?uid=<{$user_list[n].uid}>"><{$user_list[n].name}></a>
                                    </div>
                                    <div class="visible-nav-xs">
                                          <a href="#">占格</a>
                                    </div>

                                    <small class="text-muted hidden-nav-xs"><{$user_list[n].workplace}></small>
                              </div>
                        </li>
		<{/section}>
                  </ul>
		</nav>
            </section>

      </section>

</aside>
