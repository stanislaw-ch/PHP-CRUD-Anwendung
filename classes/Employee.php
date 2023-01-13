<?php
require_once "GlobalClass.php";

class Employee extends GlobalClass {
    public function __construct($api){
        parent::__construct("employees", $api);
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        $data = $this->getAllEmployees();

        $html = '
            <div class="container mx-auto w-auto mt-5">
                <ul class="
                        container mx-auto shadow-lg
                        shadow-black-500/50 p-6
                        w-6/7 md:w-4/5 bg-white
                    "
                >';

        foreach ($data as $i=>$item) {
//            print_r($item);
            $html .= '
                    <li class="flex mx-auto h-8 items-center justify-between">
                        <span class="w-8">' . ++$i . '</span>
                        <span class="flex-1">' . $item['firstname'] .  '</span>
                        <span class="flex-1">' . $item['lastname'] .  '</span>
                        <span class="flex-1">' . $item['gender'] .  '</span>
                        <span class="flex-1">' . $item['salary'] .  '</span>
                        <span class="flex-1">' . $item['name'] .  '</span>
                        <button
                            id="showUpdateEmp"
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
                            id="deleteEmp"
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
        $data = $this->getAllEmployees();

        $html = '
            <div class="container mx-auto w-auto mt-5">
                <ul class="
                        container mx-auto shadow-lg
                        shadow-black-500/50 p-6
                        w-6/7 md:w-3/5 bg-white
                    "
                >';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex mx-auto h-8 items-center justify-between">
                        <span class="w-8">' . ++$i . '</span>
                        <span class="flex-1">' . $item['firstname'] .  '</span>
                        <span class="flex-1">' . $item['lastname'] .  '</span>
                        <span class="flex-1">' . $item['salary'] .  '</span>
                        <span class="flex-1">' . $item['gender'] .  '</span>
                        <span class="flex-1">' . $item['name'] .  '</span>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}
