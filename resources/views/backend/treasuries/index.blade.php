@extends('layouts.admin')

@section('title', 'الخزن')

@section('content')
<!-- Responsive Table -->
<div class="card">
    <div class="card-header py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold">بيانات الخزن</h5>

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('backend.treasuries.create') }}" class=" btn btn-primary">
                <span class="text">اضافة خزنة جديدة</span>

                <span class="">
                    <i class="fa-regular fa-plus fa-xl"></i>
                </span>
            </a>

        </div>

        {{-- Route & Token --}}
        <input type="hidden" id="token_search" value="{{ csrf_token() }}">
        <input type="hidden" id="ajax_search_url" value="{{ route('backend.treasuries.ajax_search') }}">
        {{-- Route & Token --}}
    </div>
    {{-- /.card-header --}}
    <hr class="m-0">
    <div class="card-body">
        {{-- search --}}
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="exampleDataList" class="form-label"></label>
                    <input class="form-control" list="datalistOptions" id="search_by_text" placeholder="اكتب للبحث" />
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
                            <th>اسم الخزنة</th>
                            <th>نوع الخزنة</th>
                            <th>حالة التفعيل</th>
                            <th>اخر ايصال صرف</th>
                            <th>اخر ايصال تفحصيل</th>
                            <th width="20%">التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($treasuries as $treasury)
                        <tr>
                            <td>{{ $loop->index + 1}}</td>
                            <td>{{ $treasury->name }}</td>
                            <td>{{ $treasury->is_master ? 'رئيسية' : 'فرعية' }}</td>
                            <td>{!! $treasury->active()!!}</td>
                            <td>{{ $treasury->last_receipt_exchange}}</td>
                            <td>{{ $treasury->last_receipt_collect}}</td>
                            <td>
                                <a href="{{ route('backend.treasuries.edit',$treasury->id) }}"
                                    class="btn btn-primary btn-sm" data-id="{{ $treasury->id }}">
                                    <i class='bx bx-edit'></i>
                                </a>

                                <a href="{{ route('backend.treasuries.show',$treasury->id) }}"
                                    class="btn btn-info btn-sm" data-id="{{ $treasury->id }}">
                                    <i class='bx bx-show-alt'></i>
                                </a>
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
                                <div> {{ $treasuries->appends(request()->all())->links() }}</div>
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