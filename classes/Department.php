<?php
require_once "GlobalClass.php";

class Department extends GlobalClass {

    public function __construct($api){
        parent::__construct("departments", $api);
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        $departments = $this->getAll();

        $html = '<div class="container mx-auto w-auto ">';
        $html .= '<ul class="container mx-auto shadow-lg shadow-black-500/50 p-6 w-3/4 bg-white">';
        foreach ($departments as $i=>$department){
            $html .= '<li class="flex mx-auto h-8 items-center">';
            $html .= '<span class="w-8">' . ++$i . '</span>';
            $html .= '<span class="flex-1">' . $department['name'] .  '</span>';
            $html .= '<button id="showUpdate" class="w-16 mr-1 border rounded border-slate-600 bg-white hover:bg-gray-300 text-sm" type="button" name="action" data-id="' . $department['id'] . '">Update
                </button>';
            $html .= '<button id="delete" class="w-16 border rounded border-slate-600 bg-white hover:bg-gray-300 text-sm" type="button" name="action" data-id="' . $department['id'] . '">Delete
                </button>';
            $html .= '</li>';
        }
        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }
}
