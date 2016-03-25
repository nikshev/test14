<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/22/16
 * Time: 9:41 AM
 */
use App\Patients;
$dashboard_js_version=uniqid();
?>

{!! Html::script('assets/js/jquery-1.12.0.min.js') !!}
{!! Html::style('assets/css/uikit.min.css') !!}
{!! Html::script('assets/js/uikit.min.js') !!}
{!! Html::script('assets/js/spin.min.js') !!}
{!! Html::style('assets/css/dashboard.css') !!}
{!! Html::script('assets/js/dashboard.js?v='.$dashboard_js_version) !!}
{!! Html::script('assets/js/components/accordion.min.js') !!}
{!! Html::script('assets/js/components/form-select.min.js') !!}
{!! Html::script('assets/js/components/datepicker.min.js') !!}
{!! Html::style('assets/css/components/accordion.css') !!}
{!! Html::style('assets/css/components/form-select.css') !!}
{!! Html::style('assets/css/components/datepicker.css') !!}
<head>
    <title>{!! \Lang::get('message.Dashboard title') !!}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="uk-grid">
<div class="uk-width-medium-1-4" style="float:left;">
    <h1>{!! \Lang::get('message.Dashboard title') !!}</h1>
</div>
<div style="float:left; padding-top:2px; margin-left:-223px;">
    <a  href="auth/logout">{!! \Lang::get('auth.Logout') !!}</a>
</div>
@if (intval($user->type)>0)
 <?php $data=Patients::All();?>
 <div class="uk-width-large-2-8 uk-container-center">
    <div  id="patients-search-result">
        <h1 style="color:green">{{\Lang::get('message.Patients')}}</h1>
        <table class="uk-table uk-table-striped">
            <thead>
            <th>
                {{\Lang::get('message.Patient ID')}}
            </th>
            <th>
                {{\Lang::get('message.Patient Name')}}
            </th>
            <th>
                {{\Lang::get('message.Patient Email')}}
            </th>
            <th>
                {{\Lang::get('message.Create Date')}}
            </th>
            <th>
            </th>
            </thead>
            <tbody>
            @foreach($data as $data_row)
               <tr>
                   <td>
                       {{$data_row->id}}
                   </td>
                   <td>
                       {{$data_row->name}}
                   </td>
                   <td>
                       {{$data_row->email}}
                   </td>
                   <td>
                       {{$data_row->created_at}}
                   </td>
                   <td>
                       <a data-patientid="{{$data_row->id}}" class="view-rep" href="#">{{\Lang::get('message.View reports')}}</a>
                   </td>
                   <td>
                       @if (\App\Reports::GetReportsByUserId($user->id))
                         <a data-patientid="{{$data_row->id}}" class="send-inv" href="#">{{\Lang::get('message.Send invitation')}}</a>
                       @else
                           <a data-patientid="{{$data_row->id}}" class="send-inv" href="#">{{\Lang::get('message.Re-send invitation')}}</a>
                       @endif
                   </td>
               </tr>
            @endforeach
            </tbody>
          </table>
    </div>
  </div>
@endif
<div class="uk-width-large-2-8 uk-container-center">
  <div  id="reports-search-result">
    @if (intval($user->type)===0)
     <?php $data=\App\Reports::GetReportsByUserId($user->id); ?>
     <?php $patient_id=\App\Reports::GetPatientIdByUserId($user->id); ?>
     <?php echo view('reports',['data'=>$data,'patient_id'=>$patient_id]); ?>
    @endif
  </div>
</div>
</body>
