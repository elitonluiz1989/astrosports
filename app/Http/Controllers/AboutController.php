<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HistoryRepository as History;

/**
 * Class AboutController
 */
class AboutController extends Controller
{
    /**
     * AboutController index
     */
    public function index($display = 'history') {
        $data = [
            'display' => $this->displayHandler($display),
            'history' => History::get()
        ];

        return view('about', $data);
    }

    /**
     * AboutController displayHandler
     * @param string $display
     * @return string
     */
    private function displayHandler($display) {
        $occurrences = ['historia', 'cartilha', 'jogadores', 'comissao'];
        $replacements = ['history', 'primer', 'players', 'committee'];

        return str_replace($occurrences, $replacements, $display);
    }
}
