<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/24/16
 * Time: 1:46 PM
 */
$patient_name="";
$patient_email="";
if (!isset($report))
    $report="Unknown";
if (isset($patient_id)&&intval($patient_id)>0){
    $patient_name=\App\Patients::GetPatientNameById($patient_id);
    $patient_email=\App\Patients::GetPatientEmailById($patient_id);
}
?>

@if (isset($header))
    <h1 style="color:green">{{$report}}</h1>
    <h2 style="color:blue">{{\Lang::get('message.Patient')}}:{{$patient_name}}&nbsp;&nbsp;{{\Lang::get('message.Email')}}:&nbsp;{{$patient_email}}</h2>
@endif
<table class="uk-table uk-table-striped">
    <thead>
    <tr>
    <th>
        {{\Lang::get('message.Analysis name')}}
    </th>
    <th>
        {{\Lang::get('message.Analysis result')}}
    </th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as  $key => $value)
        <tr>
            <td>{{$key}}</td>
            <td>{{$value}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

