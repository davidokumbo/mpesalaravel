@extends('master')
@section('content')
    
<table>
   <tr>
    <th>ID</th>
    <th>country</th>
    <th>city</th>
    <th>address_1</th>
    <th>reason_for_recall</th>
    <th>address_2</th>
    <th>product_quantity</th>
    <th>code_info</th>
    <th>center_classification_date</th>
   </tr>
</div>
   @foreach($data as $specificdata)
   <tr>
    <td>{{$specificdata->id}}</td>
    <td>{{$specificdata->country}}</td>
    <td>{{$specificdata->city}}</td>
    <td>{{$specificdata->address_1}}</td>
    <td>{{$specificdata->reason_for_recall}}</td>
    <td>{{$specificdata->address_2}}</td>
    <td>{{$specificdata->product_quantity}}</td>
    <td>{{$specificdata->code_info}}</td>
    <td>{{$specificdata->center_classification_date}}</td>
   </tr>
@endforeach
</table>
@endsection

<style>
    .theading{
        position:sticky;
        top:0;
        float:none;
        background-color: blue;
    }
</style>
