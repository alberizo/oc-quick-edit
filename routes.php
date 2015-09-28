<?php

App::before(function($request)
{
    Route::group(['prefix' => Config::get('cms.backendUri', 'backend')], function() {
        Route::any('indikator/qedit/content', function() {
            if (File::exists('themes/'.get('path'))) {
                $content = File::get('themes/'.get('path'));
                if (substr_count(get('path'), '/content/') == 0) {
                    $content = substr($content, strrpos($content, '==') + 2);
                }

                return trim($content);
            }

            else {
                return '';
            }
        });

        Route::any('indikator/qedit/date', function() {
            if (File::exists('themes/'.get('path'))) {
                $modified = File::lastModified('themes/'.get('path'));

                $date = IntlDateFormatter::create(
                    App::getLocale(),
                    IntlDateFormatter::MEDIUM,
                    IntlDateFormatter::NONE
                )->format($modified);

                return date($date.' G:i', $modified);
            }

            else {
                return '';
            }
        });
    });
});
