@switch($type)
    @case('id')
        <input type="number" name="id" value="{{isset($value)?$value:''}}" hidden>
    @break

    @case('label')
    <div class="text-center">
        <label><strong>{{$value}}</strong></label>
    </div>
    @break

    @case('text')
        <div class="form-group">
            <label><strong>{{$title}}</strong></label>
            <input
            @isset ($id)
            id = "{{$id}}"
            @endisset
            type="{{$type}}" name="{{$name}}" class="form-control {{isset($class)?$class:''}}" placeholder="{{isset($placeholder)?$placeholder:''}}" value="{{isset($value)?$value:''}}"
            
            @isset ($readonly)
            readonly
            @endisset
            >
        </div>
    @break
    
    @case('mtext')
        <div class="form-group">
            <label><strong>{{$title}}</strong></label>
            <textarea
            @isset ($id)
            id = "{{$id}}"
            @endisset
            name="{{$name}}"  class="form-control {{isset($class)?$class:''}}" placeholder="{{isset($placeholder)?$placeholder:''}}"
            @isset ($readonly)
            readonly
            @endisset
            >{{isset($value)?$value:''}}</textarea>
        </div>
    @break

    @case('stext')
        <div class="form-group">
            <label><strong>{{$title}}</strong></label>
            <textarea 
            @isset ($id)
            id = "{{$id}}"
            @endisset
            name="{{$name}}" class="summernote {{isset($class)?$class:''}}" placeholder="{{isset($placeholder)?$placeholder:''}}"
            @isset ($readonly)
            readonly
            @endisset
            >{{isset($value)?$value:''}}</textarea>
        </div>
    @break

    @case('number')
        <div class="form-group">
            <label><strong>{{$title}}</strong></label>
            <input
            @isset ($id)
            id = "{{$id}}"
            @endisset
            type="{{$type}}" name="{{$name}}" class="form-control {{isset($class)?$class:''}}" placeholder="{{isset($placeholder)?$placeholder:''}}" value="{{isset($value)?$value:'0'}}"
            
            @isset ($readonly)
            readonly
            @endisset
            >
        </div>
    @break

    @case('check')
        <div class="form-check">
            <input
            @isset ($id)
            id = "{{$id}}"
            @endisset
            class="form-check-input {{isset($class)?$class:''}}" type="checkbox" value="{{isset($value)?$value:''}}" name="{{$name}}" {{(isset($checked) && $checked)?'checked':''}}
            
            @isset ($readonly)
            readonly
            @endisset
            >
            <label class="form-check-label">{{$title}}</label>
        </div>
    @break

    @case('select')
        <div class="form-group">
            <label><strong>{{$title}}</strong></label>
            <select 
            @isset ($id)
            id = "{{$id}}"
            @endisset
            class="form-control {{isset($class)?$class:''}}" name="{{$name}}"
            
            @isset ($readonly)
            readonly
            @endisset
            >
                <option value="">-не выбрано-</option>
                @foreach ($list as $el)
                    <option value="{{$el['value']}}" {{isset($value)&&$value==$el['value']?'selected':''}}>{{$el['title']}}</option>
                @endforeach
            </select>
        </div>
    @break

@endswitch