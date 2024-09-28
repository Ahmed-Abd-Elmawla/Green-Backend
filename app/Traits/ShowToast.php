<?php

namespace App\Traits;


trait ShowToast
{

   private function position()
    {
        return app()->getLocale() === 'ar' ? 'top-start' : 'top-end';
    }

    public function showToast($message, $type = 'success',  $width = '350px', $padding = '10px')
    {
        $position = $this->position();
        return toast($message, $type)
            ->timerProgressBar()
            ->width($width)
            ->padding($padding)
            ->position($position)
            ->flash();
    }
}





