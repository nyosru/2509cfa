<div class=" flex item-center justify-center">
    <div class="flex flex-col md:flex-row bg-gray-100
    {{--min-h-screen--}}
    ">
        <div class="w-full md:w-1/2 px-12 py-12">
            <h2 class="font-bold text-3xl mb-4">ОТПРАВЬТЕ ЗАЯВКУ</h2>
            <p class="mb-4">или звоните
                <a href="tel:+79324818910" class="
                font-bold text-lg
                p-1 hover:bg-blue-200
                ">8(932)481-89-10</a>
            </p>
            <p class="mb-4">или напишите Телеграм: <a href="https://t.me/Nadi_Zhdanova" class="
                font-bold text-lg
                p-1 hover:bg-blue-200
                ">@Nadi_Zhdanova</a>
            </p>
            <p class="font-semibold mb-3">Что будет после отправки заявки?</p>
            <ul class="space-y-2 text-gray-700 pl-2">
                <li class="flex items-center"><span
                        class="w-3 h-3 bg-red-500 rounded-full mr-2 border-2 border-red-500"></span>Позвоним
                </li>
                <li class="flex items-center"><span
                        class="w-3 h-3 bg-white rounded-full mr-2 border-2 border-red-500"></span>Зададим уточняющие
                    вопросы
                </li>
                <li class="flex items-center"><span
                        class="w-3 h-3 bg-white rounded-full mr-2 border-2 border-red-500"></span>Рассчитаем
                    предварительную стоимость и сроки
                </li>
                <li class="flex items-center"><span
                        class="w-3 h-3 bg-white rounded-full mr-2 border-2 border-red-500"></span>Составим договор
                </li>
                <li class="flex items-center"><span
                        class="w-3 h-3 bg-red-500 rounded-full mr-2 border-2 border-red-500"></span>Выполним работы
                </li>
            </ul>
        </div>
        <div class="w-full md:w-1/2 bg-gray-900 text-white px-12 py-12 flex items-center">
            <form wire:submit.prevent="submit" class="w-full space-y-6">
                @if(session()->has('success'))
                    <div class="bg-green-500 text-white p-2 rounded">{{ session('success') }}</div>
                @endif
                <div>
                    <input type="text" wire:model="name" placeholder="Ваше имя" required
                           class="w-full bg-transparent border-b border-gray-500 focus:outline-none py-2">
                    @error('name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <input type="text" wire:model="phone" placeholder="+7 (___) ___-__-__" required
                           class="w-full bg-transparent border-b border-gray-500 focus:outline-none py-2">
                    @error('phone') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <textarea wire:model.live="message" placeholder="Ваше сообщение"
                              @if( empty($message) )
                                  rows="2"
                              @else
                                  rows="6"
                              @endif
                              class="w-full bg-transparent border-b border-gray-500 focus:outline-none py-2"></textarea>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" wire:model.live="privacy" class="mr-2" required>
                    <span class="text-xs">
                    Нажимая кнопку <span class="font-bold">«Отправить заявку»</span>, я&nbsp;принимаю условия Политики конфиденциальности и&nbsp;<span
                            class="font-bold">даю</span> Согласие на&nbsp;обработку персональных данных.
                </span>
                </div>
                <button type="submit" class="w-full bg-gray-300 text-blue-600 cursor-pointer py-2 rounded opacity-90"

                >
                    Отправить заявку
                </button>
            </form>
        </div>
    </div>
</div>
