

<option data-href="" value="">Select Sub Category</option>

@foreach($cat->subs as $sub)
<option value="{{ $sub->id }}" {{ (old('subcategory_id')!="") ? ($sub->id==old('subcategory_id'))?'selected':'' : ''}}>{{ $sub->name }}</option>
@endforeach

