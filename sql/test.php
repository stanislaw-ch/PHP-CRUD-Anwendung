<?php
require_once "config.php";

function selectAll($db, $table): void
{
    $query = "SELECT * FROM $table ORDER BY ID ASC";

    $result = $db->query($query);

    while ($row = $result->fetch_assoc()) {
        printf("%s %s %s %s %s<br>",
            $row["id"],
            $row["firstname"],
            $row["surname"],
            $row["salary"],
            $row["isIntern"]
        );
    }

//    $result = $db->query($query);
//    for ($set = array (); $row = $result->fetch_assoc(); $set[] = $row);
    echo '<pre>';
    print_r($set);
    echo '</pre>';
}

function insertTable($db, $table, $data): void
{
    $values  = '\'' . implode("', '" , $data) . '\'';

    $query = "INSERT INTO $table(id, firstname, surname, salary, isIntern) 
                values (null, $values)";
    $db->query($query);
}

function deleteById($db, $table, $id): void
{
    $query = "DELETE FROM $table WHERE id = $id";
    $db->query($query);
}

function updateById($db, $table, $data, $id): void
{
    $sql = "UPDATE $table SET ";

    $sql_condition = '';
    foreach($data as $key=>$value) {
        $sql_condition .=
            is_numeric($value)
            ? $key . " = " . $value . ", "
            : $key . " = " . "'" . $value . "'" . ", ";
    }

    $sql_condition = rtrim($sql_condition, ', ');
    $sql .= $sql_condition;
    $sql .= " WHERE id = $id";

//    $query = "UPDATE $table
//                SET firstname = '$data[0]',
//                    surname = '$data[1]',
//                    salary = '$data[2]',
//                    isIntern = '$data[3]'
//                WHERE id = $id";
    $db->query($sql);
}

//$employee = ['Alex1', 'Wolf3', 4400, false];
$employee = Array(
    'firstname' => 'Alex1',
    'surname'=>'Wolf3',
    'salary'=>4400,
    'isIntern'=>0
);

//selectAll($mysqli,'employee');
//insertTable($mysqli,'employee', $employee);
//deleteById($mysqli,'employee', 2);
updateById($mysqli,'employee', $employee, 3);
selectAll($mysqli,'employee');