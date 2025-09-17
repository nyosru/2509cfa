<?php

namespace App\Livewire\Cms2\Leed;

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ColumnController;
use App\Models\LeedColumn;
use App\Models\Role;
use Livewire\Component;

class CreateColumnForm extends Component
{
    public $name;
    public $board_id;
    public $user;

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
        ]);

//        if( empty($this->user->board_user) ){
////            BoardController::CreateBoard($this->user->id);
////            dd(__LINE__, __FILE__);
//        }
//        dd($this->board_id, __LINE__, __FILE__);

        $in = [
            'name' => $this->name,
            'board_id' => $this->board_id,
        ];
        $column_new = LeedColumn::create($in);

        $user = Auth()->user();
        $roleId = $user->roles->first()?->id;

        $column = new ColumnController();
        $column->setVisibleColumnForRoles( $column_new, [$roleId ?? null] );


        $this->reset('name');
        $this->dispatch('refreshLeedBoardComponent');
        session()->flash('message', 'Колонка создана.');
    }

    public function render()
    {
        return view('livewire.cms2.leed.create-column-form');
    }

}
