{{-- Customer Name: {{$c_name}}<br>
Product Name: {{$p_name}}<br>
Product Quantity: {{$p_quantity}}<br>
Delivery address: {{$c_address}}<br>

<h4>Your product have been delivered.<h4> --}}


<center>
    <h3>Hi! {{$c_name}}</h3>
<h4>Your product have been delivered.!</h4>

<table border="2px" style="width: 90%; border-collapse: collapse;">
    <tr>
        <th>Customer Name</th>
        <th>Delivery address</th>
    </tr>
    <tr>
        <th>{{$c_name}}</th>
        <th>{{$c_address}}</th>
    </tr>
</table>
<br> <br>

        <table border="2px" style="width: 90%; border-collapse: collapse;">
            <tr>
                <th colspan="8">-- Delivery Details --</th>
            </tr>
            <tr>
                <td colspan="8" style="text-align: center;"><b>Delivery Date:</b> Within 3-5 Days | <b>DeliveryMan:</b> <a href="#">{{$d_id}}</a></td>
            </tr>
        </table>

        <h4>Thank You! <br>- Grocery OS</h4>
</center>