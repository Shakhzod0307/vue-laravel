<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageStoreRequest;
use App\Http\Resources\ImagesResource;
use App\Models\ImageStore;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
//        $user->createToken('auth_token')->plainTextToken;
        return response()->json(['result'=>"New user created successfully!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.']);
        } else {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }

    public function login(Request $request){
        $credentials = $request->only('email','password');
        try {
            if (!Auth::attempt($credentials)){
                return response()->json(['error'=>'Invalid Credentials'],404);
            }
        }catch (Exception $e){
            return response()->json(['error' => 'Could not create token '. $e->__toString()], 500);
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['success'=>'Successfully logged out']);
    }

    public function imageStore(StoreImageStoreRequest $request)
    {
        $user = Auth::user();
        $path = $request->file('image')->store('images', 'public');
        $imageStore = new ImageStore();
        $imageStore->user_id = $user->id;
        $imageStore->image = $path;
        $imageStore->save();
        return response()->json([
            'message' => 'Image uploaded successfully!',
            'image_path' => $path,
        ], 201);

    }

    public function images()
    {
        $images = ImageStore::with('user')->get();
        return ImagesResource::collection($images);
    }

}
