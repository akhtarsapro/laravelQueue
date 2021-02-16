<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">



                 <div class="container">
                     <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Convert Currency</button>
                     <div class="modal fade" id="myModal" role="dialog">
                         <div class="modal-dialog">

                             <!-- Modal content-->
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                                     <h4 class="modal-title">Modal Header</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3 form-group">
                                            <label>From</label>
                                           <select class="form-control" id="currFrom">
                                               @forelse($currencies as $currency)
                                               <option value="{{$currency->name}}">{{$currency->name}}</option>
                                               @empty
                                                   <option>No data found</option>
                                               @endforelse
                                           </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Value</label>
                                          <input type="number" class="form-control" id="convertValue">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>To</label>
                                           <select class="form-control" id="currencyTo" >
                                               @forelse($currencies as $currency)
                                                   <option value="{{$currency->name}}">{{$currency->name}}</option>
                                               @empty
                                                   <option>No data found</option>
                                               @endforelse
                                           </select>
                                           </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Check Value</label>
                                            <input type="button" class="form-control btn btn-info" value="Check Value" onclick="checkValue()">
                                        </div>
                                    </div>
                                        <div class="col-md-3 form-group">
                                            <label>Result</label>
                                            <div>
                                            <strong id="result" style="color: burlywood; font-weight: bold  "></strong>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                             </div>

                         </div>
                     </div>

                         <table class="table">
                             <thead>
                             <tr>
                                 <th>Currency</th>
                                 <th>Rate</th>
                                 <th>Base</th>
                             </tr>
                             </thead>
                             <tbody>
                             @forelse($currencies as $currency)
                             <tr>
                                 <td>{{$currency->name}}</td>
                                 <td>{{$currency->rate}}</td>
                                 <td>{{isset($currency->baseCurrency->name)?$currency->baseCurrency->name:''}}</td>
                             </tr>
                                 @empty
                                 <tr>
                                 <td>No data found</td>
                                 <td></td>
                                 <td></td>
                                 </tr>
                                 @endforelse
                             </tbody>
                         </table>

                     {{$currencies->links()}}
                 </div>
            </div>
    <script>
        function checkValue() {
            var cFrom = $('#currFrom').val();
            var cVal =  $('#convertValue').val();
            var cTo =  $('#currencyTo').val();

            $.ajax({
                url: '{{route('checkCurrency')}}',
                type: 'get',
                data: {'cfrom':cFrom,'cval':cVal,'to':cTo},

                success: function (data) {
                    console.log(data.success);
                    if(data.success == '1'){
                        $('#result').html(data.data)
                    }else{
                        $('#result').html('something wrong')
                    }
                },
            });
        }

    </script>
    </body>
</html>
