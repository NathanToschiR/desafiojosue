@extends('admin.layouts.app')

@section('content')
    @component('admin.components.table')
        @slot('title', 'Listagem')
        @slot('create', route('courses.create'))
        @slot('head')
            <th>Nome</th>
            <th></th>
        @endslot
        @slot('body')
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td class="options"> 
                        <a href="{{ route('courses.edit', $course->id ) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                        <a href="{{ route('courses.show', $course->id ) }}" class="btn btn-dark"><i class="fas fa-search"></i></a>
                        <form action="{{ route('courses.destroy', $course->id) }}" class="form-delete" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endsection

@push('scripts')
        <script src="{{ asset('js/components/dataTable.js') }}"></script>
        <script src="{{ asset('js/components/sweetAlert.js') }}"></script>
@endpush
    