<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Custom styles for this template-->
    <style>
        .container{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .left-column{
            width: 70%;
        }

        .right-column{
            width:30%;
        }
    </style>
</head>
<body>
     <div class="container">
         <div class="left-column">
            {{-- Hindsight Logo --}}

            <h3>Mileage Log</h3>
            <table>
                <thead>
                    <tr>
                        <th width="25%">Date</th>
                        <th width="25%">From</th>
                        <th width="25%">To</th>
                        <th width="25%">Miles</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Foreach mileage days --}}
                    {{-- 7 rows in total --}}
                    {{-- Including 3 totals --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
         </div>
         <div class="right-column">
            <h2>Expense Claim Form</h2>
            <div class="date">
                {{-- Date gets enetered here --}}
            </div>

            <table>
                <thead>
                    <tr>
                        <th colspan="2">Non-Receipted Claims</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>5 Hour Shift Allowance (£5)</td>
                        <td>{{-- Value --}}</td>
                    </tr>
                    <tr>
                        <td>10 Hour Shift Allowance (£10)</td>
                        <td>{{-- Value --}}</td>
                    </tr>
                    <tr>
                        <td>+15 Hour Shift Allowance (£25)</td>
                        <td>{{-- Value --}}</td>
                    </tr>
                </tbody>
            </table>
         </div>
     </div>
</body>
</html>
