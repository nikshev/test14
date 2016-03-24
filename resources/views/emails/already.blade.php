<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/24/16
 * Time: 4:41 PM
 */
$email=\App\Patients::GetPatientEmailById($patient_id);
?>
{!! Html::script('assets/js/jquery-1.12.0.min.js') !!}
{!! Html::style('assets/css/uikit.min.css') !!}
{!! Html::script('assets/js/uikit.min.js') !!}
{!! Html::style('assets/css/dashboard.css') !!}
{!! Html::script('assets/js/dashboard.js') !!}


<h1>Mail sent successfully to {{$email}}!!!.</h1><a href="#" onclick="self.close()">Close this window</a>