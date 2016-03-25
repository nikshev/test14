<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $table = 'patients';

    /**
     * Check invitation method
     * @param $user_id
     * @return bool
     */
    public static function CheckInvitation($patient_id){
        try {
            if (isset($patient_id) && intval($patient_id)>0) {
                $patient = self::find($patient_id);
                if (isset($patient->user_id)&&intval($patient->user_id)>0) {
                    \Log::error('Patient_user_id=' . self::varDumpToString($patient->user_id));
                    return true;
                }
            }
        } catch (Exception $ex){
            \Log::error('Patients->CheckInvitation Caught exception:' . $ex->getMessage());
        }

        return false;
    }

    /**
     * Get Patient name by id
     * @param $patient_id
     * @return string
     */
    public static function GetPatientNameById($patient_id){
        try {
            if (isset($patient_id) && intval($patient_id)>0) {
                $patient = self::find($patient_id);
                return $patient->name;
            }
        } catch (Exception $ex){
            \Log::error('Patients->GetPatientNameById Caught exception:' . $ex->getMessage());
        }
        return "";
    }

    /**
     * Get patient email by id
     * @param $patient_id
     * @return string
     */
    public static function GetPatientEmailById($patient_id){
        try {
            if (isset($patient_id) && intval($patient_id)>0) {
                $patient = self::find($patient_id);
                return $patient->email;
            }
        } catch (Exception $ex){
            \Log::error('Patients->GetPatientEmailById Caught exception:' . $ex->getMessage());
        }
        return "";
    }

    /**
     * Get Patient Id By UserId
     * @param $user_id
     * @return int
     */
    public static function GetPatientIdByUserId($user_id){
        try {
            if (isset($user_id) && intval($user_id)>0) {
                $patient = self::where('user_id', $user_id)->find();
                if (isset($patient))
                    return $patient[0]->id;
            }
        } catch (Exception $ex){
            \Log::error('Patients->GetPatientIdByUserId Caught exception:' . $ex->getMessage());
        }
        return -1;
    }

    /**
     * Get UserId By Patient Id
     * @param $patient_id
     * @return int
     */
    public static function GetUserIdByPatientId($patient_id){
        try {

            if (isset($patient_id) && intval($patient_id)>0) {
                $patient = self::find($patient_id);
                //\Log::error('Patient=' . self::varDumpToString($patient));
                if (isset($patient))
                    return $patient->user_id;
            }
        } catch (Exception $ex){
            \Log::error('Patients->GetUserIdByPatientId Caught exception:' . $ex->getMessage());
        }
        return -1;
    }

    /**
     * Var dump to string
     * @param $var
     * @return string
     */
    private static function varDumpToString($var) {
        ob_start();
        var_dump($var);
        $result = ob_get_clean();
        return $result;
    }
}
