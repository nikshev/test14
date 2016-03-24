<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Patients;
use Mockery\CountValidator\Exception;


class Reports extends Model
{
    protected $table = 'reports';

    /**
     * Get Reports By User Id
     * @param $user_id
     * @return null
     */
    public static function GetReportsByUserId($user_id){
        $reports = null;
        try {
            if (intval($user_id) > 0) {
                $patients = \App\Patients::where('user_id', $user_id)->get();
            } else
                $patients = null;
            if (!is_null($patients)) {
                $patient_id = $patients[0]->id;
                $reports = self::where('patient_id', $patient_id)->get();
            }
        } catch (Exception $ex){
            \Log::error('Reports->GetReportsByUserId Caught exception:' . $ex->getMessage());
        }
       return $reports;
    }

    /**
     * Get Reports By Patient Id
     * @param $patient_id
     * @return null
     */
    public static function GetReportsByPatientId($patient_id){
        $reports=null;
        try {
            if (isset($patient_id)&&intval($patient_id)>0) {
                $reports = self::where('patient_id', $patient_id)->get();
            }
        } catch (Exception $ex){
            \Log::error('Reports->GetReportsByPatientId Caught exception:' . $ex->getMessage());
        }
        return $reports;
    }

    /**
     * Get report by report id
     * @param $report_id
     * @return null
     */
    public static function GetReportByReportId($report_id){
        $report=null;
        try {
            if (isset($report_id)&&intval($report_id)>0) {
                $report = self::find($report_id)->first();
            }
        } catch (Exception $ex){
            \Log::error('Reports->GetReportByReportId Caught exception:' . $ex->getMessage());
        }
        return $report;
    }
}
