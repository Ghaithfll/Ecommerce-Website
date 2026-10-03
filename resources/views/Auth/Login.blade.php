<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

    <h1 class="m-20">Login or Create An Account</h1>
    <main>
        <form method="POST" action="">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
              <x-formError field='email'/>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
              <x-formError field='password'/>
              <x-formError field='error'/>
            <button type="submit">Login</button>

            <h3>Don't have an account? <a href="{{route('Signup')}}"> create_Account</a> </h3>
        </form>
    </main>
</body>
</html>