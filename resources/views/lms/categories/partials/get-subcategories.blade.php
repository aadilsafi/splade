@if($categories)
    <ul class="m-0" style="list-style: none">
        @foreach($categories as $category)
            <li class="single-item" data-id="{{$category->id}}" data-name="{{$category->slug}}" data-parent="{{$category->parent_id}}">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="btn-group cursor-pointer">
                            <i data-feather="arrow-down" onclick="move(this,'down',{{$category->position}},{{$category->id}},'{{route('categories.reorder')}}')"></i>
                            <i data-feather="arrow-up" onclick="move(this,'up',{{$category->position}},{{$category->id}},'{{route('categories.reorder')}}')"></i>
                        </div>
                        <p style="font-variant: small-caps" class="text-truncate p-0 m-1">
                            {{\Illuminate\Support\Str::title($category->name)}}
                        </p>
                    </div>
                    <a href="javascript:void(0)" data-href="{{route('category.course.index',$category->slug)}}" onclick="getCourses(this)">
                        <small title="Courses" class="text-muted">({{$category->courses()->count()}})</small>
                        <i data-feather='eye'></i>
                    </a>
                </div>
                @if(count($category->subcategories) > 0)
                    @include('lms.categories.partials.get-subcategories', ['categories' => $category->subcategories])
                @endif
            </li>
        @endforeach
    </ul>
@endif

