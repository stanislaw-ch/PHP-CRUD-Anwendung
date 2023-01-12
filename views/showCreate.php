<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Neuer Mitarbeiter</title>
</head>
<body>
<div class="container mx-auto">
    <form class="box-border w-64 p-6 border-1 mx-auto shadow-lg shadow-black-500/50 flex flex-col bg-white" action="index.php" method="post">
        <label for="name" class="block text-md my-1 font-medium">Abteilungsname</label>
        <input
                id="name" type="text"
                name="name"
                class="border rounded border-slate-400 px-2 h-8">
        <button class="border w-20 h-7 rounded border-slate-600 bg-gray-200 mt-4 self-end hover:bg-gray-300" type="submit" name="action" value="create">Create
        </button>
    </form>
</div>
</body>
</html>
