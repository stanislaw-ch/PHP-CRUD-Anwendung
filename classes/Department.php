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
        $data = $this->getAllDepartments();

        $html = '
            <div class="container mx-auto">
                <ul class="
                        container mx-auto shadow-lg
                        shadow-black-500/50 p-6
                        w-4/5 md:w-3/6 bg-white
                    "
                >';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex mx-auto h-8 items-center">
                        <span class="w-8">' . ++$i . '</span>
                        <span class="flex-1">' . $item['name'] .  '</span>
                        <button
                            id="showUpdateDep"
                            class="
                                w-16 mr-1 border rounded
                                border-slate-600 bg-white
                                hover:bg-gray-300 text-sm
                            "
                            type="button"
                            name="action"
                            data-id="' . $item['id'] . '"
                        >Update
                        </button>
                        <button
                            id="deleteDep"
                            class="
                                w-16 border rounded
                                border-slate-600 bg-white
                                hover:bg-gray-300 text-sm
                            "
                            type="button"
                            name="action"
                            data-id="' . $item['id'] . '"
                        >Delete
                        </button>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }

    public function getTablePreView(): string
    {
        $data = $this->getAllDepartments();

        $html = '
            <div class="container mx-auto w-auto ">
                <ul class="
                        container mx-auto shadow-lg
                        shadow-black-500/50 p-6
                        w-3/5 md:w-2/6 bg-white
                    "
                >';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex mx-auto h-8 items-center">
                        <span class="w-8">' . ++$i . '</span>
                        <span class="flex-1">' . $item['name'] .  '</span>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}