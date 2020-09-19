<div class="row">
    <div class="form-group col-12">
        <label for="name" class="required">Nome </label>
        <input type="text" name="name" id="name" required class="form-control" autofocus value="{{ old('name', $course->name )}}">
    </div>
    @if(Route::is('courses.show'))
        <div class="form-group col-12">
            <label for="video" class="required">Slug </label>
            <input type="text" name="slug" id="slug" required class="form-control" autofocus value="{{ old('slug', $course->slug )}}">
        </div>
    @endif
    <div class="form-group col-12">
        <label for="video" class="required">Vídeo </label>
        @if(Route::is('courses.show'))
        <iframe width="560" height="315" src="{{$course->video}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @else
            <input type="text" name="video" id="video" required class="form-control" autofocus value="{{ old('video', $course->video )}}">
        @endif 
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <label for="category" class="required">Categoria </label>
            <select class="form-control select2" name="category_id" required
                value="{{ old('category_id',$course->category_id) }}">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
    <div class="form-group col-6">  
        <label for="image">Imagem </label>
        @if(Route::is('courses.show'))
            <img class="img-fluid" style="height: 250px;width:250px" src="{{ asset('storage/' . $course->image ) }}" alt="Course picture">
        @else
            <input type="file" accept="image/*" class="form-control-file" name="image">
        @endif
    </div>
</div>
<div class="row">
    <div class="form-group col-11 ml-4">
        <label for="description" class="required">Descrição </label>
        @if(Route::is('courses.edit') || Route::is('courses.create'))
            <textarea name="description" id="description" rows="6" class="form-control" required>{!! old('description',$course->description ) !!}</textarea>
        @else
            <div class="border-html">
                <p class="pl-1">{!! $course->description !!}</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('textarea').summernote({
                callbacks:{
                    onPaste: function (e) {
                        e.preventDefault();
                    return false;
                    }
                }
            });
        });

        $(function() {
            $('.select2').select2();
        });
    </script>
@endpush