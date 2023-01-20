<?php
require_once "classes/views/Modules.php";

class DepartmentPage extends Modules{
    private string $id;
    protected array $errors;
    protected array $values;

    public function __construct($api, $errors=[], $id = '', $values=[]){
        parent::__construct($api);
        $this->id = $id;
        $this->errors = $errors;
        $this->values = $values;

        $this->isActiveMain = '';
        $this->isActiveEmployee = '';
        $this->isActiveDepartment = $this->activeClass;
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung Department page";
    }

    protected function getTop(): string
    {
        return $this->showDepartmentForm();
    }

    protected function getMiddle(): string
    {
        return $this->showDepartmentsTable();
    }

    private function showDepartmentForm(): string
    {
        $html = '
            <div class="md:w-96 sm:w-96 w-full mx-auto p-7 mb-5 bg-white shadow-lg shadow-black-500/50">
                <form class="flex flex-col box-border" action="index.php?view=departments" method="post">';

        $html .= $this->getInput($this->id, $this->values);
        $html .= $this->getButtons($this->id);

        $html .= '      </form>
            </div>
        ';

        return $html;
    }

    public function showDepartmentsTable(): string
    {
        $data = $this->department->getDepartments();

        $html = '
            <div class="md:w-96 sm:w-96 w-full mx-auto p-7 pb-10 mb-5 bg-white shadow-lg shadow-black-500/50">
                <h2 class="mb-5 text-center text-lg">Abteilungen</h2>
                <ul>
                    <li class="flex content-center h-10 text-white bg-slate-700">
                        <span class="flex self-center justify-center w-8">#</span>
                        <span class="flex self-center justify-center flex-1">Abteilung</span>
                    </li>
        ';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex h-10 border-b border-gray-400 border-dashed">
                        <span class="flex self-center justify-center w-8">' . ++$i . '</span>
                        <span class="flex self-center ppl-2">' . $item['name'] .  '</span>
                        <button
                            id="showUpdateDepartment"
                            class="
                                w-12 mr-1 ml-auto
                                bg-white hover:underline text-sm
                            "
                            type="button"
                            name="action"
                            data-id="' . $item['id'] . '"
                            data-view="departments"
                        >Update
                        </button>
                        <button
                            id="deleteDepartment"
                            class="
                                w-12 mr-1
                                bg-white hover:underline text-sm
                            "
                            type="button"
                            name="action"
                            data-id="' . $item['id'] . '"
                            data-view="departments"
                        >Delete
                        </button>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }

    private function getInput($id, $values): string
    {
        $html = '  <label for="name" class="block text-md my-1 font-medium">Abteilungsname</label>
                    <input
                            id="name" type="text"
                            name="name"
                            class="[appearance:textfield] border-b-2 border-black px-2 mb-5 h-8 focus:outline-none appearance-none"
                            placeholder="Abteilungsname"';

        if (strlen($id) !== 0 && count($values) === 0) {
            $name = '';
            $idDep = '';

            if ($this->department->getById($id)) {
                $name = $this->department->getById($id)['name'];
                $idDep = $this->department->getById($id)['id'];
            }
            $html .= 'value="'. $name . '">';
            $html .= '<input type="hidden" name="id" value="' . $idDep . '">';
        } elseif (strlen($id) === 0 && count($values) !== 0) {
            $html .= 'value="'. $values['name'] . '">';
        } elseif (strlen($id) !== 0 && count($values) !== 0) {
            $html .= 'value="'. $this->department->getById($id)['name'] . '">';
            $html .= '<input type="hidden" name="id" value="' . $this->department->getById($id)['id'] . '">';
        } else {
            $html .= '>';
        }

        $html .= $this->isError($this->errors,'name');

        return $html;
    }

    private function getButtons($id): string
    {
        $html = '';

        if (strlen($id) !== 0) {
            $html .= '<button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="updateDepartment">Update
                        </button>';
        } else {
            $html .= '<button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="createDepartment">Create
                        </button>';
        }
        return $html;
    }
}