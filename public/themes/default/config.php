<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials", "views" and "widgets"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => array(

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function($theme)
        {
            // You can remove this line anytime.
            $theme->setTitle('Copyright ©  2013 - Laravel.in.th');

            // Breadcrumb template.
            // $theme->breadcrumb()->setTemplate('
            //     <ul class="breadcrumb">
            //     @foreach ($crumbs as $i => $crumb)
            //         @if ($i != (count($crumbs) - 1))
            //         <li><a href="{{ $crumb["url"] }}">{!! $crumb["label"] !!}</a><span class="divider">/</span></li>
            //         @else
            //         <li class="active">{!! $crumb["label"] !!}</li>
            //         @endif
            //     @endforeach
            //     </ul>
            // ');
        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function($theme)
        {
            $theme->asset()->add('socket','https://cdn.socket.io/socket.io-1.3.4.js');

            //$theme->asset()->usePath()->add('socket','js/components/socket.js');
            $theme->asset()->usePath()->add('jquery.min-js', 'js/components/jquery.min.js');
            $theme->asset()->usePath()->add('jquery.validate.min-js', 'js/components/jquery.validate.min.js');
            $theme->asset()->usePath()->add('bootstrap.min-js', 'js/components/boostrap.min.js');
            $theme->asset()->usePath()->add('dataTables.bootstrap.min-js', 'js/components/dataTables.bootstrap.min.js');
            $theme->asset()->usePath()->add('jquery.dataTables.min-js', 'js/components/jquery.dataTables.min.js');
            $theme->asset()->usePath()->add('sweetalert2.min-js', 'js/components/sweetalert2.min.js');
            $theme->asset()->usePath()->add('sweetalert2-js', 'js/components/sweetalert2.js');
            $theme->asset()->usePath()->add('jquery-ui-js', 'js/components/jquery-ui.js');
            $theme->asset()->usePath()->add('chart.min-js', 'js/components/chart.min.js');

            $theme->asset()->usePath()->add('bootstrap.min-css', 'css/components/bootstrap.min.css');
            $theme->asset()->usePath()->add('dataTables.bootstrap-css', 'css/components/dataTables.bootstrap.min.css');
            $theme->asset()->usePath()->add('jquery.dataTables-css', 'css/components/jquery.dataTables.min.css');
            $theme->asset()->usePath()->add('sweetalert2.min-css', 'css/components/sweetalert2.min.css');
            $theme->asset()->usePath()->add('sweetalert2-css', 'css/components/sweetalert2.css');
            $theme->asset()->usePath()->add('jquery-ui-css', 'css/components/jquery-ui.css');

            $theme->asset()->usePath()->add('font-awesome.min.css', 'css/font-awesome.min.css');



            $theme->asset()->usePath()->add('global-css', 'css/components/global.css');
            // You may use this event to set up your assets.
            // $theme->asset()->usePath()->add('core', 'core.js');
            // $theme->asset()->add('jquery', 'vendor/jquery/jquery.min.js');
            // $theme->asset()->add('jquery-ui', 'vendor/jqueryui/jquery-ui.min.js', array('jquery'));

            // Partial composer.
            // $theme->partialComposer('header', function($view)
            // {
            //     $view->with('auth', Auth::user());
            // });
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => array(

            'default' => function($theme)
            {
                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            }

        )

    )

);