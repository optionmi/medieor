<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Repositories\GroupRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Hash;
use PeterColes\Countries\CountriesFacade;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    public $category;
    /**
     * @var GroupRepository
     */
    public $group;
    /**
     * constructor for GroupController
     * 
     * @param GroupRepository $group
     *
     * @return void
     */
    public function __construct(CategoryRepository $category, GroupRepository $group)
    {
        $this->category = $category;
        $this->group = $group;
    }

    public function index()
    {
        $groups = $this->group->allActive();
        return view('groups', compact('groups'));
    }

    public function detail($id)
    {
        $countries = CountriesFacade::lookup('en');
        $category = $this->category->find($id);

        return view('category', compact('category', 'countries'));
    }

    public function donationSubmission(Request $request, $id)
    {
        $user = auth()->user();
        $existingUser = User::where('email', $request->email)->first();
        if ($user || $existingUser) {
            $validator = validator()->make($request->all(), [
                'action' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = [
                'user_id' => $user ? $user->id : $existingUser->id,
                'category_id' => $id,
                'action' => $request->action,
            ];

            $donation = Donation::create($data);
            if ($user) $user->categories()->attach($id);
            if ($existingUser) $existingUser->categories()->attach($id);

            if ($donation) {
                return response()->json(['error' => 0, 'message' => 'Donation submitted successfully']);
            }
            return response()->json(['error' => 1, 'message' => 'Something went wrong']);
        } else {
            $validator = validator()->make($request->all(), [
                'action' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'country' => 'required',
                'phone' => 'required',
                'register' => 'required',
                'password' => $request->register == 'yes' ? 'required|min:8|confirmed' : '',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            if ($request->register == 'yes') {
                $userData = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                ];

                $user = User::create($userData);

                $user->categories()->attach($id);

                $user->country = $userData['country'];
                $user->phone = $userData['phone'];
                $user->save();

                $donationData = [
                    'user_id' => $user->id,
                    'category_id' => $id,
                    'action' => $request->action,
                ];

                $donation = Donation::create($donationData);

                // Login user
                auth()->login($user);

                if ($user && $donation) {
                    return response()->json(['error' => 0, 'message' => 'Donation submitted successfully', 'reload' => true]);
                }
                return response()->json(['error' => 1, 'message' => 'Something went wrong']);
            } else {
                $data = [
                    'category_id' => $id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'phone' => $request->phone,
                    'action' => $request->action,
                ];

                $donation = Donation::create($data);

                if ($donation) {
                    return response()->json(['error' => 0, 'message' => 'Donation submitted successfully']);
                }
                return response()->json(['error' => 1, 'message' => 'Something went wrong']);
            }
        }
    }
}
