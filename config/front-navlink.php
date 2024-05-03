<?php

return [
    [
        'title' => env('WIKI_MENU_NAME','Wiki'),
        'menu_name' => env('WIKI_MENU_NAME','Wiki'),
        'route' => 'front.wiki.index',
        'active' => ['front.wiki.index','front.wiki.show'],
        'order' => env('WIKI_ORDER_FOR_NAV',4),
        'wire_navigate' => true,
        
        
    ],

    
];