<?php

namespace App\Http\Controllers\v1;

use App\Connectors\LdapConnector;
use App\Http\Controllers\v1\Response\ResponseController;
use App\Http\Requests\API\Auth\UserLoginRequest;
use App\Models\JobGroups;
use App\Models\JobItems;
use App\Models\User;
use App\Models\UserRegularJobs;
use Illuminate\Support\Facades\Auth;
use LdapRecord\Auth\PasswordRequiredException;
use LdapRecord\Auth\UsernameRequiredException;
use LdapRecord\Configuration\ConfigurationException;

class AuthController extends ResponseController
{
    public function __construct(LdapConnector $ldapConnector)
    {
        $this->ldapConnector = $ldapConnector;
    }

     /**
     * @throws ConfigurationException
     * @throws UsernameRequiredException
     * @throws PasswordRequiredException
     */

    public function login(UserLoginRequest $request)
    {
        $data = $this->ldapConnector->connect($request->email , $request->password);
        if ($data)
        {
            $user = User::query()->updateOrCreate(['email'=>$request->email],
                ['fullname' => $data[0]['name'][0] , 'job_title' => $data[0]['title'][0]]
            );
            $jobGroupId = JobGroups::query()->where('name' , 'Нераспределенные')->firstOrCreate(
                ['name' => 'Нераспределенные']
            );
            $jobItemId = JobItems::query()->where('name' , $data[0]['title'][0])->firstOrCreate(
                ['name' => $data[0]['title'][0], 'job_parent_id' => $jobGroupId->id]
            );
            $regularJob = UserRegularJobs::query()->create([
                    'job_group_id' => $jobGroupId->id,
                    'job_item_id' => $jobItemId->id,
                    'user_id' => $user->id,
            ]
            );
            $role = ($user->rights === 'admin') ? 'admin' : 'user';
            $success['token'] = $user->createToken('gradeApiSecretToken', [$role])->plainTextToken;
            return $this->sendResponse($success, 'Авторизация успешна', 200);
        }
        return $this->sendError('Authentication error', ['status_code' => '401'], 401);
    }
}
