<?php 

namespace Raakkan\Yali\App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('yali::layouts.app')] 
class Dashboard extends Component
{
    public function render()
    {
        return view('yali::livewire.dashboard');
    }
}