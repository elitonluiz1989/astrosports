<?php

namespace App\Http\Controllers\Dashboard\Commission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Commission\CommissionStoreRequest;
use App\Repositories\CommissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    /**
     * Commission repository var
     * 
     * @var CommissionRepository
     */
    private $_repo;

    public function __construct(CommissionRepository $repo)
    {
        $this->_repo = $repo;
    }

    /**
     * Retrieve the authenticated user
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function user()
    {
        return $this->_repo->get(Auth::user()->id);
    }

    /**
     * Retrieve all Commission
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function Commission()
    {
        return $this->_repo->get();
    }

    /**
     * Save an user record
     *
     * @param CommissionStoreRequest $request
     *
     * @return string
     */
    public function store(CommissionStoreRequest $request)
    {
        $data = $request->validated();

        return (string)$this->_repo->store($data);
    }

    /**
     * @param Request $request
     * @return int
     */
    public function delete(Request $request)
    {
        $id = $request->validate([
            'id' => 'integer|required'
        ])['id'];

        return $this->_repo->delete($id);
    }
}
