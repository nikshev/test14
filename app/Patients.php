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
    public static function CheckInvitation($user_id){
        if (isset($user_id)&&intval($user_id)) {
            $patient=self::where('user_id',$user_id)->find();
            if (isset($patient))
                return true;
        }

        return false;
    }

    /**
     * Get Patient name by id
     * @param $patient_id
     * @return string
     */
    public static function GetPatientNameById($patient_id){
        if (isset($patient_id)&&intval($patient_id)) {
            $patient=self::find($patient_id);
            return $patient->name;
        }
        return "";
    }

    /**
     * Get patient email by id
     * @param $patient_id
     * @return string
     */
    public static function GetPatientEmailById($patient_id){
        if (isset($patient_id)&&intval($patient_id)) {
            $patient=self::find($patient_id);
            return $patient->email;
        }
        return "";
    }

    public static function GetPatientIdByUserId($user_id){
        if (isset($user_id)&&intval($user_id)) {
            $patient=self::where('user_id',$user_id)->find();
            if (isset($patient))
                return $patient[0]->id;
        }

        return -1;
    }
}
