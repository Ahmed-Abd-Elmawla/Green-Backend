<?php

namespace App\Traits;


trait AlertPosition
{

   private function position()
    {
        return app()->getLocale() === 'ar' ? 'top-start' : 'top-end';
    }
}





