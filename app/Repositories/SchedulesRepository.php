<?php
namespace App\Repositories;

use App\Models\Schedule;

class SchedulesRepository {
    /**
     * @var array
     */
    public $fields = ['hour', 'day', 'pole', 'category'];

    /**
     * @var array
     */
    private $days = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];

    /**
     * @var string
     */
    private $target;

    /**
     * @var string
     */
    private $order = 'asc';

    /**
     * @var string
     */
    private $orderFields;

    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get($id = null) {
        if (null != $id) {
            return Schedule::find($id);
        } else {
            return Schedule::all();
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBy()
    {
        $fields = $this->fieldsTreatment($this->fields);
        $order = $this->target . ' ' . $this->order . ', ' . $this->orderFields;

        $result = Schedule::join('schedules_poles', 'schedules_poles.id', '=', 'schedules.pole')
                        ->join('schedules_categories', 'schedules_categories.id', '=', 'schedules.category')
                        ->select($fields)
                        ->orderByRaw($order)
                        ->get();

        return $result->groupBy($this->target);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSchedules()
    {
        $this->target = 'hour';
        $this->orderFields = 'day, pole, category';

        $result = $this->getBy();

        $groupBy = ['day', 'pole'];
        $wanted = ['category'];

        $schedules = $this->resultHandler($result, $groupBy, $wanted);

        return $this->validateResultDays($schedules);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCategories()
    {
        $this->target = 'category';
        $this->orderFields = 'day, pole, hour';

        $result = $this->getBy();

        $groupBy = ['day', 'pole'];
        $wanted = ['hour'];

        $schedules = $this->resultHandler($result, $groupBy, $wanted);

        return $this->validateResultDays($schedules);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPoles()
    {
        $this->target = 'pole';
        $this->orderFields = 'day, category, hour';

        $result = $this->getBy('pole');

        $groupBy = ['day', 'category'];
        $wanted = ['hour'];

        $poles = $this->resultHandler($result, $groupBy, $wanted);

        return $this->validateResultDays($poles);
    }

    /**
     * @param array $fields
     * @param array $additonalOrder
     * @return \Illuminate\Support\Collection
     */
    public function getByDay($fields = [], $additonalOrder = ['hour'])
    {
        $this->target = 'day';
        $this->orderFields = 'hour, pole, category';

        $result = $this->getBy('day');

        $groupBy = ['hour', 'pole'];
        $wanted = ['category'];

        $schedules = $this->resultHandler($result, $groupBy, $wanted);

        return $this->iterateResultDays($schedules);
    }


    public function listSchedules()
    {
        $fields = $this->fieldsTreatment($this->fields);

        $result = Schedule::with('pole')
            ->with('category')
            ->get($this->fields);

        return $result;
    }

    public function storeSchedule(array $data)
    {
        if (isset($data['id'])) {
            $schedule = $this->get($data['id']);
        } else {
            $schedule = new Schedule();
        }

        foreach ($data as $field => $value) {
            $schedule->$field = $value;
        }

        return $schedule->save();
    }

    public function deleteSchedule(int $id)
    {
        return Schedule::destroy($id);
    }

    /**
     * @param $fields
     * @return string
     */
    private function fieldsTreatment($fields)
    {
        return str_replace(
            [
                'id',
                'hour',
                'day',
                'pole',
                'category'
            ],
            [
                'schedules.id',
                'schedules.hour',
                'schedules.day',
                'schedules_poles.name as pole',
                'schedules_categories.name as category'
            ],
            $fields
        );
    }

    /**
     * @param $result
     * @param $groupBy
     * @param $wanted
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function resultHandler($result, $groupBy, $wanted)
    {
        return $result->map(function($content) use ($groupBy, $wanted) {

            return $content->groupBy($groupBy[0])
                            ->transform(function($content1) use ($groupBy, $wanted) {

                                return $content1->groupBy($groupBy[1])
                                                ->transform(function($content2) use ($wanted){

                                                    return $content2->map(function($content3) use ($wanted) {
                                                        return collect($content3)->only($wanted);
                                                    });
                                                });
                            });
        });
    }

    /**
     * @param $collection
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function validateResultDays($collection)
    {
        return $collection->map(function($value) {
            return $this->iterateResultDays($value);
        });
    }

    /**
     * @param $collection
     * @return \Illuminate\Support\Collection
     */
    private function iterateResultDays($collection)
    {
        $newCollection = collect();
        foreach ($this->days as $day) {
            // The else exists only to create a day of week order
            if (!isset($collection[$day])) {
                $newCollection[$day] = null;
            } else {
                $newCollection[$day] = $collection[$day];
            }
        }

        return $newCollection;
    }
}
