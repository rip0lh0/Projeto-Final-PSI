<?php 

namespace backend\models;

use yii;
use yii\base\Model;

use common\models\Treatment;
use common\models\Vaccine;



class TreatmentForm extends Model
{
    public $id_animal;
    public $id;
    public $name;
    public $description;

    public $vaccine_name = [];
    public $vaccine_date = [];

    public function rules()
    {
        return [
            [
                ['description'],
                'required',
                'message' => '{attribute} não pode ficar em branco.'
            ],
            [
                ['name'],
                'string',
                'max' => 60,
                'message' => '{attribute} contem mais de 60 caracteres.'
            ],
            [
                ['description'],
                'string',
                'max' => 255,
                'message' => '{attribute} contem mais de 255 caracteres.'
            ],
        ];
    }

    public function saveTreatment()
    {
        $treatment = new Treatment();

        $treatment->id_animal = $this->id_animal;
        $treatment->name = $this->name;
        $treatment->description = $this->description;

        if (!$treatment->save()) return ['error' => 'Fail To Save'];

        unset($this->vaccine_name[0]);/* Value From Model */
        unset($this->vaccine_date[0]);/* Value From Model */
        // Reorganize
        $this->vaccine_name = array_values($this->vaccine_name);
        $this->vaccine_date = array_values($this->vaccine_date);

        /* Vaccine */
        for ($i = 0; $i < count($this->vaccine_name); $i++) {
            if (empty($this->vaccine_name[$i]) || empty($this->vaccine_date[$i])) {
                continue;
            }

            $vaccine = new Vaccine();

            $vaccine->id_treatment = $treatment->id;
            $vaccine->vaccine = $this->vaccine_name[$i];
            $vaccine->date = date('Y/m/d', strtotime($this->vaccine_date[$i]));

            if (!$vaccine->save()) {
                $treatment->delete();
                return ['error' => 'Fail To Save'];
            }

        }

        return ['success' => 'Animal inserido com successo'];
    }

    public function updateTreatment()
    {
        $treatment = Treatment::findOne($this->id);

        unset($this->vaccine_name[0]);/* Value From Model */
        unset($this->vaccine_date[0]);/* Value From Model */

        $treatment->id_animal = $this->id_animal;
        $treatment->name = $this->name;
        $treatment->description = $this->description;

        $treatment->update();

        Vaccine::deleteAll(['id_treatment' => $treatment->id]);

        // Reorganize
        $this->vaccine_name = array_values($this->vaccine_name);
        $this->vaccine_date = array_values($this->vaccine_date);

        /* Vaccine */
        for ($i = 0; $i < count($this->vaccine_name); $i++) {
            if (empty($this->vaccine_name[$i]) || empty($this->vaccine_date[$i])) {
                continue;
            }

            $vaccine = new Vaccine();

            $vaccine->id_treatment = $treatment->id;
            $vaccine->vaccine = $this->vaccine_name[$i];
            $vaccine->date = date('Y/m/d', strtotime($this->vaccine_date[$i]));

            if (!$vaccine->save()) {
                $treatment->delete();
                return ['error' => 'Fail To Save'];
            }

        }

        return ['success' => 'Animal inserido com successo'];
    }

    public function update()
    {

    }

}