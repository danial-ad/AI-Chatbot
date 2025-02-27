@extends('layouts.template')

@section('header')
<h1 class="h3 mb-0 text-gray-800">Manage Documents for {{ $topic->name }}</h1>
<a href="{{ route('document.create', $topic->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
	<i class="fas fa-plus fa-sm text-white-50"></i> Add New Document
</a>
@endsection

@section('content')
<div class="card">
	<div class="card-body">

		@if(session('message'))
			<div class="badge badge-success" style="padding:10px; width:100%; margin-bottom:10px;">
				{{ session('message') }}
			</div>
		@endif

		<table class="table table-bordered table-sm">
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Description</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			@php($i = 0)
			@foreach($documents as $document)
			<tr>
				<td>{{ ++$i }}</td>
				<td>
					{{ $document->name }}<br>
					<a href="{{ asset($document->file) }}" target="_blank">Download File</a>

				</td>
				<td>{{ $document->description }}</td>
				<td>
					@if($document->status == 1)
						Active
					@else
						Inactive
					@endif
				</td>
				<td>
					<form method="POST" action="{{ route('document.destroy', [$topic->id, $document->id]) }}" 
						onsubmit="return confirm('Are you sure?');">
						<input type="hidden" name="_method" value="DELETE">
						@csrf
						<button type="submit" class="btn btn-danger btn-sm">
							Delete
						</button>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
@endsection