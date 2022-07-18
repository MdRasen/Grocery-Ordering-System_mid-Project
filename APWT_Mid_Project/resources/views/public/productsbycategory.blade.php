@extends('layouts.main')
@section('title')
    Products By Category
@endsection
@section('content')

    <h1 align="center">Online Groceries Ordering System</h1>

    <div class="product-section">
        <center>
    
            <table style="width: 40%;">
                <h3>-- Products By Category --</h3>
                
                @foreach ($products as $item) 
                <tr> 
                    <th>
                        <center>
                            <img src="{{asset('storage/product_images')}}/{{$item->thumbnail}}" alt="Product Image" height="120px" width="120px">
                            <a href="{{route('public.viewproduct', ['id'=>$item->id])}}"><h3>{{$item->name}}</h3></a>
                            <textarea style="width: 75%" disabled>{{$item->description}}</textarea>
                            <h4>Price: {{$item->price}} Taka.</h4>
                            <form action="{{route('customer.caddcart');}}" method="POST">
                                {{@csrf_field()}}
                            <input type="hidden" name="p_id" id="p_id" value="{{$item->id}}"> <br>

                            @if(session()->get('user_type')=='Customer')
                            <label for="quantity" style="width: 50%">Quantity: </label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" style="width: 50%"> <br> <br>
                            @error('quantity')
                                    {{$message}} <br>
                                    @enderror
                            <input type="submit" name="caddcart" value="Add To Cart" style="width: 78%;">
                            
                            @elseif(!session()->has('user_type'))
                            <label for="quantity" style="width: 50%">Quantity: </label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" style="width: 50%"> <br> <br>
                            @error('quantity')
                                    {{$message}} <br>
                                    @enderror
                            <input type="submit" name="caddcart" value="Add To Cart" style="width: 78%;">
                    
                            @endif
                            
                            </form>
                        </center>
                    </th>
                </tr>
                @endforeach
    
            </table>
    
        </center>
    </div>

@endsection