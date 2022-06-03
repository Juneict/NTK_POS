<style>
            
  .invoice-pos{
      height: 210mm;
      width: 148.5mm;
      margin: 0 auto;
  }
  .invoice-pos .header{
      min-height: 120px;
  }
  .invoice-pos .header .logo{
     align-content: center;
      left: 250px;
      right: 450px;
  }
  .invoice-pos .header .info{
      font-size: 23px;
      text-align: center;
  }
  .invoice-pos .header .address{
     
      font-size: 12px;
      text-align: center;
  }
  .invoice-pos .content .content-header{
      text-align: center;
  }
  .invoice-pos .content .row{
      width: 100%;
  }
  .invoice-pos .content .row .col-cus-info{
      width: 350px;
      display: block;
      float: left;
     
  }
  .invoice-pos .content .row  .col-invoice-info ul{
      list-style: none;
      text-decoration: none;
      float: left;
  }
  .invoice-pos .content .row .col-cus-info ul{
      list-style: none;
      text-decoration: none;
  }
  .invoice-pos .table .invoice-table{
      width: 148.5mm;
      padding: 20px;
      margin: 10px;
  }
  .invoice-pos .table .invoice-table .table-title{
      border: 1px solid black;
      font-weight: bold;
      font-size: large;
      text-align: left;
  }
  
  .invoice-pos .footer .sign{
      width: 180px;
      padding-top: 120px;
      float: left;
      display: block;
      text-align: center;
  }
  .invoice-pos .note {
      font-size: 12px;
      text-align: center;
  }
</style>

<div class="invoice-pos">
  <div class="header">
      <div class="logo">
          
      </div>
      
      <div class="address">
          <img src="{{ asset('dist/img/adminlogo.png') }}" alt="">
          <h2>Computer Sales & Services</h2>
          <p>အမှတ်(၁၀/၁၁)၊ ပထမထပ်၊ အဆင့်မြင့် သုံးထပ်ဈေး၊လမ်းငါးသွယ်၊စိုးကောမင်းရပ်ကွက်၊မကွေးမြို့။
          <br>  Phone: 09-785433166 (Laptop Service) , 09-43009421  (Desktop &  Printer Service)
          </p>
      </div>
  </div>
  <hr>
  <div class="content">
      <div class="content-header">
          <h3>Sale Voucher</h3>
      </div>
      <div class="row">
          <div class="col-cus-info">
              <ul>
                  <li>Customer : {{$order->customers->customer_name}}</li>
                  <li>Phone : {{$order->customers->phone}} </li>
              </ul>
             
          </div>
          <div class="col-invoice-info">
            
          </div>
      </div>
  </div>
  <div class="table">
      <table class="invoice-table">
          <tr class="table-title" >
              <td class="title"style="border-bottom: 1px solid #ddd;" >No</td>
              <td class="title"style="border-bottom: 1px solid #ddd;">Item Name</td>
              <td class="title"style="border-bottom: 1px solid #ddd;">Qty</td>
              <td class="title" style="border-bottom: 1px solid #ddd;">Price</td>
              <td class="title"style="border-bottom: 1px solid #ddd;">Amount</td>
          </tr>
          
          
            @foreach($orderdetail as $index=>$orderitem)
            <tr class="table-item">
              <td>{{$index+1}}</td>
              <td>{{$orderitem->name}}</td>
              <td>{{$orderitem->quantity}}</td>
              <td>{{$orderitem->price}}</td>
              <td>{{$orderitem->price*$orderitem->quantity}}</td>
            </tr>
            @endforeach
                 
          <tr>
              <td></td>
              <td></td>
              <td></td>
              <td style="border-bottom: 1px solid #ddd;"><strong>Total</strong> </td>
              <td style="border-bottom: 1px solid #ddd;"><strong>{{$totalamount}}</strong> </td>
          </tr>
      </table>
  </div>
  <div class="note">
      
      <p><br> ဝယ်ယူအားပေးမှူကို အထူးကျေးဇူးတင်ပါသည်။</p>
  </div>
  <div class="footer">
      
      <div class="sign">
          <br>
          ----------------<br>
          <span>Customer Sign</span>
      </div>
      <div class="sign">
          <br>
          ----------------<br>
          <span>Authorized Sign</span>
      </div>
      <div class="sign">
          <br>
          ----------------<br>
          <span>Receive Date</span>
      </div>
  </div>
  
</div>
<script>
  window.print();
</script>