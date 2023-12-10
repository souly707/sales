@extends('layouts.admin')

@section('title', 'الضبط العام')

@section('content')
<!-- Responsive Table -->
<div class="card">
    <div class="card-header py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold">فئات الفواتير</h5>

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('backend.sales_material_types.create') }}" class=" btn btn-primary">
                <span class="text">اضافة فئة جديدة</span>

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
                            <th>اسم الفئة</th>
                            <th>حالة التفعيل</th>
                            <th>تاريخ الاضافة</th>
                            <th>تاريخ التحديث</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($sale_material_types as $sale_material_type)
                        <tr>
                            <td>{{ $loop->index + 1}}</td>
                            <td>{{ $sale_material_type->name }}</td>
                            <td>{!! $sale_material_type->active()!!}</td>
                            <td>
                                {{ $sale_material_type->created_at->format('Y-m-d H:i') }}
                                {{ $sale_material_type->created_at->format('Y-m-d H:i A') == 'AM'? 'صباحا': 'مساء' }}

                                <br>
                                <span class=""> بواسطة</span>
                                <span class="text-primary fw-bold"> {{ $sale_material_type->added_by_admin }}</span>
                            </td>

                            <td>
                                @if ($sale_material_type->updated_by_admin <> null)
                                    {{ $sale_material_type->updated_at->format('Y-m-d H:i') }}
                                    {{ $sale_material_type->updated_at->format('Y-m-d H:i A') == 'AM'? 'صباحا': 'مساء'
                                    }}

                                    <br>
                                    <span class=""> بواسطة</span>
                                    <span class="text-primary fw-bold"> {{ $sale_material_type->updated_by_admin
                                        }}</span>
                                    @else
                                    لايوجد تحديث
                                    @endif
                            </td>

                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('backend.sales_material_types.edit',$sale_material_type->id) }}"
                                        class="btn btn-primary rounded btn-sm">
                                        <i class='bx bx-edit'></i>
                                    </a>

                                    <a href="javascript:void(0)" class="btn btn-danger mx-1 rounded btn-sm" onclick="if (confirm('هل انت متأكد من الحذف'))
                                    {document.getElementById('delete-sale-material-type-{{ $sale_material_type->id }}').submit();}
                                    else {return false;}">

                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>
                                {{-- Delete Form --}}
                                <form
                                    action="{{ route('backend.sales_material_types.destroy', $sale_material_type->id) }}"
                                    method="post" class="d-none"
                                    id="delete-sale-material-type-{{ $sale_material_type->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                {{-- Delete Form --}}

                                {{-- <a href="{{ route('backend.treasuries.show',$treasury->id) }}"
                                    class="btn btn-info btn-sm" data-id="{{ $treasury->id }}">
                                    <i class='bx bx-show-alt'></i>
                                </a> --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-danger">لايوجد بيانات متاحة حاليا</td>
                        </tr>
                        @endforelse
                    </tbody>

                    <tfoot class="table-border-bottom-0">
                        <tr>
                            <td colspan="6">
                                <div> {{ $sale_material_types->appends(request()->all())->links() }}</div>
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

@endsection

@section('script')
<script src="{{ asset('backend/assets/js/ajax/treasuries.js') }}"></script>

@endsection
