@extends('layouts.admin')

@section('title', 'الضبط العام')

@section('content')
<!-- Responsive Table -->
<div class="card">
    <div class="card-header py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold">المخازن</h5>

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('backend.stores.create') }}" class=" btn btn-primary">
                <span class="text">اضافة مخزن جديد</span>

                <span class="">
                    <i class="fa-regular fa-plus fa-xl"></i>
                </span>
            </a>

        </div>

    </div>
    {{-- /.card-header --}}
    <hr class="m-0">
    <div class="card-body">
        <div id="ajax_response_div">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>اسم المخزن</th>
                            <th>رقم الهاتف</th>
                            <th>العنوان</th>
                            <th>حالة التفعيل</th>
                            <th>تاريخ الاضافة</th>
                            <th>تاريخ التحديث</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($stores as $store)
                        <tr>
                            <td>{{ $loop->index + 1}}</td>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->phone }}</td>
                            <td>{{ $store->address }}</td>
                            <td>{!! $store->active()!!}</td>
                            <td>
                                {{ $store->created_at->format('Y-m-d H:i') }}
                                {{ $store->created_at->format('Y-m-d H:i A') == 'AM'? 'صباحا': 'مساء' }}

                                <br>
                                <span class=""> بواسطة</span>
                                <span class="text-primary fw-bold"> {{ $store->added_by_admin }}</span>
                            </td>

                            <td>
                                @if ($store->updated_by_admin <> null)
                                    {{ $store->updated_at->format('Y-m-d H:i') }}
                                    {{ $store->updated_at->format('Y-m-d H:i A') == 'AM'? 'صباحا': 'مساء'
                                    }}

                                    <br>
                                    <span class=""> بواسطة</span>
                                    <span class="text-primary fw-bold"> {{ $store->updated_by_admin
                                        }}</span>
                                    @else
                                    لايوجد تحديث
                                    @endif
                            </td>

                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('backend.stores.edit',$store->id) }}"
                                        class="btn btn-primary btn-sm rounded">
                                        <i class='bx bx-edit'></i>
                                    </a>

                                    <a href="javascript:void(0);"
                                        onclick="if(confirm ('هل انت متاكد من الحذف'))
                                        {document.getElementById('store-delete-form-{{ $store->id }}').submit();} else {return false}"
                                        class="btn btn-danger btn-sm rounded mx-1">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>
                                {{-- Delete Form --}}
                                <form action="{{ route('backend.stores.destroy',$store->id) }}" method="post"
                                    id="store-delete-form-{{ $store->id }}" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                {{-- End Delete Form --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-danger">لايوجد بيانات متاحة حاليا</td>
                        </tr>
                        @endforelse
                    </tbody>

                    <tfoot class="table-border-bottom-0">
                        <tr>
                            <td colspan="8">
                                <div> {{ $stores->appends(request()->all())->links() }}</div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            {{-- /.table-responsive --}}
        </div>
        {{-- /#ajax_response_div --}}
    </div>
    {{-- /.card-body --}}
</div>

{{-- Delete Form --}}
<form action="{{ route('backend.stores.destroy', $store->id) }}" method="post" class="d-none"
    id="delete-store-{{ $store->id }}">
    @csrf
    @method('DELETE')
</form>
{{-- Delete Form --}}
@endsection

@section('script')
<script src="{{ asset('backend/assets/js/ajax/treasuries.js') }}"></script>

@endsection
