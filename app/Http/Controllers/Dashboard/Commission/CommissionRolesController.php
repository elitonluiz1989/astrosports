<?php

namespace App\Http\Controllers\Dashboard\Commission;

use App\Handlers\Dashboard\UserPermissionHandler;
use App\Http\Requests\Dashboard\Commission\CommissionRolesStoreRequest;
use App\Repositories\CommissionRolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommissionRolesController extends Controller
{
    use UserPermissionHandler;

    /**
     * @var CommissionRolesRepository
     */
    private $commission;

    /**
     * CommissionRolesController constructor.
     * @param CommissionRolesRepository $commission
     */
    public function __construct(CommissionRolesRepository $commission)
    {
        $this->commission = $commission;
    }

    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function roles($id = null)
    {
        return $this->commission->get();
    }

    /**
     * @param CommissionRolesStoreRequest $request
     * @return string
     */
    public function store(CommissionRolesStoreRequest $request)
    {
        $data = $request->validated();

        return (string)$this->commission->store($data);
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

        return $this->commission->delete($id);
    }
}
