@if(isset($sub_cat) && !empty($sub_cat))
    @foreach($sub_cat as $val)
            <option value="{{ $val->subcategory_id }}">{{ ucfirst($val->subcategory_name) }}</option>
    @endforeach
@endif
