<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2/11/16
 * Time: 5:44 PM
 */
?>
{!! \Lang::get('messages.Click here to reset your password') !!} : {{ url('password/reset/'.$token) }}
