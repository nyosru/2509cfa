<?php

namespace App\Livewire\Phpcatcom\Backword;

use Livewire\Component;
use Nyos\Msg;

class Back1Form extends Component
{
    public $name = '';
    public $phone = '';
    public $message = '';
    public $privacy = false;

    protected $rules = [
        'name' => 'required|string|min:2',
        'phone' => 'required',
        'message' => 'required|string|min:10',
        'privacy' => 'accepted'
    ];

    public function submit()
    {
        $this->validate();

        // Логика отправки письма или сохранения
        $msg = 'Имя: ' . $this->name . PHP_EOL . 'Телефон: ' . $this->phone . PHP_EOL . 'Сообщение: ' . $this->message;

        $token = config('telegram.TELEGRAM_BOT_TOKEN_FOR_BACKWORD','');
        $userIds = config('telegram.user_ids',[]);

//        dd([$msg,$token,$userIds]);

        foreach ($userIds as $user_id) {
            if (!empty($user_id)) {
                Msg::sendTelegramm($msg, $user_id, null, $token);
            }
        }

        session()->flash('success', 'Ваша заявка отправлена!'.
            '<br/>'.'Имя: <u>' . htmlspecialchars($this->name) . '</u> Телефон: <u>' . htmlspecialchars($this->phone) . '</u>'.
            '<br/>'.'Мы свяжемся с вами в ближайшее время.');
        $this->reset(['name', 'phone', 'message', 'privacy']);

    }

    public
    function render()
    {
        return view('livewire.phpcatcom.backword.back1-form');
    }
}
