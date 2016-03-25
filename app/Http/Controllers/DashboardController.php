<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/24/16
 * Time: 10:40 AM
 */
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use Symfony\Component\HttpFoundation\Request;
use Dompdf\Dompdf;

class DashboardController extends BaseController
{

    /**
     * Send invitation for patients
     * @param Request $request
     */
   public function Invitation(Request $request){
       $patient_id=intval($request->input('patient_id'));
       if ($patient_id>0) {
           $user_id = \App\Patients::GetUserIdByPatientId($patient_id);
           if (intval($user_id) > 0) { //User already registered and we must change password
               $user=\App\User::find($user_id);
               $password=uniqid();
               $data["name"] =$user->name;
               $data["email"] =$user->email;
               $data["password"]=$password;
               $user->password=bcrypt($data['password']);
               $data["id"]=$user->id;
               $input["patient_id"]=$patient_id;
               $user->save();
               $sent=\Mail::send('emails.invitation', $data, function($message) use ($input)
               {
                   $message->to(\App\Patients::GetPatientEmailById($input["patient_id"]));
                   $message->subject('New invitation');
                   $message->from('noreply@oranges.guru');
               });
               echo  \Lang::get('message.Invitation sent successfully');
           } else { //Create new user
               $password=uniqid();
               $data["name"] =\App\Patients::GetPatientNameById($patient_id);
               $data["email"] =\App\Patients::GetPatientEmailById($patient_id);
               $data["password"]=$password;
               $user=\App\User::create([
                   'name' => $data['name'],
                   'email' => $data['email'],
                   'password' => bcrypt($data['password']),
               ]);
               $data["id"]=$user->id;
               $patient=\App\Patients::find($patient_id);
               $patient->user_id=$user->id;
               $patient->save();
               $input["patient_id"]=$patient_id;
               $sent=\Mail::send('emails.invitation', $data, function($message) use ($input)
               {
                   $message->to(\App\Patients::GetPatientEmailById($input["patient_id"]));
                   $message->subject('New invitation');
                   $message->from('noreply@oranges.guru');
               });
            echo  \Lang::get('message.Invitation sent successfully');
           }
       }
   }

    /**
     * Return reports
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function Reports(Request $request){
     $patient_id=intval($request->input('patient_id'));
     if ($patient_id>0){
       $data=\App\Reports::GetReportsByPatientId($patient_id);
       return view('reports',['data'=>$data,'patient_id'=>$patient_id]);
     }
   }

    /**
     * Generate PDF report
     * @param Request $request
     */
   public function PDFReport (Request $request){
       $report_id=intval($request->input('report_id'));
       $test=intval($request->input('test'));
       $data=\App\Reports::GetReportByReportId($report_id);
       if (!is_null($data)) {
           $filepath = "/usr/share/nginx/html/test/public/public/tmp/";
           $filename = uniqid();
           //$filename=md5($customer_id.time())."campaign.pdf";

           $html = view('report', ['data' => json_decode($data->json_report, true), 'patient_id' => $data->patient_id, 'report' => $data->name, 'header' => 1]);
           $dompdf = new Dompdf();
           $dompdf->loadHtml($html);
           // (Optional) Setup the paper size and orientation
           $dompdf->setPaper('A4', 'landscape');

           // Render the HTML as PDF
           $dompdf->render();

           if ($test==0){
              // Output the generated PDF to Browser
               $dompdf->stream();
           } else {
               ob_get_clean();
           }

       }
   }

    /**
     * Generate PDF report and send it by mail
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
  public function SendByMail(Request $request){
      $report_id=intval($request->input('report_id'));
      $test=intval($request->input('test'));
      $report=\App\Reports::GetReportByReportId($report_id);
      if (!is_null($report)) {
          $filepath = "/usr/share/nginx/html/test/public/public/tmp/";
          $filename = uniqid() . ".pdf";

          $html = view('report', ['data' => json_decode($report->json_report, true), 'patient_id' => $report->patient_id, 'report' => $report->name, 'header' => 1]);
          $dompdf = new Dompdf();
          $dompdf->loadHtml($html);
          // (Optional) Setup the paper size and orientation
          $dompdf->setPaper('A4', 'landscape');

          // Render the HTML as PDF
          $dompdf->render();

          $pdf = $dompdf->output();
          file_put_contents($filepath.$filename, $pdf);
          $input["patient_id"]=$report->patient_id;
          $input["filename"]=$filepath.$filename;
          $sent=\Mail::send('emails.report', $data=array(), function($message) use ($input)
          {
              $message->to(\App\Patients::GetPatientEmailById($input["patient_id"]));
              $message->subject('Your report');
              $message->from('noreply@oranges.guru');
              $message->attach($input["filename"], array(
                      'as' => 'pdf-report.pdf',
                      'mime' => 'application/pdf')
              );
          });
          if ($test==0) {
              return view('emails.already', ['patient_id' => $report->patient_id]);
          } else
              ob_get_clean();
      } else
          return view('dashboard',['user'=>\Auth::user()]);
  }


}
