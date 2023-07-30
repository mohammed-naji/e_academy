<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label>English Name</label>
            <input type="text" name="name_en" placeholder="English Name" class="form-control @error('name_en') is-invalid @enderror"
            value="{{ old('name_en', $course->name_en) }}"
            />
            @error('name_en')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Arabic Name</label>
            <input type="text" name="name_ar" placeholder="Arabic Name" class="form-control @error('name_ar') is-invalid @enderror"
            value="{{ old('name_ar', $course->name_ar) }}"
            />
            @error('name_ar')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror"/>
            @error('image')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>price</label>
            <input type="number" name="price" placeholder="Price" class="form-control @error('price') is-invalid @enderror"
            value="{{ old('price', $course->price) }}"
            />
            @error('price')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Duration</label>
            <input type="text" name="duration" placeholder="Duration" class="form-control @error('duration') is-invalid @enderror"
            value="{{ old('duration', $course->duration) }}"
            />
            @error('duration')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Teacher</label>
            <select name="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror">
                <option selected disabled>Select Teacher</option>
                @foreach ($teachers as $teacher)
                    <option @selected($course->teacher_id == $teacher->id) value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
            @error('teacher_id')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>English Content</label>
            <textarea name="content_en" placeholder="English Content" class="form-control @error('content_en') is-invalid @enderror" rows="7">{{ old('content_en', $course->content_en) }}</textarea>
            @error('content_en')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Arabic Content</label>
            <textarea name="content_ar" placeholder="Arabic Content" class="form-control @error('content_ar') is-invalid @enderror" rows="7">{{ old('content_ar', $course->content_ar) }}</textarea>
            @error('content_ar')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

</div>
