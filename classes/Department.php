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

//        $html = '<div class="row">';
        $html = '<div class="container mx-auto w-auto ">';
        $html .= '<ul class="container mx-auto shadow-lg shadow-black-500/50 p-6 w-3/4 bg-white">';
        foreach ($departments as $i=>$department){
            $html .= '<li class="flex mx-auto h-8 items-center">';
            $html .= '<span class="w-8">' . ++$i . '</span>';
//            $html .= '<div class="col">';
            $html .= '<span class="flex-1">' . $department['name'] .  '</span>';
            $html .= '<button id="showUpdate" class="w-16 mr-1 border rounded border-slate-600 bg-white hover:bg-gray-300 text-sm" type="button" name="action" data-id="' . $department['id'] . '">Update
                </button>';
            $html .= '<button id="delete" class="w-16 border rounded border-slate-600 bg-white hover:bg-gray-300 text-sm" type="button" name="action" data-id="' . $department['id'] . '">Delete
                </button>';
            $html .= '</li>';


//            $html .= '<div class="row">';
//            $html .= '<div class="col s12">';
//            $html .= '<div class="col s8 no-padding">';
//            $html .= '<li class="collection-item">' . ++$i;
////            $html .= '<div class="col">';
//            $html .= '<span class="secondary-content">' . $department['name'] .  '</span>';
//            $html .= '</li>';
//            $html .= '</div>';
//            $html .= '<button id="showUpdate" class="showUpdate btn waves-effect waves-light col s2 secondary-content" type="button" name="action" data-id="' . $department['id'] . '">Update
//                </button>';
//            $html .= '<button id="delete" class="btn waves-effect waves-light col s2 secondary-content" type="button" name="action" data-id="' . $department['id'] . '">Delete
//                </button>';
//            $html .= '</div>';
//            $html .= '</div>';
//
//            $html .= '<td><button type="button" class="showUpdate" data-id="' . $department['id'] . '">Update</button></td>';
//            $html .= '<td><button type="button" class="delete" data-id="' . $department['id'] . '">Delete</button></td>';
//            $html .= '</div>';
//            $html .= '</div>';
        }
        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }
}
