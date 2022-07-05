<?php
namespace App\Helpers;

use Lang;
use App\Helpers\DropdownUtils;

class ApplicationConstant
{
    const YES_NO = [
        0 => 'no',
        1 => 'yes'
    ];

    const LANGUAGE = [
        'en' => 'en',
        'ja' => 'ja',
        'id' => 'id',
    ];

    const SCHEDULE_CATEGORY = [
        'seminar' => 'seminar',
        'training' => 'training',
        'praying' => 'praying',
        'meeting' => 'meeting',
    ];

    const SCHEDULE_TYPE = [
        'customer' => 'customer',
        'internal' => 'internal'
    ];

    const SCHEDULE_BACKGROUND = [
        'seminar' => '#aca1ff',
        'training' => '#fca4b9',
        'praying' => '#fa9c89',
        'meeting' => '#ff4040',
    ];

    const COUNTRY_LANGUAGE = [
        'JP' => 'ja',
        'ID' => 'id',
        'US' => 'en',
    ];

    public static function getDropdown($constant)
    {
        $return = [];
        $items = constant('self::'.$constant);

        foreach($items as $key => $value) {
            $return[$key] = \Lang::get('application-constant.'.$constant.'.'.$value);
        }

        return $return;
    }

    public static function getLabel($constant, $key)
    {
        $items = constant('self::'.$constant);

        return \Lang::get('application-constant.'.$constant.'.'.$items[$key]);
    }
}
