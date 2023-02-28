@extends('layouts.admin')

@section('content')
<div class="container">
    @include('admin.projects.partials.editCreate', [
        'method' => 'PUT',
        'routeName' => 'admin.projects.update'
        ])
</div>
@endsection