<?php

namespace App\Http\Controllers;

use App\Repositories\DefaultRepository;
use App\Repositories\SchedulesRepository;
use App\Repositories\VideosRepository;
use Illuminate\Support\Facades\Request;

class TemplateController extends Controller
{
    /**
     * @var DefaultRepository
     */
    private $default;

    /**
     * @var SchedulesRepository
     */
    private $schedules;

    /**
     * @var VideosRepository
     */
    private $videos;

    public function __construct(
        DefaultRepository $defaultRepo,
        SchedulesRepository $schedules,
        VideosRepository $videos
    )
    {
        $this->default = $defaultRepo;
        $this->schedules = $schedules;
        $this->videos = $videos;
    }

    /**
     * @return array
     */
    public function social()
    {

        return [
            'listOrientation' => 'right',
            'social'          => $this->socialDataTreatment()
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function navItems()
    {
        $current = Request::path();
        if (\strpos('/', $current) === false) {
            $current = "/{$current}";
        }

        return [
            'navItems' => config('template.nav'),
            'current' => $current
        ];
    }

    /**
     * TemplateController schedules
     * Retrive all schedules ordered by day, hour, pole
     * @return array
     */
    public function schedules()
    {
        $inVacation = config('schedules')['vacation'];
        $weekdays = config('schedules')['tabData']['days'];

        if ($inVacation) {
            $schedules = [
                'sun' => null,
                'mon' => null,
                'tue' => null,
                'wed' => null,
                'thu' => null,
                'fri' => null,
                'sat' => null
            ];

            $scheduleMessage = config('schedules')['vacationMessage'] . '<br>...';
        } else {
            $schedules = $this->schedules->getByDay();
            $scheduleMessage = 'Sem horários<br>...';
        }

        return [
            'weekDays'   => $weekdays,
            'currentDay' => \strtolower(\date('D')),
            'schedules'  => $schedules,
            'scheduleEmptyMessage' => $scheduleMessage
        ];
    }

    /**
     * TemplateController videos
     * Retrieve two last videos of a channel
     */
    public function videos()
    {
        $this->videos->videosAttrs = ['title', 'url', ['thumb', 'medium']];
        $this->videos->limit = 2;
        $records = $this->videos->all();

        return ['videos' => $records];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function advertising()
    {
        return $this->default->model('advertising')->get();
    }

    /**
     * @return array
     */
    public function footer()
    {
        $contacts = $this->default->model('contact');
        return [
            'telephones'   => $contacts->get('telephone'),
            'emails'       => $contacts->get('email'),
            'social'       => [
                'listOrientation' => 'left',
                'showSocialTitle' => true,
                'social'          => $this->socialDataTreatment()
            ],
            'localization' => $contacts->get('localization')
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function socialDataTreatment()
    {
        $social = $this->default->model('contact')->get('social');
        $social = \array_filter($social);
        $socialLinks = config('layout.social.links');

        return collect($social)->map(function($socialTitle, $socialLink) use ($socialLinks) {
            return $socialLinks[$socialLink] . $socialTitle;
        });
    }
}