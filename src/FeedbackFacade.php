<?php

namespace Tipoff\Feedback;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tipoff\Feedback\Feedback
 */
class FeedbackFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'feedback';
    }
}
