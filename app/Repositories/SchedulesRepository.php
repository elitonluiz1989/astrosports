<?php
namespace App\Repositories;

use App\Models\Schedules;

class SchedulesRepository {
    /**
     * @var array
     */
    private $fields = ['hour', 'day', 'pole', 'category'];

    public function get($id = null) {
        if (null != $id) {
            return Schedules::find($id);
        } else {
            return Schedules::all();
        }
    }

    /**
     * SchedulesRepository getBy
     * Retrieve all schedules
     * @param array $fields
     * @param string $order
     * @return array
     */
    public function getBy($target, $fields = [], $order = 'asc')
    {
        $fields = (count($fields) > 0) ? $this->fieldsTreatment($fields) : $this->fieldsTreatment($this->fields);

        $result = Schedules::join('schedules_poles', 'schedules_poles.id', '=', 'schedules.pole')
                        ->join('schedules_categories', 'schedules_categories.id', '=', 'schedules.category')
                        ->select($fields)
                        ->orderBy($target, $order)
                        ->get();

        return $result->groupBy($target)->toArray();
    }

    /**
     * SchedulesRepository getBy
     * Retrieve all schedules
     * @param array $fields
     * @param string $order
     * @return array
     */
    public function getByDay($fields = [], $additonalOrder = ['hour'])
    {
        $order = implode(', ', $additonalOrder);
        $fields = (count($fields) > 0) ? $this->fieldsTreatment($fields) : $this->fieldsTreatment($this->fields);

        $result = Schedules::join('schedules_poles', 'schedules_poles.id', '=', 'schedules.pole')
                        ->join('schedules_categories', 'schedules_categories.id', '=', 'schedules.category')
                        ->select($fields)
                        ->orderByRaw("FIELD(day, 'mon', 'tue', 'wed', 'thu', 'fri', 'sat')")
                        ->orderByRaw($order)
                        ->get();

        return $result;
    }

    /**
     * SchedulesRepository fieldsTreatment
     * @param array $fields
     * @return array
     */
    private function fieldsTreatment($fields)
    {
        return str_replace(
            [
                'pole',
                'category'
            ],
            [
                'schedules_poles.name as pole',
                'schedules_categories.name as category'
            ],
            $fields
        );
    }

    /**
     * SchedulesRepository resultHandler
     * @param Collection $result
     * @param string $index
     * @return array
     */
    private function resultHandler($result, $index)
    {
        $newResult = [];
        $currentIndex = "";

        $fields = $result->original;
        unset($fields[$index]);
        unset($fields['day']);

        foreach ($result as $data) {
            if ($currentIndex != $data->$index) {
                $currentIndex = $data->$index;
            }

            foreach ($fields as $field) {
                $result[$currentIndex][$data->day][] = $data->$field;
            }
        }

        return $result;
    }
}
