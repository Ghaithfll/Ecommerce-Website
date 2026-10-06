<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Category</title>
</head>
<body>
    <h1>Create Category</h1>

    <form method="POST" action="">
        @csrf
        <label  for="name">Category name</label>
        <input type="text" name="name" required>
        <x-formError field='name'/>
        {{-- May add img later for each categ --}}
        <button type="submit">Add</button>
    </form>
</body>
</html>