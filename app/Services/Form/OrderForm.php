<?php

namespace App\Services\Form;

use Illuminate\Http\Request;
use App\Models\FormSetting;
use DateTime;

final class OrderForm
{
    /**
     * フォーム名
     */
    public const FORM_NAME = 'order';

    /**
     * App\Models\FormSetting
     */
    private object $FormSetting;

    /**
     * フォームの設定データ
     */
    private array $setting;

    /**
     * フォーム入力値
     */
    private array $input;

    /**
     * フォームの既定値
     */
    private array $default;

    /**
     * コンストラクタ
     */
    public function __construct(Request $request)
    {
        $this->FormSetting = new FormSetting();

        //フォーム設定
        $form_setting = $this->getFormSetting();
        $this->setting['option_display_count']              = (int)$form_setting['option_display_count'];
        $this->setting['delivery_offset']                   = (int)$form_setting['delivery_offset'];
        $this->setting['prefectures_shift_delivery_offset'] = unserialize($form_setting['prefectures_shift_delivery_offset']);
        $this->setting['shift_delivery_offset_after_3pm']   = $form_setting['shift_delivery_offset_after_3pm']? true: false;
        $this->setting['saturday_delivery_disabled']        = $form_setting['saturday_delivery_disabled']? true: false;
        $this->setting['sunday_delivery_disabled']          = $form_setting['sunday_delivery_disabled']? true: false;

        //フォーム入力値
        $this->input['product_id']    = $request->input('product_id');
        $this->input['postcode']      = $request->input('postcode');
        $this->input['prefecture']    = $request->input('prefecture');
        $this->input['municipality']  = $request->input('municipality');
        $this->input['address']       = $request->input('address');
        $this->input['building']      = $request->input('building');
        $this->input['delivery_date'] = $request->input('delivery_date');

        //フォームの既定値
        $this->default['delivery_date'] = $this->getEnableDeliveryDates();
    }

    /**
     * フォーム設定 $this->settingを取得
     */
    public function setting($key)
    {
        return array_key_exists($key, $this->setting)
                    ? $this->setting[$key]
                    : null;
    }

    /**
     * フォーム入力値 $this->inputを取得
     */
    public function input($key)
    {
        return array_key_exists($key, $this->input)
                    ? $this->input[$key]
                    : null;
    }

    /**
     * フォーム既定値 $this->defaultを取得
     */
    public function default($key = null)
    {
        if(isset($key) === false) {
            return $this->default;
        }
        else{
            return array_key_exists($key, $this->default)
                        ? $this->default[$key]
                        : null;
        }
    }

    /**
     * 選択可能な配送日を取得
     */
    private function getEnableDeliveryDates()
    {
        $target_date = new DateTime();
        $target_date = $target_date->modify('+'.$this->setting['delivery_offset'].' day');

        //15時以降は最短配送日を+1日
        if($this->setting['shift_delivery_offset_after_3pm'] && $target_date->format('G') >= 15)
        {
            $target_date = $target_date->modify('+1 day');
        }

        //都道府県毎の最短配送日設定
        if(array_key_exists($this->input['prefecture'], $this->setting['prefectures_shift_delivery_offset']))
        {
            $offset = $this->setting['prefectures_shift_delivery_offset'][$this->input['prefecture']];
            $target_date = $target_date->modify('+'.$offset.' day');
        }

        //設定の表示数になるまで配送日を生成
        $delivery_dates = [];
        while(count($delivery_dates) < $this->setting['option_display_count'])
        {
            $target_day_of_week = $target_date->format('D');
            if($target_day_of_week === 'Sat' && $this->setting['saturday_delivery_disabled'])
            {
                $target_date = $target_date->modify('+1 day');
                continue;
            }
            elseif($target_day_of_week === 'Sun' && $this->setting['sunday_delivery_disabled'])
            {
                $target_date = $target_date->modify('+1 day');
                continue;
            }

            $delivery_date = [];
            $delivery_date['display']  = $target_date->format('Y年n月j日');
            $delivery_date['display'] .= ' (' . __('DateTime.D.'.$target_date->format('D')).')';
            $delivery_date['value'] = $target_date->format('Y-m-d');
            $delivery_dates[] = $delivery_date;
            $target_date = $target_date->modify('+1 day');
        }

        return $delivery_dates;
    }

    /**
     * フォーム設定を取得
     * 
     * @param string @formName  取得したいform_settingのform_nameカラムを指定
     */
    private function getFormSetting ()
    {
        return $this->FormSetting
                    ->where('form_name', self::FORM_NAME)
                    ->first()
                    ->toArray();
    }

}