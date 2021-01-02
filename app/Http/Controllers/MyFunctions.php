<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyFunctions extends Controller
{
    public static function work_days_to_string($work_days)
    {
        //$lang = \App::getlocale();

        $last_from = -1;
        $last_to = -1;
        $last_day = -1;
        //$days = ['Пн','Вт','Ср','Чт','Пт','Сб','Вс'];
        $days_eng = ['Mo','Tu','We','Th','Fr','Sa','Su'];

        $work_days.='|99999-99999';
        $dd = explode('|',$work_days);

        $graph = [];
        for ($i=0;$i<=7;$i++)
        {
            $dayt = explode('-',$dd[$i]);
            $from = $dayt[0];
            $to = $dayt[1];

            if (($last_from != $from) || ($last_to != $to))
            {
                if ($last_day==-1)
                {
                    $last_day=0;
                    $last_from=$from;
                    $last_to=$to;
                } else
                {
                    $day_num = $i-1;

                    if ($last_from==0 && $last_to==0)
                    {
                        $tm = ': '.__('Day off');
                        /*
                        if ($lang=="ua")
                        {
                            $tm = ': Вихідний';
                        } else
                        {
                            $tm = ': Day off';
                        }
                        */
                    } else
                    {
                        if ($last_from=='00:00' && $last_to=='23:59')
                        {
                            $tm = ': '.__('Round the clock');
                            /*
                            if ($lang=="ua")
                            {
                                $tm = ': Цілодобово';
                            } else
                            {
                                $tm = ': Round the clock';
                            }
                            */
                        } else 
                        {
                            $tm = ': '.$last_from.'-'.$last_to;
                        }
                    }

                    if ($last_day==$day_num)
                    {
                        $graph[] = __($days_eng[$last_day]).$tm;

                        /*
                        if ($lang=="ua")
                        {
                            $graph[] = $days[$last_day].$tm;
                        } else
                        {
                            $graph[] = $days_eng[$last_day].$tm;
                        }
                        */
                    }
                    else
                    {
                        $graph[]=__($days_eng[$last_day]) . '-' . __($days_eng[$day_num]).$tm;
                        /*
                        if ($lang=="ua")
                        {
                            $graph[]=$days[$last_day] . '-' . $days[$day_num].$tm;
                        } else
                        {
                            $graph[]=$days_eng[$last_day] . '-' . $days_eng[$day_num].$tm;
                        }
                        */
                    }

                    $last_day = $i;
                    $last_from = $from;
                    $last_to = $to;
                }
            }
        }

        return $graph;
    } 

    /*
        Делает из запроса строку рабочими днями для записи в БД
    */
    public static function work_days_from_request(Request $request)
    {
        $work_days = '';

        for ($i=0;$i<7;$i++)
        {
            $from = $request->input('from_d'.$i,'0');
            if (!$from) $from = '0';
            $to = $request->input('to_d'.$i,'0');
            if (!$to) $to = '0';

            $day = $from.'-'.$to;

            if ($work_days=='') $work_days=$day; else $work_days.='|'.$day;
        }

        return $work_days;
    }

    public static function get_phones_from_line($data)
    {
        return explode(";",$data);
    }
}
