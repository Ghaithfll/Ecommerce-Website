<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
    
     @vite('resources/css/app.css')
</head>
<body>

    <x-navbar/>
    <h1 class="text-3xl mx-15">New Product?</h1>

<div class="w-screen flex justify-center ">
    <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
        <legend class="fieldset-legend">Product Details</legend>
    <form class="border-5-white rounded" action='' method="POST" enctype="multipart/form-data"> {{-- without the enctype, the img wont be uploaded properly --}}
        @csrf

        <label class="label" for="name">Product Name</label><br>
        <input class="input" type="text" name="name" id="name" placeholder="Soap"><br>
        <x-formError field='name'/>
        <br>
        <label class="label" for="description">Product description</label><br>
        <textarea class="textarea" name="description" id="description" maxlength="200" rows="5" cols="20" placeholder="Cleaning thing"></textarea>
        <x-formError field='description'/>
        <br>
        <br>
        
        <label class="label" for="price">Product Price</label><br>
        <div class="join">
        <input class="input" name="price" id="price" type="number" value="1" min="0.1" step="any">
        <select name="currency" class="select">
            <option value="SAR">SAR</option>
            <option value="JOD">JOD</option>
            <option value="USD">USD</option>

        </select>
        </div>
        <br>
        <x-formError field='price'/>
        <br>
        <label class="label" for="image">Product Image</label><br><br>
        <div class="flex justify-end">
            <input class="btn btn-neutral w-46" type="button" onclick="document.getElementById('image').click();" value="Choose Image">
        <input name="image" id="image" type="file" hidden accept="image/*" >
        </div>
        <x-formError field='image'/>
        
        <br>
        
        <button type="submit" class="btn btn-neutral mt-4 w-full ">Add Product</button>
            
    </form>
    </fieldset>
</div>
</body>
</html>