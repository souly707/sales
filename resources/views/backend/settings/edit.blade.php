@extends('layouts.admin')

@section('title', 'Admin Settings')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">الاعدادات</span></h4>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> الضبط العام</a>
            </li>
        </ul>
        <div class="card mb-4">
            <h5 class="card-header">تفاصيل الملف التعريفي</h5>
            <!-- Account -->
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    @if ($setting->photo <> null)

                        <img src="{{ asset('backend/admins/logo/' . $setting->photo)  }}" alt="user-avatar"
                            class="d-block rounded" height="100" width="100" id="uploadedAvatar" />

                        @else
                        <img src="https://ui-avatars.com/api/?background=random&bold=true&name={{ $setting->system_name }}&format=svg"
                            alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />

                        @endif

                        <div class="button-wrapper">
                            {{-- <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">تحميل صورة</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden
                                    accept="image/png, image/jpeg" />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button> --}}

                            <label for="com_code" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">كود الشركة</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                            </label>
                            <span type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">{{ $setting->com_code }}</span>
                            </span>


                            {{-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> --}}
                        </div>
                </div>
            </div>

            <hr class="my-0" />

            <div class="card-body">

                <form id="formAccountSettings" action="{{ route('backend.setting.update',$setting->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">اسم الشركة</label>
                            <input class="form-control @error('system_name') is-invalid @enderror" type="text"
                                id="firstName" name="system_name"
                                value="{{ old('system_name', $setting->system_name) }}" autofocus />

                            @error('system_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="phone" class="form-label">هاتف الشركة</label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone"
                                id="phone" value="{{ old('phone', $setting->phone) }}" />

                            @error('system_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">عنوان الشركة</label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" id="address"
                                name="address" value="{{ old('address',$setting->address) }}" />

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="general_alert" class="form-label">رسالة التنبيه اعلى الشاشة</label>
                            <input type="text" class="form-control @error('general_alert') is-invalid @enderror"
                                id="general_alert" name="general_alert"
                                value="{{ old('general_alert', $setting->general_alert) }}" />

                            @error('general_alert')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="active">حالة الشركة</label>
                            <select name="active" id="active" class="form-select @error('active') is-invalid @enderror">
                                <option value="1" {{ old('active', $setting->active) == '1' ? 'selected' : null }}>
                                    مفعل
                                </option>

                                <option value="0" {{ old('active', $setting->active) == '0' ? 'selected' : null }}>
                                    غير مفعل
                                </option>
                            </select>
                            @error('active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="logo" class="form-label">شعار الشركة</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo"
                                name="logo" placeholder="تحميل شعار الشركة" />

                            @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">تحديث</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>

    </div>
</div>

@endsection