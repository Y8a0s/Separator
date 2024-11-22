<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "سپاراتور صنعت علی محمدی", // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
             'description' => 'با بیش از 15 سال سابقه حرفه ای در سراسر ایران در زمینه خرید و فروش (خط کامل یا تک ماشین آلات لبنی) , تولید , تعمیر , سرویس و مشاوره بصورت تخصصی.', // set false to total remove
            'separator'    => ' | ',
            'keywords'     => ['ماهاچکالا' , 'عباسی', 'مولنیا', 'وستفالیا', 'اسمیچکا', 'سپراتور' , 'خامه گیر' , 'چرخ شیر' , 'سپاراتور' , 'جداکننده شیر' , 'شیرچرخکن' , 'ماشین آلات لبنی' , 'سپراتور صنعت علی محمدی' , 'مهندس یاشار علی محمدی' , 'سانتریفیوژ' , 'باکتریفیوژ' , 'کلاریفایر' , 'milk separator' , 'separator' , 'separator sanaat alimohamadi'],
            'canonical'    => 'current', // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => "سپاراتور صنعت علی محمدی", // set false to total remove
             'description' => 'با بیش از 15 سال سابقه حرفه ای در سراسر ایران در زمینه خرید و فروش (خط کامل یا تک ماشین آلات لبنی) , تولید , تعمیر , سرویس و مشاوره بصورت تخصصی.', // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => "سپاراتور صنعت علی محمدی",
            'images'      => [ '/storage/images/logos/site_logo.png' ],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'سپاراتور صنعت علی محمدی', // set false to total remove
             'description' => 'با بیش از 15 سال سابقه حرفه ای در سراسر ایران در زمینه خرید و فروش (خط کامل یا تک ماشین آلات لبنی) , تولید , تعمیر , سرویس و مشاوره بصورت تخصصی.', // set false to total remove
            'url'    => 'current', // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'     => 'WebPage',
            'images'   => [ '/storage/images/logos/site_logo.png' ],
        ],
    ],
];
