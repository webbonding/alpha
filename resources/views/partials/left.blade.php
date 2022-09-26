
<div class="col-md-4 col-sm-4 tab_dsh_1">
    <div class="dash-left-menu">
        <ul>
            <li class="{{(in_array(\Request::route()->getName(),['dashboard']))?'active':''}}"><a href="{{route('dashboard')}}"><i class="fa fa-rocket"></i> DASHBOARD</a>
            </li>
            <li lass="{{(in_array(\Request::route()->getName(),['my-profile']))?'active':''}}"><a href="{{route('my-profile')}}"><i class="fa fa-user"></i> MY PROFILE</a>
            </li>
            <li lass="{{(in_array(\Request::route()->getName(),['user-order']))?'active':''}}"><a href="{{route('user-order')}}"><i class="fa fa-key"></i> ORDERS</a>
            </li>
            <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> LOGOUT</a>
            </li>
        </ul>
    </div>
</div>
