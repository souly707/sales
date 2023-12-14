@extends('layouts.admin')

@section('title', 'الضبط العام')

@section('content')
<!-- Responsive Table -->
<div class="card">
    <div class="card-header py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold">الوحدات</h5>

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('backend.inv_uoms.create') }}" class=" btn btn-primary">
                <span class="text">اضافة وحدة قياس جديدة</span>

                <span class="">
                    <i class="fa-regular fa-plus fa-xl"></i>
                </span>
            </a>

        </div>

        {{-- Route & Token --}}
        <input type="hidden" id="token_search" value="{{ csrf_token() }}">
        <input type="hidden" id="ajax_search_url" value="{{ route('backend.inv_uoms.ajax_search') }}">
        {{-- Route & Token --}}

    </div>
    {{-- /.card-header --}}
    <hr class="m-0">
    <div class="card-body">
        {{-- search --}}
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="exampleDataList" class="form-label">بحث بالاسم</label>
                    <input class="form-control" list="datalistOptions" id="search_by_text" placeholder="اكتب للبحث" />
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="is_master">بحث بوحدات القياس</label>
                    <select name="is_master_search" id="is_master_search" class="form-select">
                        <option value="all">بحث بالكل</option>
                        <option value="1">رئيسية</option>
                        <option value="0">تجزئة</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- end search --}}
        <div id="ajax_response_div">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>اسم الوحدة</th>
                            <th>نوع الوحدة</th>
                            <th>حالة التفعيل</th>
                            <th>تاريخ الاضافة</th>
                            <th>تاريخ التحديث</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($inv_uoms as $uoms)
                        <tr>
                            <td>{{ $loop->index + 1}}</td>
                            <td>{{ $uoms->name }}</td>
                            <td>{{ $uoms->is_master() }}</td>
                            <td>{!! $uoms->active() !!}</td>
                            <td>
                                {{ $uoms->created_at->format('Y-m-d H:i') }}
                                {{ $uoms->created_at->format('Y-m-d H:i A') == 'AM'? 'صباحا': 'مساء' }}

                                <br>
                                <span class=""> بواسطة</span>
                                <span class="text-primary fw-bold"> {{ $uoms->added_by_admin }}</span>
                            </td>

                            <td>
                                @if ($uoms->updated_by_admin <> null)
                                    {{ $uoms->updated_at->format('Y-m-d H:i') }}
                                    {{ $uoms->updated_at->format('Y-m-d H:i A') == 'AM'? 'صباحا': 'مساء'}}

                                    <br>
                                    <span class=""> بواسطة</span>
                                    <span class="text-primary fw-bold"> {{ $uoms->updated_by_admin
                                        }}</span>
                                    @else
                                    لايوجد تحديث
                                    @endif
                            </td>

                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('backend.inv_uoms.edit',$uoms->id) }}"
                                        class="btn btn-primary btn-sm rounded">
                                        <i class='bx bx-edit'></i>
                                    </a>

                                    <a href="javascript:void(0);"
                                        onclick="if(confirm ('هل انت متاكد من الحذف'))
                                        {document.getElementById('uoms-delete-form-{{ $uoms->id }}').submit();} else {return false}"
                                        class="btn btn-danger btn-sm rounded mx-1">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>
                                {{-- Delete Form --}}
                                <form action="{{ route('backend.inv_uoms.destroy',$uoms->id) }}" method="post"
                                    id="uoms-delete-form-{{ $uoms->id }}" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                {{-- End Delete Form --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-danger">لايوجد بيانات متاحة حاليا</td>
                        </tr>
                        @endforelse
                    </tbody>

                    <tfoot class="table-border-bottom-0">
                        <tr>
                            <td colspan="7">
                                <div> {{ $inv_uoms->appends(request()->all())->links() }}</div>
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
<script src="{{ asset('backend/assets/js/ajax/inv_uoms.js') }}"></script>
@endsection