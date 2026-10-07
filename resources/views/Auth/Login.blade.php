
<x-layouts.empty_layout>

    <main class="w-screen h-screen  grid grid-cols-5 ">
        <div id="left_side" class="col-span-3 p-20 bg-gradient-to-r  from-cyan-500 to-cyan-700  flex items-center justify-center">
            <div class=" w-fit h-fit text-white ">
                <h1 class="text-4xl font-bold">Welcome To Our Store!</h1>
                <p class="text-2xl pt-7">
                    Sign in to your account to browse our products, manage your orders, and enjoy a simple and secure shopping experience.
                </p>
            </div>
        </div>

        <aside id="right_side" class="col-span-2 flex justify-center items-center">
          <div class="h-1/2">  
            <h1 class="mb-20 font-bold text-2xl">Login or Create Account</h1>
    
            <form method="POST" action="">
                @csrf
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required class="w-full bg-cyan-200 rounded-2xl h-10 px-5">
                <x-formError field='email'/>
                
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required class="w-full bg-cyan-200 rounded-2xl h-10 px-5">
                <x-formError field='password'/>
                <x-formError field='error'/>
                <button type="submit" class="bg-gradient-to-l w-full from-cyan-500 to-cyan-700 text-lg font-bold text-white rounded-2xl h-10 mt-10
                transition-all duration-300
           hover:-translate-y-0.5
           hover:shadow-lg hover:shadow-cyan-500">Login</button>

                <h3 class="mt-2">Don't have an account? <a href="{{route('Signup')}}" class="italic text-cyan-600"> create_Account</a> </h3>
            </form>
          </div>  
        </aside>
    </main>
</x-layouts.empty_layout>
