<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() : JsonResponse
    {

        $users = User::orderBy('id', 'DESC')->get();
        //$users = User::orderBy('id', 'DESC')->paginate(2);
        //URL + ?page=n

        return response()->json([
            'status' => true,
            'users' => $users,
        ], 200);
    }

    public function show(User $user) : JsonResponse
    {

        //user se refere a id, pq id é uma chave primária
        return response()->json([
            'status' => true,
            'users' => $user,
        ], 200);
    }

    public function store(UserRequest $request) :JsonResponse
    {
        //dd($request); ver se esta dando certo puxar a request

        DB::beginTransaction();

        try{

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            DB::commit();

            return response() -> json([
                'status' => true,
                'user' => $user,
                'message' => "Usuário cadastrado"
            ], 200);

        }catch(Exception $e){
            DB::rollBack();

            return response() -> json([
                'status' => false,
                'message' => "Usuário não cadastrado"
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user) : JsonResponse
    {

        DB::beginTransaction();

        try {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            DB::commit();

            return response() -> json([
                'status' => true,
                'user' => $user,
                'message' => "Usuário editado"
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();

            return response() -> json([
                'status' => false,
                'message' => "Usuário não editado"
            ], 400);
        }
    }

    public function destroy(User $user) : JsonResponse{
        try {

            $user->delete();

            return response() -> json([
                'status' => true,
                'user' => $user,
                'message' => "Usuário apagado"
            ], 200);

        } catch (Exception $e) {

            return response() -> json([
                'status' => false,
                'message' => "Usuário não apagado"
            ], 400);
        }
    }


}
