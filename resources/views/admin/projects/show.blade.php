@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card text-center mt-5">
        <div class="card-header">
            {{ $project->title }}
        </div>
        <div class="card-body p-3 m-3">
            <h2 class="card-title fw-bold p-3">
                {{ $project->title }}
            </h2>
            <p class="card-text mb-4">
                {{ $project->content }}
            </p>
            <div class="card-image mb-4">
                @if ( $project->isImageAUrl())
                    <img src="{{ $project->image }}"
                @else
                    <img src="{{ asset('storage/uploads/' . $project->image ) }}"
                @endif
                alt="{{ $project->title }} image" class="img-fluid">
            </div>
            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-success">
                Edit
            </a>
            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </form>
        </div>
        <div class="card-footer text-muted">
            {{ $project->project_date }}
        </div>
      </div>
</div>
@endsection