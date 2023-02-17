<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software</title>
    <style>
        body {
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }

        .brand-section {
            background-color: #0d1033;
            padding: 10px 40px;
        }

        .logo {
            width: 50%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .text-white {
            color: #fff;
        }

        .company-details {
            float: center;
            text-align: center;
        }

        .body-section {
            padding: 16px;
            border: 1px solid gray;
        }

        .heading {
            font-size: 20px;
            margin-bottom: 08px;
        }

        .sub-heading {
            color: #262626;
            margin-bottom: 05px;
        }

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            border: 1px solid #111;
            background-color: #f2f2f2;
        }

        table td {
            vertical-align: middle !important;
            text-align: center;
        }

        table th,
        table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }

        .table-bordered {
            box-shadow: 0px 0px 5px 0.5px gray;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .text-right {
            text-align: end;
        }

        .w-20 {
            width: 20%;
        }

        .float-right {
            float: right;
        }
    </style>
</head>


<!-- HTML !-->





</html>
<script>
    window.onload = function(e) {

        getDate();

    }




    function getDate() {
        var todaydate = new Date();
        var day = todaydate.getDate();

        var month = todaydate.getMonth() + 1;
        var year = todaydate.getFullYear();

        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }

        var datestring = year + "-" + month + "-" + day

        document.getElementById("startDate").value = datestring;
        document.getElementById("endDate").value = datestring;
    }
    $(document).ready(function() {
        $('.printme').printPage();
    });
</script>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Tax Invoice</title>
    <link rel="shortcut icon" type="image/png" href="./favicon.png" />
    <style>
        * {
            box-sizing: border-box;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            word-break: break-all;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
        }

        pre,
        p {
            /* width: 99%; */
            /* overflow: auto; */
            /* bpicklist: 1px solid #aaa; */
            padding: 0;
            margin: 0;
        }

        table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
        }

        .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
        }

        td,
        th {
            text-align: left;
            padding: 8px 6px;
        }

        .table-b td,
        .table-b th {
            border: 1px solid #ddd;
        }

        th {
            /* background-color: #ddd; */
        }

        .hm-p td,
        .hm-p th {
            padding: 3px 0px;
        }

        .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px;
            /* height of container */
            overflow: hidden;
        }

        .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
        }

        .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
        }

        .invoice-items {
            font-size: 14px;
            border-top: 1px dashed #ddd;
        }

        .invoice-items td {
            padding: 14px 0;

        }

        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
</head>

<body>
    <section class="main-pd-wrapper" style="width: 950px; margin: auto; margin-top:50px;">
        <div style="
                  text-align: center;
                  margin: auto;
                  line-height: 1.5;
                  font-size: 14px;
                  color: #4a4a4a;
                ">

            <p style="font-weight: bold; color: #000; margin-top: 15px; font-size: 38px;">
                @foreach($Invoice as $item)
                {{$item->company_name}} Private Limited.
            </p>
            <p style=" font-weight:bold;">
                Address : {{$item->company_address}}
            </p>
            <p>
                <b>Contact Number:</b> {{$item->company_contactnumber}}
            </p>

            <p>
                <b>Email Address :</b> {{$item->company_email}}
            </p>
            @endforeach
            <hr style="border: 1px dashed rgb(131, 131, 131); margin: 25px auto">
            <div class="col-sm-3">
                <input type="date" style="float:left;" id="startDate" class="form-control" name="from" value="2022-09-26" disabled />
            </div>
        </div>
        <div class="body-section">
            <h3 class="heading">Service Bill </h3>
            <br>


            <table class="table table-bordered" id="mytable">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Total Amount</th>

                        <th>Discount</th>
                        <th>All Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    </thead>
                <tbody>
                    @if(!empty($serviceBillAmount))
                    <?php $i = 0;
                    $amounttotal = 0;
                    $totaldiscount = 0;
                    $alltotalamount = 0;
                    ?>
                    @foreach($serviceBillAmount as $item)
                    <?php $i++;
                    $amounttotal += $item->totalamount;
                    $totaldiscount += $item->discount;
                    $alltotalamount += $item->alltotalamount;
                    ?>
                    <tr>
                        <td>{{ $item ->id }} </td>
                        <td>{{ $item ->billDate }} </td>
                        <td>{{ $item ->customer_name }} </td>
                        <td>{{ $item ->totalamount  }}</td>

                        <td>{{ $item ->discount }}</td>
                        <td>{{ $item ->alltotalamount }} </td>

                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <th>Total</th>
                        <td>{{ $amounttotal }}</td>
                        <td>{{ $totaldiscount }} </td>
                        <td>{{ $alltotalamount }} </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <br>
            
        </div>

        <table style="width: 100%;
              background: #fcbd024f;
              border-radius: 4px;">


        </table>

        <table style="width: 100%;
              margin-top: 15px;
              border: 1px dashed #00cd00;
              border-radius: 3px;">
            <thead>

                <button id="printPageButton" style="height:30px;width:130px;" onclick="window.print()">Print This Page</button>
            </thead>

        </table>

    </section>
</body>

</html>