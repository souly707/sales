@extends('layouts.admin')

@section('title', 'الخزن')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span></h4>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                {{-- <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> الخزن</a>
                --}}
            </li>
        </ul>
        <div class="card mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold">انشاء خزنة</h5>

                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.treasuries.index') }}" class=" btn btn-primary">
                        <span class="text font-weight-bold">الخزن</span>

                        <span class="">
                            <i class='bx bx-home'></i>
                        </span>
                    </a>

                </div>
            </div>
            <!-- Account -->

            <hr class="m-0" />

            <div class="card-body">

                <form id="formAccountSettings" action="{{ route('backend.treasuries.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label font-weight-bold">اسم الخزنة</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                name="name" value="{{ old('name') }}" autofocus />

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label font-weight-bold" for="is_master">نوع الخزنة</label>
                            <select name="is_master" id="is_master"
                                class="form-select @error('is_master') is-invalid @enderror">

                                <option value="">--اختر النوع--</option>
                                <option value="1" {{ old('is_master')=='1' ? 'selected' : null }}>
                                    رئيسية
                                </option>

                                <option value="0" {{ old('is_master')=='0' ? 'selected' : null }}>
                                    فرعية
                                </option>
                            </select>
                            @error('is_master')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="last_receipt_exchange" class="form-label">اخر ايصال صرف</label>
                            <input type="text" name="last_receipt_exchange"
                                oninput="this.value = this.value.replace(/[^0-9]/g,'');"
                                class="form-control @error('last_receipt_exchange') is-invalid @enderror"
                                id="last_receipt_exchange" value="{{ old('last_receipt_exchange') }}" />

                            @error('last_receipt_exchange')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="last_receipt_collect" class="form-label">اخر ايصال تم تحصيله</label>
                            <input type="text" name="last_receipt_collect"
                                oninput="this.value =this.value.replace(/[^0-9]/g,'');"
                                class="form-control @error('last_receipt_collect') is-invalid @enderror"
                                id="last_receipt_collect" value="{{ old('last_receipt_collect') }}" />

                            @error('last_receipt_collect')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="active">حالة الخزنة</label>
                            <select name="active" id="active" class="form-select @error('active') is-invalid @enderror">
                                <option value="1" {{ old('active')=='1' ? 'selected' : null }}>
                                    مفعل
                                </option>

                                <option value="0" {{ old('active')=='0' ? 'selected' : null }}>
                                    غير مفعل
                                </option>
                            </select>
                            @error('active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">إنشاء</button>
                        <a href="{{ route('backend.treasuries.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>

    </div>
</div>

@endsection