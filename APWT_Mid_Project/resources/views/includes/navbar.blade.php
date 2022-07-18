<header>
@if(session()->has('id'))
<div class="top-section">
        <table style="width: 100%;">
            <tr>
                <td style="width: 25%; padding: 10px;">
                    <h2><a href="{{route('public.products');}}">Grocery OS</a></h2>
                </td>
                {{-- @if(session()->get('user_type')=='Customer')
                <td style="width: 25%; padding-top:18px;">
                    <form action="{{route('public.searchproduct')}}" method="POST">
                        {{@csrf_field()}}
                        <input type="search" name="search_name" id="search_name" placeholder="Search here">
                        @error('search_name')
                                    {{$message}}
                                    @enderror
                        <input type="submit" name="search" value="Search">
                    </form>
                </td>
                @endif --}}
                <td style="width: 50%;" align="right">
                    <span style="font-size: 18px">Welcome! <span>{{Session::get('user_type')}}, <b>
                        
                    @if(session()->get('user_type')=='Vendor')
                        <a href="{{route('vendor.profile');}}" style="font-size: 18px">{{Session::get('username')}} </a></b></span></span>
                    <span style="padding-left: 25px;">
                        <a href="{{route('vendor.dashboard');}}" style="font-size: 18px">Home</a> |
                    @elseif(session()->get('user_type')=='Customer')
                        <a href="{{route('customer.cprofileinfo');}}" style="font-size: 18px">{{Session::get('username')}} </a></b></span></span>
                    <span style="padding-left: 25px;">
                        <a href="{{route('customer.cdashboard');}}" style="font-size: 18px">Home</a> |
                    @elseif(session()->get('user_type')=='Admin')
                        <a href="{{route('admin.aprofile');}}" style="font-size: 18px">{{Session::get('username')}} </a></b></span></span>
                    <span style="padding-left: 25px;">
                        <a href="{{route('public.products');}}" style="font-size: 18px">Home</a> |
                        <a href="{{route('admin.aprofile');}}" style="font-size: 18px">Profile</a> |
                    @endif
                        <!-- <a href="#" style="font-size: 18px">My Account</a> | -->
                        <a href="{{route('public.logout');}}" style="font-size: 18px">Logout</a>
                    </span>
                </td>
            </tr>
        </table>
    </div>
    @if(session()->get('user_type')=='Vendor')
        <div class="middle-section">
            <center>
                <table>
                    <tr>
                        <td>
                            <a href="{{route('vendor.dashboard');}}" style="font-size: 20px;">Products</a> |
                            <a href="{{route('vendor.profile');}}" style="font-size: 20px;">Manage My Account</a> |
                            <a href="{{route('vendor.allcoupons');}}" style="font-size: 20px;">Coupons</a> |
                            <a href="{{route('vendor.orders');}}" style="font-size: 20px;">Orders</a> |
                            <a href="{{route('vendor.reviews');}}" style="font-size: 20px;">Reviews</a> |
                            <a href="{{route('vendor.notices');}}" style="font-size: 20px;">Notices</a>
                        </td>
                    </tr>
                </table>
            </center>
        </div>
        @if(session()->get('product_navbar')=='yes')
        <div class="lower-middle-section">
            <center>
                <table>
                    <tr>
                        <td>
                            <a href="{{route('vendor.addproduct');}}" style="font-size: 20px;">Add Products</a> |
                            <a href="{{route('vendor.dashboard');}}" style="font-size: 20px;">All products</a>
                        </td>
                    </tr>
                </table>
            </center>
        </div>
        </div>
        @elseif(session()->has('coupon_navbar'))
        <div class="lower-middle-section">
            <center>
                <table>
                    <tr>
                        <td>
                            <a href="{{route('vendor.createcoupon');}}" style="font-size: 20px;">Create Coupon</a> |
                            <a href="{{route('vendor.allcoupons');}}" style="font-size: 20px;">All Coupon</a>
                        </td>
                    </tr>
                </table>
            </center>
        </div>
        @endif
    @elseif(session()->get('user_type')=='Customer')
    <div class="middle-section">
        <center>
            <table>
                <tr>
                    <td>
                        <a href="{{route('customer.cprofile');}}" style="font-size: 20px;">Manage Account</a> |
                        <a href="{{route('customer.ccart')}}" style="font-size: 20px;">Cart</a> |
                        <a href="{{route('customer.cvieworder')}}" style="font-size: 20px;">Orders</a> |
                        <a href="{{route('customer.cProductReview')}}" style="font-size: 20px;">Reviews</a> |
                        <a href="{{route('customer.Coupons')}}" style="font-size: 20px;">Coupons</a> |
                            <a href="{{route('customer.notices');}}" style="font-size: 20px;">Notices</a>
                    </td>
                </tr>
            </table>
        </center>
    </div>
    @elseif(session()->get('user_type')=='Admin')
    <div class="middle-section">
        <center>
            <table>
                <tr>
                    <td>
                        <a href="{{route('admin.aviewvendor')}}" style="font-size: 20px;">Users</a> |
                        <a href="{{route('admin.aaprovedeliveryman')}}" style="font-size: 20px;">Approve</a> |
                        <a href="{{route('admin.aproducts')}}" style="font-size: 20px;">Products</a> |
                        <a href="{{route('admin.acoupons')}}" style="font-size: 20px;">Coupons</a> |
                        <a href="{{route('admin.deliveredorders')}}" style="font-size: 20px;">Orders</a> |
                        <a href="{{route('admin.asendnotice')}}" style="font-size: 20px;">Notice</a>
                    </td>
                </tr>
            </table>
        </center>
    </div>
    @endif
@else 
    <div class="top-section">
        <table style="width: 100%;">
            <tr>
                <td style="width: 65; padding: 10px;">
                    <h2><a href="{{route('public.products')}}">Grocery OS</a></h2>
                </td>
                <td style="width: 35%;" align="right">
                    <a href="{{route('public.products');}}" style="font-size: 18px">Home</a> |
                    <a href="{{route('public.registration')}}" style="font-size: 18px">Registration</a> |
                    <a href="{{route('public.login')}}" style="font-size: 18px">Login</a>
                </td>
            </tr>
        </table>
    </div>
@endif
</header>