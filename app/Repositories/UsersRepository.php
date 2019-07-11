<?php

namespace App\Repositories;

use App\Handlers\Dashboard\UserPermissionHandler;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersRepository
{
    use UserPermissionHandler;

    /**
     * @var int
     */
    public $limit = 0;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $path;

    /**
     * @var array
     */
    public $where = [];

    /**
     * @var ImageRepository
     */
    private $imageRepo;

    public function __construct(ImageRepository $image)
    {
        $this->imageRepo = $image;
    }

    /**
     * Retrieves users
     * 
     * @param integer|null $id User id to search
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get($id = null)
    {
        $query = User::with('role')
                    ->with('role.grant');

        if (null != $id) {
            return $query->find($id);
        } else {
            if (!$this->isWebmaster()) {
                if (null == $this->getAuthUserGrant()) {
                    return $this->get(Auth::user()->id); // If the logged user does not have a grant, will only show himself
                } else {
                    $query->where('user_roles.grant', '>=', $this->getAuthUserGrant());
                }
            }

            return $query->paginate($this->limit);
        }
    }

    /**
     * Store or update an user
     * 
     * @param array $data User data to be stored
     * 
     * @return bool
     */
    public function store(array $data)
    {
        if (isset($data['id'])) {
            $user = $this->get($data['id']);

            unset($data['id']);
        } else {
            $user = new User();
        }

        foreach ($data as $field => $value) {
            $field = str_replace('role', 'role_id', $field);

            $user->$field = $value;
        }

        return $user->save();
    }

    /**
     * Delete an user by your id
     * 
     * @param int $id User id
     * 
     * @return int
     */
    public function delete(int $id)
    {
        $userAvatar = User::select('avatar')
                            ->where('id', $id)
                            ->get()
                            ->first()
                            ->avatar;


        $deleted = User::destroy($id);

        if ($deleted > 0 && null != $userAvatar && !empty($userAvatar)) {
            $this->imageRepo->delete($userAvatar);
        }

        return $deleted;
    }
}