@props(['field'])
<div>
  
    @error($field)
    <p style="color:red">{{$message}}</p>
        
    @enderror
</div>