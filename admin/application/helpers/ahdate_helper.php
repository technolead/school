<?php

/**
 * Description of common_helper
 *
 * @author anwar
 */
class ahdate {

    public static function get_year($sel='') {
        $opt.="<option value=''>--Year--</option>";
        for ($i = 1900; $i <= 2020; $i++) {
            if ($sel == $i)
                $opt.="<option value='$i' selected='selected'>$i</option>";
            else
                $opt.="<option value='$i'>$i</option>";
        }
        return $opt;
    }

    public static function get_month($sel='') {
       $months = array('01' => 'January', '02' => 'Febrary', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
        $opt.="<option value=''>----Month----</option>";
        foreach ($months as $k => $row) {
            if ($k == $sel) {
                $opt.="<option value='$k' selected='selected'>$row</option>";
            } else {
                $opt.="<option value='$k'>$row</option>";
            }
        }
        return $opt;
    }
    public static function get_day($sel='') {
        $opt.="<option value=''>--Day--</option>";
        for ($i = 1; $i <= 31; $i++) {
            $day=str_pad($i, 2, 0,STR_PAD_LEFT);
            if ($sel == $day)
                $opt.="<option value='$day' selected='selected'>$day</option>";
            else
                $opt.="<option value='$day'>$day</option>";
        }
        return $opt;
    }

}