@extends('layouts.admin')

@section('title', 'Admin Settings')

@section('content')
<!-- Responsive Table -->
<div class="card">
    <h5 class="card-header">تفاصيل الخزنة</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            {{-- <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>Table heading</th>
                    <th>Table heading</th>

                </tr>
            </thead> --}}
            <tbody>
                <tr>
                    <th class="">اسم الخزنة:</th>
                    <td>{{ $treasury->name }}</td>
                </tr>
                <tr>
                    <th>نوع الخزنة</th>
                    <td>{{ $treasury->is_master() }}</td>
                </tr>
                <tr>
                    <th>اخر ايصال صرف</th>
                    <td>{{ $treasury->last_receipt_exchange }}</td>
                </tr>
                <tr>
                    <th>اخر ايصال تحصيل</th>
                    <td>{{ $treasury->last_receipt_collect }}</td>
                </tr>
                <tr>
                    <th>حالة التفعيل للخزنة</th>
                    <td>{!! $treasury->active() !!}</td>
                </tr>
                <tr>
                <tr>
                    <th>تاريخ الاضافة</th>
                    <td>
                        {{ $treasury->created_at->format('Y-m-d H:i') }}
                        {{ $treasury->created_at->format('Y-m-d H:i A') == 'AM'? 'صباحا': 'مساء' }}
                        <span class=""> بواسطة</span>
                        <span class="text-primary fw-bold"> {{ $treasury->added_by_admin }}</span>
                    </td>
                </tr>

                <tr>
                    <th>تاريخ اخر تحديث</th>
                    @if ($treasury->updated_by <> null)
                        <td>
                            {{ $treasury->updated_at->format('Y-m-d H:i') }}
                            {{ $treasury->updated_at->format('Y-m-d H:i A') == 'AM'? 'صباحا': 'مساء' }}
                            <span class=""> بواسطة</span>
                            <span class="text-primary fw-bold"> {{ $treasury->updated_by_admin }}</span>
                            <span>
                                <a class="btn btn-outline-primary btn-sm fw-bold"
                                    href="{{ route('backend.treasuries.edit',$treasury->id) }}">
                                    تعديل
                                </a>

                            </span>
                        </td>
                        @else
                        <td>
                            <span> لايوجد تحديث</span>
                            <span>
                                <a class="btn btn-outline-primary btn-sm fw-bold"
                                    href="{{ route('backend.setting.edit',$treasury->id) }}">
                                    تعديل
                                </a>
                        </td>

                        @endif
                </tr>

            </tbody>
        </table>
    </div>
</div>
<!--/.card -->

<div class="card mt-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold">
            الخزن الفرعية التي سوف تسلم عهتدها الى الخزنة
            [<span class="text-primary">{{ $treasury->name }}</span>]
        </h5>

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('backend.add.treasuries_delivery',$treasury->id) }}" class=" btn btn-primary">
                <span class="text">اضافة خزنة فرعية جديدة</span>

                <span class="">
                    <i class="fa-regular fa-plus fa-xl"></i>
                </span>
            </a>

        </div>

    </div>
    {{-- /.card-header --}}
    <hr class="m-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>اسم الخزنة</th>
                        <th>تاريخ الاضافة</th>
                        <th width="20%">التحكم</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($treasury_delivery as $treasury_item)
                    <tr>
                        <td>{{ $loop->index + 1}}</td>
                        <td>{{ $treasury_item->name }}</td>
                        <td>
                            {{ $treasury_item->created_at->format('Y-m-d H:i') }}
                            {{ $treasury_item->created_at->format('Y-m-d H:i A') == 'AM'? 'صباحا': 'مساء' }}

                            <br>
                            <span class=""> بواسطة</span>
                            <span class="text-primary fw-bold"> {{ $treasury_item->added_by_admin }}</span>
                        </td>
                        <td>

                            <a href="javascript:void()" class="btn btn-danger btn-sm" onclick="if (confirm('هل انت متاكد من حذف البيانات')) {document.getElementById('delete-treasury-{{ $treasury_item->id }}').submit();}
                                else {return false}">
                                <i class='bx bx-trash'></i>
                            </a>
                            <form action="{{ route('backend.delete.treasuries_delivery',$treasury_item->id) }}"
                                method="POST" id="delete-treasury-{{ $treasury_item->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
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
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        {{-- /.table-responsive --}}
    </div>
    {{-- /.card-body --}}
</div>
{{-- /.card --}}
@endsection