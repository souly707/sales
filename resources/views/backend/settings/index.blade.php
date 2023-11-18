@extends('layouts.admin')

@section('title', 'Admin Settings')

@section('content')
<!-- Responsive Table -->
<div class="card">
    <h5 class="card-header">بيانات الضبط العام</h5>
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
                    <th class="">اسم الشركة:</th>
                    <td>{{ $data->system_name }}</td>
                </tr>
                <tr>
                    <th>كود الشركة</th>
                    <td>{{ $data->com_code }}</td>
                </tr>
                <tr>
                    <th>حالة الشركة</th>
                    <td>{!! $data->active() !!}</td>
                </tr>
                <tr>
                    <th>هاتف الشركة</th>
                    <td>{{ $data->phone }}</td>
                </tr>
                <tr>
                    <th>عنوان الشركة</th>
                    <td>{{ $data->address }}</td>
                </tr>
                <tr>
                    <th>رسالة التنبيه اعلى الشاشة</th>
                    <td>{{ $data->general_alert ? $data->general_alert : 'لا يوجد رسالة تنبيه' }}</td>
                </tr>

                <tr>
                    <th>شعار الشركة</th>
                    @if ($data->photo <> null)
                        <td><img src="{{ asset('backend/admins/logo/' . $data->photo) }}" alt=""></td>
                        @else
                        <td>
                            <img src="https://ui-avatars.com/api/?background=random&bold=true&size=150&name={{ $data->system_name }}&format=svg"
                                class="rounded">
                        </td>
                        @endif
                </tr>

                <tr>
                    <th>تاريخ اخر تحديث</th>
                    <td>
                        {{ $data->updated_at->format('Y-m-d H:i') }}
                        {{ $data->updated_at->format('Y-m-d H:i A') == 'AM'? 'صباحا': 'مساء' }}
                        <span class=""> بواسطة</span>
                        <span class="text-primary fw-bold"> {{ $data->updated_by_admin }}</span>
                        <span>
                            <a class="btn btn-outline-primary btn-sm fw-bold"
                                href="{{ route('backend.setting.edit',$data->id) }}">
                                تعديل
                            </a>

                        </span>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<!--/ Responsive Table -->
@endsection