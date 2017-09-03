<?php

namespace App\Http\Controllers;

use App\Repositories\DefaultRepository;
use App\Repositories\SchedulesRepository;
use App\Repositories\VideosRepository;

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
     * @return array
     */
    public function navItems()
    {
        return ['navItems' => config('template.nav')];
    }

    /**
     * TemplateController schedules
     * Retrive all schedules ordered by day, hour, pole
     * @return array
     */
    public function schedules()
    {
        $schedules = $this->schedules->getByDay();

        return [
            'weekDays'   => [
                'sun' => 'DOM',
                'mon' => 'SEG',
                'tue' => 'TER',
                'wed' => 'QUA',
                'thu' => 'QUI',
                'fri' => 'SEX',
                'sat' => 'SÁB'
            ],
            'currentDay' => \strtolower(\date('D')),
            'schedules'  => $schedules
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
        $socialLinks = config('template.social.links');

        return collect($social)->map(function($socialTitle, $socialLink) use ($socialLinks) {
            return $socialLinks[$socialLink] . $socialTitle;
        });
    }
}
