<?php 

namespace backend\models;

use Yii;
use yii\base\Model;

use common\models\Schedule;

class ScheduleForm extends Model
{
    public $id_kennel;
    public $has_lunch;
    public $days_week = [];
    public $hours = [];
    public $hours_lunch = [];


    public function rules()
    {
        return [
            [['id_kennel', 'days_week', 'hours'], 'required'],
            [['has_lunch'], 'required'],
            ['hours_lunch', 'required', 'when' => function ($model) {
                return $model->has_lunch == 1;
            }],
        ];
    }

    public function attributeLabels()
    {
        return [
            'has_lunch' => 'Hora de Almoço',
        ];
    }


    public function saveSchedule()
    {
        if (empty($this->days_week) || empty($this->hours)) return ['error' => ['Faild To Save Schedule']];

        if ($this->has_lunch) {
            if ((strtotime($this->hours['open']) >= strtotime($this->hours_lunch['open']))
                || (strtotime($this->hours_lunch['open']) >= strtotime($this->hours_lunch['close']))
                || (strtotime($this->hours_lunch['close']) >= strtotime($this->hours['close']))) return ['error' => ['Horas estao incorretas']];
        } else {
            if (strtotime($this->hours['open']) >= strtotime($this->hours['close'])) return ['error' => ['Horas estao incorretas']];
        }


        Schedule::deleteAll(['id_kennel' => $this->id_kennel]);

        foreach ($this->days_week as $key_days => $day) {
            $schedule = new Schedule();

            $schedule->id_kennel = $this->id_kennel;
            $schedule->day = $day;
            $schedule->open_time = date('H:i', strtotime($this->hours['open']));
            $schedule->close_time = date('H:i', strtotime($this->hours['close']));

            if ($this->has_lunch) {
                $schedule->lunch_open = date('H:i', strtotime($this->hours_lunch['open']));
                $schedule->lunch_close = date('H:i', strtotime($this->hours_lunch['close']));
            }

            if (!$schedule->save()) {
                $schedule->delete();
                return ['error' => 'Faild To Save Schedule'];
            }


        }

        return ['success' => 'Horario Alterado com sucesso'];


    }
}