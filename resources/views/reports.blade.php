<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/24/16
 * Time: 10:35 AM
 */
$patient_name="";
$patient_email="";
 if (isset($patient_id)&&intval($patient_id)>0){
   $patient_name=\App\Patients::GetPatientNameById($patient_id);
   $patient_email=\App\Patients::GetPatientEmailById($patient_id);
 }

?>

<h1 style="color:green">{{\Lang::get('message.Reports')}}</h1>
<h2 style="color:blue">{{\Lang::get('message.Patient')}}:{{$patient_name}}&nbsp;&nbsp;{{\Lang::get('message.Email')}}:&nbsp;{{$patient_email}}</h2>
<table class="uk-table uk-table-striped">
<thead>
<th>
{{\Lang::get('message.Report ID')}}
</th>
<th>
    {{\Lang::get('message.Report Name')}}
</th>
<th>
    {{\Lang::get('message.Report Create Date')}}
</th>
<th>
</th>
<th>
</th>
</thead>
<tbody>
@foreach($data as $data_row)
    <tr>
        <td>{{$data_row->id}}</td>
        <td><a href="#my-preview-{{$data_row->id}}" data-uk-modal>{{$data_row->name}}</a>
            <!-- This is the modal -->
            <div id="my-preview-{{$data_row->id}}" class="uk-modal">
                <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                    <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
                    <?php echo view('report',['data'=>json_decode($data_row->json_report,true),'patient_id'=>$patient_id,'report'=>$data_row->name]); ?>
                </div>
            </div></td>
        <td>{{$data_row->created_at}}</td>
        <td><a href="/pdfreport/?report_id={{$data_row->id}}" target="_blank" >{{\Lang::get('message.Save as pdf')}}</a></td>
        <td><a href="/sendbymail/?report_id={{$data_row->id}}" target="_blank">{{\Lang::get('message.Send by email')}}</a></td>
    </tr>
@endforeach
</tbody>
</table>
