<?php
/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 7/12/14
 * Time: 1:51 PM
 */

namespace CEMS;


class ApiHelper {

    /**
     * Helper class
     * @param $content
     * @param $start
     * @param $end
     *
     * @return string
     */
    static function getBetween($content, $start, $end)
    {
        $r = explode($start, $content);
        if (isset($r[1])) {
            $r = explode($end, $r[1]);

            return $r[0];
        }

        return '';
    }
} 