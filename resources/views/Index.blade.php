@extends('layouts')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/table.css') }}">
<div class="table-container">
    <h5 class="mx-auto p-2 mb-3" style="width: 200px;">List of Users</h5>
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Address</th>
                <th scope="col">Course</th>
                <th scope="col">Year</th>
                <th scope="col">Continent</th>
                <th scope="col">Country Name</th>
                <th scope="col">Capital</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
                <tr class="table-dark">
                    <td class="py-2 px-6">{{ $student->name }}</td>
                    <td class="py-2 px-6">{{ $student->age }}</td>
                    <td class="py-2 px-6">{{ $student->address }}</td>
                    <td class="py-2 px-6">{{ optional($student->academic)->course }}</td>
                    <td class="py-2 px-6">{{ optional($student->academic)->year }}</td>
                    <td class="py-2 px-6">{{ optional($student->country)->continent }}</td>
                    <td class="py-2 px-6">{{ optional($student->country)->country_name }}</td>
                    <td class="py-2 px-6">{{ optional($student->country)->capital }}</td>
                    <td class="py-2 px-6">
                        <a href="{{ route('show', ['id' => $student->id]) }}" class="btn btn-primary position-relative">Edit</a>
                    </td>
                    <td class="py-2 px-6">
                        <button type="button" class="btn btn-danger position-relative" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $index }}">
                            Delete
                        </button>
                    </td>
                </tr>

                <form action="{{ route('destroy', ['id' => $student->id]) }}" method="POST" id="deleteForm_{{ $index }}">
                    @method('DELETE')
                    @csrf
                    <div class="modal fade" id="deleteModal_{{ $index }}" tabindex="-1" aria-labelledby="deleteModalLabel_{{ $index }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel_{{ $index }}">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this account?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
