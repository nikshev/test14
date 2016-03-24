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
   public function test(){

   }

   public function Invitation(Request $request){

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

   public function PDFReport (Request $request){
       $report_id=intval($request->input('report_id'));
       $data=\App\Reports::GetReportByReportId($report_id);
       if (!is_null($data)) {
           $filepath = env('ROOT_FILE_PATH') . "/public/tmp/";
           $filename = uniqid() . ".pdf";
           //$filename=md5($customer_id.time())."campaign.pdf";
           $html = view('report', ['data' => json_decode($data->json_report, true), 'patient_id' => $data->patient_id, 'report' => $data->name, 'header' => 1]);
           $dompdf = new Dompdf();
           $dompdf->loadHtml($html);
           // (Optional) Setup the paper size and orientation
           $dompdf->setPaper('A4', 'landscape');

           // Render the HTML as PDF
           $dompdf->render();

           // Output the generated PDF to Browser
           $dompdf->stream();
       }
   }

  public function SendByMail(Request $request){
      $report_id=intval($request->input('report_id'));
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
          \Mail::send('emails.report', $data=array(), function($message) use ($input)
          {
              $message->to(\App\Patients::GetPatientEmailById($input["patient_id"]));
              $message->subject('Your report');
              $message->from('noreply@oranges.guru');
              $message->attach($input["filename"], array(
                      'as' => 'pdf-report.zip',
                      'mime' => 'application/pdf')
              );
          });
          return view('emails.already',['patient_id'=>$report->patient_id]);
      } else
          return view('dashboard',['user'=>\Auth::user()]);
  }

}
