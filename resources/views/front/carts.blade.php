@extends('layouts.front')
 @section('content')
<div class="container my-5 py-5">
    <h3 class="text-center py-3">My shopping carts</h3>
    <div class="table-responsive">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item Name</th>
                    <th>Item image</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>
    <div class="d-grid gap-2">
    @guest
        <a href="/login" class="btn btn-primary">Login</a>
    @else
    <form id="paymentForm" class="row" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label for="payment_slip" class="mb-1">payment_slip</label>
            <input type="file" name="payment_slip" id="payment_slip" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="payment_method" class="mt-3">Payment method</label>
            <select name="payment_method" id="payment_method" class="form-select">
                <option value="">Choose payment method</option>
                @foreach ($payments as $payment)
                    <option value="{{$payment->id}}">{{$payment->name}}</option>
                @endforeach
                
            </select>
        </div>
        <div class="mb-3">
            <label for="address">Customer Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <button class="btn btn-success my-3" id="order-now" type="submit">Order Now</button>
    </form>
    @endif
</div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function(){
        // ajax set up link 
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $('#paymentForm').on('submit',function(e){
            e.preventDefault();
            var formData=new FormData(this);
            console.log(formData);
            let itemString=localStorage.getItem('shops');
            formData.append('orderItems',itemString);
            $.ajax({
                type:'POST',
                url:"{{route('order-now')}}",
                data:formData,
                processData:false,
                contentType:false,
                success:function(response){
                    if(response){
                        alert('Order Successful');
                        localStorage.clear('shops');
                        location.href='/';
                    }
                }
            })
        })
  
 
  
})
</script>
@endsection