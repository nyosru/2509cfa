<?php

namespace App\Livewire\Tech;

use Livewire\Component;

class Menu extends Component
{
    public $links = [

//        'Домены' => ['route' => 'tech.domain.create','permission' => 'р.Техничка / Домены'        ],
//        'Заказ: Типы заказа' => ['route' => 'tech.order.product-type-manager', 'permission' => 'тех.ТипПродуктаУпр'],
//        'Заказ: Типы оплаты' => ['route' => 'tech.order.payment-type-manager', 'permission' => 'тех.ТипОплатыМен'],
        'Права доступа должностям' => ['route' => 'tech.role_permission', 'permission' => 'р.Права доступа'],
////        'Источники лида' => ['route' => 'tech.ClientSupplierManager', 'permission' => 'р.Поставщики лидов'],
//        'Пользователи' => ['route' => 'tech.user_list', 'permission' => 'р.Пользователи'],
//        'Путь заказа, доступы' => ['route' => 'tech.adm_role_column', 'permission' => 'тех.Управление столбцами'],
//
//        'Поиск данных по inn' => ['route' => 'tech.service.dadata_org_search_component'
//            ,'permission' => 'р.Техничка / поиск по ИНН'
//        ],
//
//        'Поля в заказе' => ['route' => 'tech.order_requests_manager', 'permission' => 'тех.упр полями в лиде'],
//
////        'Доска / Лид / Названия полей - Переименовать' => ['route' => 'tech.order-request-rename-form'
////            , 'permission' => 'р.Доски / переименовывать поля лидов'
////        ],
//
//
////        'Доска / Автоматизация' => ['route' => 'service.automation_rules_manager'
//////            , 'permission' => 'р.Доски / переименовывать поля лидов'
////        ]
////        ,
//        'Доска / Макросы' => ['route' => 'tech.macros.manager'
//            , 'permission' => 'р.Техничка / Доска Макросы'
//        ]
//        ,
//        'Доска / Шаблоны' => ['route' => 'tech.board.template.manager'
//            , 'permission' => 'р.Техничка / Шаблоны Досок создать'
//        ]
//        ,
        'ДАта записи' => ['route' => 'tech.datar2'
//            , 'permission' => 'р.Техничка / Новости Админ'
        ],

        'Новости админ' => ['route' => 'tech.news.admin'
            , 'permission' => 'р.Техничка / Новости Админ'
        ],
//        ,
////        'Колонки / цвета фона / управление' => ['route' => 'tech.column-bg-color-manager'
//////            , 'permission' => 'р.Доски / переименовывать поля лидов'
////        ]
////        ,
////        'Заказ - Метки' => ['route' => 'order.label',
////            'permission' => 'тех.метки в заказах'
////        ],
////        'Задачи' => ['route' => 'tech.task2',
////            'permission' => 'тех.ЗадачиМенеджер'
////        ],
////        'Логи' => ['route' => 'tech.logs',
////            'permission' => 'тех.логи'
////        ],
    ];


    public function render()
    {
        return view('livewire.tech.menu');
    }
}
