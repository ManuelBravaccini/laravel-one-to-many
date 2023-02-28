<form action="{{ route($routeName, $project) }}" method="POST" class="p-5" enctype="multipart/form-data">
    @csrf
    @method($method)

    @if($errors->any())
    <div class="error-wrapper">
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <h5 class="mb-3">
        Author: <span class="fw-semibold">{{ Auth::user()->name }} </span>
    </h5>

    <div class="mb-3">
        <label for="project_title" class="form-label">
            Project title
        </label>
        <input type="text" class="form-control" id="project_title" placeholder="Insert Project's title" name="title" value="{{ old('title', $project->title) }}">
    </div>

    <div class="mb-3">
        <label for="project_date" class="form-label">Project date</label>
        <input type="date" class="form-control" id="project_date" name="project_date" value="{{ old('project_date', $project->project_date) }}">
    </div>

    <div class="mb-3">
        <label for="project_content" class="form-label">Project content</label>
        <textarea class="form-control" id="project_content" rows="5" name="content">{{ old('content', $project->content) }}</textarea>
    </div>
<!--
-->
    <div class="mb-3">
        <label for="project_image" class="form-label">Project image</label>
        <input type="file" class="form-control" id="project_image" name="image" value="{{ old('image', $project->image) }}">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
            Update this project
        </button>
    </div>
</form>