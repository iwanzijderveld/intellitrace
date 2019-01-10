<?php namespace Insanetlabs\IntelliTrace\ViewComposers;


use stdClass;
use Illuminate\View\View;
use Illuminate\Support\Facades\URL;

class IntellitraceMenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $menuStructure = [
            'dashboard' => [
                'label' => __('intellitrace::menu.dashboard'),
                'url' => url('intellitrace/dashboard'),
            ],
            'overview' => [
                'label' => __('intellitrace::menu.overview'),
                'url' => url('intellitrace/overview')
            ]
        ];

        $view->with('menuItems', $this->convertToObject($menuStructure));
        $view->with('selected', URL::current());
    }

    private function convertToObject($array)
    {
        $object = new stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->convertToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }
}