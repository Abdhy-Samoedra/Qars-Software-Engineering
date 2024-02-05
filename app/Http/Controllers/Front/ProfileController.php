<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFormObjects\Form;


class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        return view('profile', [
            'user' => $user
        ]);
    }

    public function render()
    {
        return view('livewire.profileinfo');
    }
}
