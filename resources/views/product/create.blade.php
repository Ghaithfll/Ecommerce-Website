<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
</head>
<body>
    <h1>New Product?</h1>

    <form action='' method="POST" enctype="multipart/form-data"> {{-- without the enctype, the img wont be uploaded properly --}}
        @csrf

        <label for="name">Product Name</label><br>
        <input type="text" name="name" id="name" placeholder="Soap"><br>
        <x-formError field='name'/>
        <label for="description">Product description</label><br>
        <textarea name="description" id="description" maxlength="200" rows="5" cols="20" placeholder="Cleaning thing"></textarea>
        <x-formError field='description'/>
        
        <br>
        <label for="price">Product Price</label><br>
        <input name="price" id="price" type="number" step="any">
        <br>
        <x-formError field='price'/>
        <select name="currency">
            <option value="SAR">SAR</option>
            <option value="JOD">JOD</option>
            <option value="USD">USD</option>

        </select>
        
        <label for="image">Product Image</label><br><br>
         &nbsp; &nbsp; &nbsp;<input name="image" id="image" type="file" accept="image/*" >
        <x-formError field='image'/>
        
         <br>
        <br><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>