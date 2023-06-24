<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class AgentComponent extends Component
{
    public $componentAgent;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->componentAgent = $this->getAgent();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.agent-component');
    }

    public function getAgent()
    {
        return User::with('roles')->with('agent_profile')->get()->filter(function ($user, $key) {
            return $user->hasRole('Agent');
        })->mapWithKeys(function ($agent) {
            return [$agent->id => $agent->agent_profile->company_name ??  $agent->name['en']];
        });
    }
}
