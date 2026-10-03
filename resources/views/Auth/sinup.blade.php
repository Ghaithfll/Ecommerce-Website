<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Create an account</h1>

     <main>
        <form method="POST" action="">
            @csrf
            <label for="name">name</label>
            <input type="name" name="name" id="name" required>
              <x-formError field='email'/>
            
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
              <x-formError field='email'/>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
              <x-formError field='password'/>
              <x-formError field='error'/>
            <button type="submit">Signup</button>

       
        </form>
    </main>
</body>
</html>