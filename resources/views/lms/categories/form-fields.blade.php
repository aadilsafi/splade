<div class="row mb-1">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <label class="form-label" style="font-size: 15px" for="categoriesTree">{{__('lang.fields.category.plural')}}</label>
        <select class="select2-size-lg form-select" id="categoriesTree" name="parent_id">
            <option value='Null' selected>{{__('lang.fields.category.parent_category')}}</option>
            @foreach ($categories as $categoryRow)
                @continue(isset($category) && $category->id == $categoryRow['id'])
                <option value="{{ $categoryRow['id'] }}"
                    {{ (isset($category) ? $category->parent_id : old('category')) == $categoryRow['id'] ? 'selected' : '' }}>
                    {{ $loop->index + 1 }} - {{ $categoryRow['tree'] }}
                </option>
            @endforeach
        </select>
        @error('category')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="row mb-1">
    <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
        <label class="form-label fs-5" for="name">{{__('lang.fields.category.name')}}</label>
        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
            id="name" name="name" placeholder="Category Name"
            value="{{ isset($category) ? $category->name : old('name') }}" onkeyup="convertToSlug(this.value);" />
        @error('name')
            <div class="invalid-tooltip">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
        <label class="form-label fs-5" for="slug">{{__('lang.fields.category.slug')}}</label>
        <input type="text" class="form-control form-control-lg @error('slug') is-invalid @enderror"
            id="slug" name="slug" placeholder="Category Name"
            value="{{ isset($category) ? $category->slug : old('slug') }}" onkeyup="convertToSlug(this.value);" />
        @error('slug')
            <div class="invalid-tooltip">{{ $message }}</div>
        @enderror
    </div>

    {{-- <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
        <label class="form-label fs-5" for="type_name">Slug</label>
        <input category="text" class="form-control form-control-lg @error('type_slug') is-invalid @enderror"
            id="type_slug" name="type_slug" placeholder="Slug" readonly
            value="{{ isset($category) ? $category->slug : old('type_slug') }}" />
        @error('type_slug')
            <div class="invalid-tooltip">{{ $message }}</div>
        @enderror
    </div> --}}

</div>
