<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: red;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: red;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <!-- {{-- <img src="" alt="" width="150"/> --}} -->
          <h2 style="color: red; font-size: 26px;"><strong>Ernzotech</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               Ernzotech Head Office
               Email:info@ernzotech.com <br>
               Phone: +2348119772009 <br>
               Address Lagos, Nigeria <br>

            </pre>
        </td>
    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Name:</strong> Name <br>
           <strong>Email:</strong> Email <br>
           <strong>Phone:</strong> Phone <br>

           <strong>Address:</strong> Address <br>
           <strong>Post Code:</strong> Post Code
         </p>
        </td>
        <td>
          <p class="font">
            <h3><span style="color: red;">Invoice:</span> #Invoice</h3>
            Order Date: Order Date <br>
             Delivery Date: Delivery Date <br>
            Payment Type : Payment Type </span>
         </p>
        </td>
    </tr>
  </table>
  <br/>
<h3>Products</h3>


  <table width="100%">
    <thead style="background-color: red; color:#FFFFFF;">
      <tr class="font">
        <th>S/N</th>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>


      <tr class="font">
        <td>1</td>
        <td align="center">
            <img src="{{public_path($product->product_image)}}" height="60px;" width="60px;" alt="">
        </td>
        <td align="center">{{$product->product_name}}</td>
        <td align="center">{{$product->category}}</td>
        <td align="center">{{$product->price}}</td>
      </tr>

    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><span style="color: red;">Subtotal:</span> Subtotal tk</h2>
            <h2><span style="color: red;">Total:</span> Total tk</h2>
            {{-- <h2><span style="color: red;">Full Payment PAID</h2> --}}
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <p>Thanks For Buying Products..!!</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>
