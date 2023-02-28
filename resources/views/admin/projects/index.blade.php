@extends('layouts.admin')

@section('content')
<div class="container">
    <table class="table table-striped table-borderless table-hover mt-5">
        <thead class="table-dark">
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Title</th>
                <th scope="col">Project Date</th>
                <th scope="col">
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-primary">
                        Create new project
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->title }}</td>
                <td>{{ $project->project_date }}</td>
                <td>
                    <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-sm btn-primary">
                        Show
                    </a>

                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-success">
                        Edit
                    </a>

                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
                {{-- per ogni post --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection