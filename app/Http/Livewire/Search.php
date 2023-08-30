<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Search extends Component
{

    public string $username;

    public function searchUser()
    {
        // find this username if exit
        $user = User::where('username', $this->username)->first();
        if ($user != "") {
            return redirect()->route('user.tree.show', ['tree' => $user->id]);
        } else {
            $this->dispatchBrowserEvent('alert', ['status' => 'NO User Found']);
        }
    }

    public function render()
    {
        return view('livewire.search');
    }
}
